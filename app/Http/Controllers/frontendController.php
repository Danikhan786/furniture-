<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

class frontendController extends Controller
{
    public function index()
    {
        return view('frontend.index');
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
        return view('frontend.checkout');
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
