<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Add a product to the cart.
     */
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if product is active and in stock
        if ($product->status !== 'active') {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This product is not available.'
                ], 400);
            }
            return redirect()->back()->with('error', 'This product is not available.');
        }

        if ($product->stock < $request->quantity) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Insufficient stock. Only ' . $product->stock . ' items available.'
                ], 400);
            }
            return redirect()->back()->with('error', 'Insufficient stock. Only ' . $product->stock . ' items available.');
        }

        // Get the price (use discount price if available, otherwise regular price)
        $price = $product->discount_price ?? $product->price;

        // Check if user is authenticated or use session
        if (Auth::check()) {
            // Authenticated user - use database
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                // Update quantity if item already exists
                $newQuantity = $cartItem->quantity + $request->quantity;
                
                // Check stock again
                if ($product->stock < $newQuantity) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Insufficient stock. You already have ' . $cartItem->quantity . ' in your cart. Only ' . $product->stock . ' items available.'
                        ], 400);
                    }
                    return redirect()->back()->with('error', 'Insufficient stock. You already have ' . $cartItem->quantity . ' in your cart. Only ' . $product->stock . ' items available.');
                }

                $cartItem->quantity = $newQuantity;
                $cartItem->price = $price; // Update price in case it changed
                $cartItem->save();
            } else {
                // Create new cart item
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'price' => $price,
                ]);
            }
        } else {
            // Guest user - use session
            $sessionId = Session::getId();
            $cartItem = Cart::where('session_id', $sessionId)
                ->where('product_id', $request->product_id)
                ->first();

            if ($cartItem) {
                // Update quantity if item already exists
                $newQuantity = $cartItem->quantity + $request->quantity;
                
                // Check stock again
                if ($product->stock < $newQuantity) {
                    if ($request->expectsJson()) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Insufficient stock. You already have ' . $cartItem->quantity . ' in your cart. Only ' . $product->stock . ' items available.'
                        ], 400);
                    }
                    return redirect()->back()->with('error', 'Insufficient stock. You already have ' . $cartItem->quantity . ' in your cart. Only ' . $product->stock . ' items available.');
                }

                $cartItem->quantity = $newQuantity;
                $cartItem->price = $price; // Update price in case it changed
                $cartItem->save();
            } else {
                // Create new cart item
                Cart::create([
                    'session_id' => $sessionId,
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                    'price' => $price,
                ]);
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart successfully.',
                'cart_count' => $this->getCartCount()
            ]);
        }

        return redirect()->route('cart')->with('success', 'Product added to cart successfully.');
    }

    /**
     * Get cart items for the user (authenticated or guest).
     */
    public function index()
    {
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

        return view('frontend.cart', compact('cartItems'));
    }

    /**
     * Update cart item quantity.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        if (Auth::check()) {
            $cartItem = Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        } else {
            $sessionId = Session::getId();
            $cartItem = Cart::where('id', $id)
                ->where('session_id', $sessionId)
                ->firstOrFail();
        }

        $product = $cartItem->product;

        // Check stock
        if ($product->stock < $request->quantity) {
            return redirect()->route('cart')
                ->with('error', 'Insufficient stock. Only ' . $product->stock . ' items available.');
        }

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return redirect()->route('cart')
            ->with('success', 'Cart updated successfully.');
    }

    /**
     * Update all cart items quantities.
     */
    public function updateAll(Request $request)
    {
        $request->validate([
            'quantities' => 'required|array',
            'quantities.*' => 'required|integer|min:1',
        ]);

        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
        } else {
            $sessionId = Session::getId();
            $cartItems = Cart::where('session_id', $sessionId)->get();
        }

        foreach ($request->quantities as $cartId => $quantity) {
            $cartItem = $cartItems->find($cartId);
            if ($cartItem) {
                $product = $cartItem->product;
                
                // Check stock
                if ($product && $product->stock < $quantity) {
                    return redirect()->route('cart')
                        ->with('error', 'Insufficient stock for ' . $product->name . '. Only ' . $product->stock . ' items available.');
                }

                $cartItem->quantity = $quantity;
                $cartItem->save();
            }
        }

        return redirect()->route('cart')
            ->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove item from cart.
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            $cartItem = Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();
        } else {
            $sessionId = Session::getId();
            $cartItem = Cart::where('id', $id)
                ->where('session_id', $sessionId)
                ->firstOrFail();
        }

        $cartItem->delete();

        return redirect()->route('cart')
            ->with('success', 'Item removed from cart.');
    }

    /**
     * Get cart count for the user (authenticated or guest).
     */
    private function getCartCount()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->sum('quantity');
        } else {
            $sessionId = Session::getId();
            return Cart::where('session_id', $sessionId)->sum('quantity');
        }
    }

    /**
     * Get cart total for the user (authenticated or guest).
     */
    private function getCartTotal()
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())->get();
        } else {
            $sessionId = Session::getId();
            $cartItems = Cart::where('session_id', $sessionId)->get();
        }
        
        return $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });
    }
}
