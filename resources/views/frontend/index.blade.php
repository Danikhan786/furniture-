@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <div class="intro-excerpt">
                        <h1>{{ __('messages.hero.title') }} <span class="d-block">{{ __('messages.hero.titleSpan') }}</span></h1>
                        <p class="mb-4">{{ __('messages.hero.description') }}</p>
                        <p><a href="{{ route('shop') }}" class="btn btn-secondary me-2">{{ __('messages.hero.shopNow') }}</a><a
                                href="{{ route('about') }}" class="btn btn-white-outline">{{ __('messages.hero.explore') }}</a></p>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero-img-wrap">
                        <img src="frontend/images/couch.png" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Why Choose Us Section -->
    <div class="why-choose-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <h2 class="section-title">{{ __('messages.whyChoose.title') }}</h2>
                    <p>{{ __('messages.whyChoose.description') }}</p>

                    <div class="row my-5">
                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="frontend/images/truck.svg" alt="Image" class="img-fluid">
                                </div>
                                <h3>{{ __('messages.whyChoose.fastShipping') }}</h3>
                                <p>{{ __('messages.whyChoose.fastShippingDesc') }}
                                </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="frontend/images/bag.svg" alt="Image" class="img-fluid">
                                </div>
                                <h3>{{ __('messages.whyChoose.easyShop') }}</h3>
                                <p>{{ __('messages.whyChoose.easyShopDesc') }}
                                </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="frontend/images/support.svg" alt="Image" class="img-fluid">
                                </div>
                                <h3>{{ __('messages.whyChoose.support') }}</h3>
                                <p>{{ __('messages.whyChoose.supportDesc') }}
                                </p>
                            </div>
                        </div>

                        <div class="col-6 col-md-6">
                            <div class="feature">
                                <div class="icon">
                                    <img src="frontend/images/return.svg" alt="Image" class="img-fluid">
                                </div>
                                <h3>{{ __('messages.whyChoose.returns') }}</h3>
                                <p>{{ __('messages.whyChoose.returnsDesc') }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-5">
                    <div class="img-wrap">
                        <img src="frontend/images/image2.jpg" alt="Image" class="img-fluid">
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Why Choose Us Section -->

    <!-- Start Product Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">
                <!-- Start Column 1 -->
                <div class="col-md-12 col-lg-3 mb-5 mb-lg-0">
                    <h2 class="mb-4 section-title">{{ __('messages.product.title') }}</h2>
                    <p class="mb-4">{{ __('messages.product.description') }} </p>
                    <p><a href="{{ route('shop') }}" class="btn">{{ __('messages.hero.explore') }}</a></p>
                </div>
                <!-- End Column 1 -->

                <!-- Products Grid -->
                @if(isset($products) && $products->count() > 0)
                    @foreach($products as $product)
                        <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
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
                @else
                    <!-- Fallback if no products -->
                    <div class="col-12 col-md-4 col-lg-3 mb-5 mb-md-0">
                        <a class="product-item" href="#">
                            <img src="frontend/images/product-1.png" class="img-fluid product-thumbnail">
                            <h3 class="product-title">{{ __('messages.product.noProducts') }}</h3>
                            <strong class="product-price">$0.00</strong>
                            <span class="icon-cross">
                                <img src="frontend/images/cross.svg" class="img-fluid">
                            </span>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- End Product Section -->

    <!-- Start We Help Section -->
    <div class="we-help-section">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="imgs-grid">
                        <div class="grid grid-1"><img src="frontend/images/image1.jpg" alt="Untree.co"></div>
                        <div class="grid grid-2"><img src="frontend/images/image4.jpg" alt="Untree.co"></div>
                        <div class="grid grid-3"><img src="frontend/images/image7.jpg" alt="Untree.co"></div>
                    </div>
                </div>
                <div class="col-lg-5 ps-lg-5">
                    <h2 class="section-title mb-4">{{ __('messages.weHelp.title') }}</h2>
                    <p>{{ __('messages.weHelp.description') }}</p>

                    <ul class="list-unstyled custom-list my-4">
                        <li>{{ __('messages.weHelp.item1') }}</li>
                        <li>{{ __('messages.weHelp.item2') }}</li>
                        <li>{{ __('messages.weHelp.item3') }}</li>
                        <li>{{ __('messages.weHelp.item4') }}</li>
                    </ul>
                    <p><a href="{{ route('shop') }}" class="btn">{{ __('messages.hero.explore') }}</a></p>
                </div>
            </div>
        </div>
    </div>
    <!-- End We Help Section -->

    <!-- Start Popular Product -->
    <div class="popular-product">
        <div class="container">
            <div class="row">

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="frontend/images/product-1.png" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>{{ __('messages.popular.nordicTitle') }}</h3>
                            <p>{{ __('messages.popular.nordicDesc') }} </p>
                            <p><a href="#">{{ __('messages.popular.readMore') }}</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="frontend/images/product-2.png" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>{{ __('messages.popular.kruzoTitle') }}</h3>
                            <p>{{ __('messages.popular.kruzoDesc') }} </p>
                            <p><a href="#">{{ __('messages.popular.readMore') }}</a></p>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4 mb-4 mb-lg-0">
                    <div class="product-item-sm d-flex">
                        <div class="thumbnail">
                            <img src="frontend/images/product-3.png" alt="Image" class="img-fluid">
                        </div>
                        <div class="pt-3">
                            <h3>{{ __('messages.popular.ergonomicTitle') }}</h3>
                            <p>{{ __('messages.popular.ergonomicDesc') }} </p>
                            <p><a href="#">{{ __('messages.popular.readMore') }}</a></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Popular Product -->

    <!-- Start Testimonial Slider -->
    <div class="testimonial-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 mx-auto text-center">
                    <h2 class="section-title">{{ __('messages.testimonials.title') }}</h2>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-slider-wrap text-center">

                        <div id="testimonial-nav">
                            <span class="prev" data-controls="prev"><span class="fa fa-chevron-left"></span></span>
                            <span class="next" data-controls="next"><span class="fa fa-chevron-right"></span></span>
                        </div>

                        <div class="testimonial-slider">

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;{{ __('messages.testimonials.testimonial1') }}&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="frontend/images/person-1.png" alt="Maria Jones"
                                                        class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">{{ __('messages.testimonials.author1') }}</h3>
                                                <span class="position d-block mb-3">{{ __('messages.testimonials.position1') }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;{{ __('messages.testimonials.testimonial1') }}&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="frontend/images/person-1.png" alt="Maria Jones"
                                                        class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">{{ __('messages.testimonials.author1') }}</h3>
                                                <span class="position d-block mb-3">{{ __('messages.testimonials.position1') }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                            <div class="item">
                                <div class="row justify-content-center">
                                    <div class="col-lg-8 mx-auto">

                                        <div class="testimonial-block text-center">
                                            <blockquote class="mb-5">
                                                <p>&ldquo;{{ __('messages.testimonials.testimonial1') }}&rdquo;</p>
                                            </blockquote>

                                            <div class="author-info">
                                                <div class="author-pic">
                                                    <img src="frontend/images/person-1.png" alt="Maria Jones"
                                                        class="img-fluid">
                                                </div>
                                                <h3 class="font-weight-bold">{{ __('messages.testimonials.author1') }}</h3>
                                                <span class="position d-block mb-3">{{ __('messages.testimonials.position1') }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- END item -->

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Testimonial Slider -->

    <!-- Start Blog Section -->
    {{-- <div class="blog-section">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6">
                <h2 class="section-title">Recent Blog</h2>
            </div>
            <div class="col-md-6 text-start text-md-end">
                <a href="#" class="more">View All Posts</a>
            </div>
        </div>

        <div class="row">

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="frontend/images/post-1.jpg" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">First Time Home Owner Ideas</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 19, 2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="frontend/images/post-2.jpg" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">How To Keep Your Furniture Clean</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Robert Fox</a></span> <span>on <a href="#">Dec 15, 2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-md-4 mb-4 mb-md-0">
                <div class="post-entry">
                    <a href="#" class="post-thumbnail"><img src="frontend/images/post-3.jpg" alt="Image" class="img-fluid"></a>
                    <div class="post-content-entry">
                        <h3><a href="#">Small Space Furniture Apartment Ideas</a></h3>
                        <div class="meta">
                            <span>by <a href="#">Kristin Watson</a></span> <span>on <a href="#">Dec 12, 2021</a></span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> --}}
    <!-- End Blog Section -->
@endsection
