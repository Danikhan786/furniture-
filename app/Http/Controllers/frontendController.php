<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
    public function checkout(){
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

        $subtotal = $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
        $total = $subtotal; // Can add shipping, tax, etc. here later

        return view('frontend.checkout', compact('cartItems', 'subtotal', 'total'));
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
