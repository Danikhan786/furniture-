<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\User;
use App\Mail\NewOrderNotification;
use App\Mail\CustomerOrderConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    /**
     * Store a new order.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'c_fname' => 'required|string|max:255',
            'c_lname' => 'required|string|max:255',
            'c_companyname' => 'nullable|string|max:255',
            'c_address' => 'required|string|max:255',
            'c_state_country' => 'required|string|max:255',
            'c_postal_zip' => 'required|string|max:255',
            'c_email_address' => 'required|email|max:255',
            'c_phone' => 'required|string|max:255',
            'c_order_notes' => 'nullable|string',
            'coupon_code' => 'nullable|string|max:255',
        ]);

        // Get cart items
        if (Auth::check()) {
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $sessionId = Session::getId();
            $cartItems = Cart::with('product')
                ->where('session_id', $sessionId)
                ->get();
        }

        // Check if cart is empty
        if ($cartItems->count() == 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Check if any product has discount_price - if yes, coupon cannot be applied
        $hasDiscountedProducts = $cartItems->contains(function($item) {
            return $item->product && $item->product->discount_price;
        });

        // Validate and apply coupon if provided
        $coupon = null;
        $discountAmount = 0;
        $couponCode = null;
        $couponDiscountPercent = null;

        if ($request->filled('coupon_code') && !$hasDiscountedProducts) {
            $couponCode = strtoupper(trim($request->input('coupon_code')));
            $coupon = Coupon::where('code', $couponCode)->first();

            if (!$coupon) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Invalid coupon code.');
            }

            if (!$coupon->isValid()) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'This coupon is not valid or has expired.');
            }

            // Calculate discount
            $subtotal = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
            $discountAmount = ($subtotal * $coupon->discount_percent) / 100;
            $couponDiscountPercent = $coupon->discount_percent;
        } else {
            // Calculate totals without coupon
            $subtotal = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
            
            if ($hasDiscountedProducts && $request->filled('coupon_code')) {
                return redirect()->back()
                    ->withInput()
                    ->with('error', 'Coupon cannot be applied to orders with discounted products.');
            }
        }

        $total = $subtotal - $discountAmount;

        // Start database transaction
        DB::beginTransaction();

        try {
            // Create order
            $order = Order::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : Session::getId(),
                'order_number' => Order::generateOrderNumber(),
                'first_name' => $validated['c_fname'],
                'last_name' => $validated['c_lname'],
                'company_name' => $validated['c_companyname'] ?? null,
                'address' => $validated['c_address'],
                'apartment' => $request->input('apartment') ?? null,
                'state_country' => $validated['c_state_country'],
                'postal_zip' => $validated['c_postal_zip'],
                'email' => $validated['c_email_address'],
                'phone' => $validated['c_phone'],
                'order_notes' => $validated['c_order_notes'] ?? null,
                'subtotal' => $subtotal,
                'total' => $total,
                'status' => 'pending',
                'payment_method' => 'cash_on_delivery',
                'coupon_code' => $couponCode,
                'coupon_id' => $coupon ? $coupon->id : null,
                'coupon_discount' => $couponDiscountPercent,
                'discount_amount' => $discountAmount,
            ]);

            // Increment coupon usage if applied
            if ($coupon) {
                $coupon->incrementUsage();
            }

            // Create order items
            foreach ($cartItems as $cartItem) {
                if ($cartItem->product) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $cartItem->product_id,
                        'quantity' => $cartItem->quantity,
                        'price' => $cartItem->price,
                        'total' => $cartItem->price * $cartItem->quantity,
                    ]);
                }
            }

            // Clear the cart
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                Cart::where('session_id', Session::getId())->delete();
            }

            // Commit transaction
            DB::commit();

            // Load order relationships for email
            $order->load('items.product');

            // Send email notification to all admin users
            try {
                $adminUsers = User::where('type', 1)->get(); // type 1 = admin
                
                foreach ($adminUsers as $admin) {
                    Mail::to($admin->email)->send(new NewOrderNotification($order));
                }
            } catch (\Exception $e) {
                // Log the error but don't fail the order
                \Log::error('Failed to send order notification email: ' . $e->getMessage());
            }

            // Send order confirmation to customer
            try {
                Mail::to($order->email)->send(new CustomerOrderConfirmation($order));
            } catch (\Exception $e) {
                \Log::error('Failed to send customer order confirmation: ' . $e->getMessage());
            }

            // Redirect to thank you page with order number
            return redirect()->route('thankyou')->with('order_number', $order->order_number);

        } catch (\Exception $e) {
            // Rollback transaction on error
            DB::rollBack();
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'An error occurred while processing your order. Please try again.');
        }
    }

    /**
     * Show public order lookup form.
     */
    public function showLookupForm()
    {
        return view('frontend.order_lookup', ['order' => null]);
    }

    /**
     * Handle public order lookup.
     */
    public function lookup(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string',
        ]);

        $order = Order::with('items.product')
            ->where('order_number', $validated['order_number'])
            ->first();

        if (!$order) {
            return redirect()->back()->withInput()->with('error', __('messages.orderLookup.orderNotFound'));
        }

        return view('frontend.order_lookup', ['order' => $order]);
    }
}
