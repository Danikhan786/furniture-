<?php

namespace App\Http\Controllers;

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

    public function products()
    {
        return view('frontend.products');
    }

    public function productDetail()
    {
        return view('frontend.productDetail');
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
}
