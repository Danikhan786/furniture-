@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>Shop</h1>
                        <p class="mb-4">Browse our collection of premium furniture</p>
                    </div>
                </div>
                <div class="col-lg-7">
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            @if(isset($products) && $products->count() > 0)
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-12 col-md-4 col-lg-3 mb-5">
                            <a class="product-item" href="{{ route('productDetail', $product->slug) }}">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid product-thumbnail">
                                @else
                                    <img src="frontend/images/product-1.png" alt="{{ $product->name }}" class="img-fluid product-thumbnail">
                                @endif
                                <h3 class="product-title">{{ $product->name }}</h3>
                                <strong class="product-price">
                                    @if($product->discount_price)
                                        <span class="text-danger">${{ number_format($product->discount_price, 2) }}</span>
                                        <span class="text-muted text-decoration-line-through ms-2" style="font-size: 0.9rem;">${{ number_format($product->price, 2) }}</span>
                                    @else
                                        ${{ number_format($product->price, 2) }}
                                    @endif
                                </strong>

                                <span class="icon-cross">
                                    <img src="frontend/images/cross.svg" class="img-fluid">
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="row mt-5">
                        <div class="col-12">
                            <div class="d-flex justify-content-center">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <div class="row">
                    <div class="col-12 text-center py-5">
                        <h3 class="text-muted">No products available</h3>
                        <p class="text-muted">Check back later for new arrivals!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
