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

    public function Shop()
    {
        return view('frontend.shop');
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
    public function thankyou()
    {
        return view('frontend.thankyou');
    }
}
