<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class frontendController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'images'])
            ->where('status', 'active')
            ->latest()
            ->limit(8)
            ->get();
        
        return view('frontend.index', compact('products'));
    }

    public function about()
    {
        return view('frontend.aboutus');
    }

    public function Shop()
    {
        $products = Product::with(['category', 'images'])
            ->where('status', 'active')
            ->latest()
            ->paginate(12);
        
        $categories = Category::where('status', 'active')
            ->orderBy('name')
            ->get();
        
        return view('frontend.shop', compact('products', 'categories'));
    }

    public function productDetail($slug)
    {
        $product = Product::with(['category', 'images'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();
        
        // Get related products from same category
        $relatedProducts = Product::with('images')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();
        
        return view('frontend.productDetail', compact('product', 'relatedProducts'));
    }
    public function cart()
    {
        return view('frontend.cart');
    }
    public function checkout(Request $request){
        if (Auth::check()) {
            $cartItems = Cart::with('product.category', 'product.images')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $sessionId = Session::getId();
            $cartItems = Cart::with('product.category', 'product.images')
                ->where('session_id', $sessionId)
                ->get();
        }

        // Redirect to cart if empty
        if ($cartItems->count() == 0) {
            return redirect()->route('cart')->with('error', 'Your cart is empty. Please add items to your cart before checkout.');
        }

        // Check if any product has discount_price
        $hasDiscountedProducts = $cartItems->contains(function($item) {
            return $item->product && $item->product->discount_price;
        });

        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
        
        $coupon = null;
        $discountAmount = 0;
        $total = $subtotal;
        
        // Validate coupon if provided
        if ($request->filled('coupon_code') && !$hasDiscountedProducts) {
            $couponCode = strtoupper(trim($request->input('coupon_code')));
            $coupon = Coupon::where('code', $couponCode)->first();
            
            if ($coupon && $coupon->isValid()) {
                $discountAmount = ($subtotal * $coupon->discount_percent) / 100;
                $total = $subtotal - $discountAmount;
            }
        }

        return view('frontend.checkout', compact('cartItems', 'subtotal', 'total', 'coupon', 'discountAmount', 'hasDiscountedProducts'));
    }
    
    public function validateCoupon(Request $request)
    {
        try {
            // Validate request
            $validated = $request->validate([
                'coupon_code' => 'required|string|max:255',
            ]);

            $couponCode = strtoupper(trim($validated['coupon_code']));
            $coupon = Coupon::where('code', $couponCode)->first();

            if (!$coupon) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid coupon code.'
                ], 400);
            }

            if (!$coupon->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This coupon is not valid or has expired.'
                ], 400);
            }

            // Check if cart has discounted products
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
                return response()->json([
                    'success' => false,
                    'message' => 'Your cart is empty.'
                ], 400);
            }

            $hasDiscountedProducts = $cartItems->contains(function($item) {
                return $item->product && $item->product->discount_price;
            });

            if ($hasDiscountedProducts) {
                return response()->json([
                    'success' => false,
                    'message' => 'Coupon cannot be applied to orders with discounted products.'
                ], 400);
            }

            $subtotal = $cartItems->sum(function($item) {
                return $item->price * $item->quantity;
            });
            $discountAmount = ($subtotal * $coupon->discount_percent) / 100;
            $total = $subtotal - $discountAmount;

            return response()->json([
                'success' => true,
                'message' => 'Coupon applied successfully!',
                'coupon' => [
                    'code' => $coupon->code,
                    'name' => $coupon->name,
                    'discount_percent' => $coupon->discount_percent,
                ],
                'discount_amount' => number_format($discountAmount, 2),
                'subtotal' => number_format($subtotal, 2),
                'total' => number_format($total, 2),
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
    public function contact()
    {
        return view('frontend.contactus');
    }
    public function thankyou()
    {
        return view('frontend.thankyou');
    }
}
