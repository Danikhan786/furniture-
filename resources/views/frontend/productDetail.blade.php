@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12 ">
                    <div class="text-center text-white">
                        <h1>{{ $product->name }}</h1>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <!-- Start Product Detail Section -->
    <div class="product-section">
        <div class="container">
            <div class="row">
                <!-- Product Images -->
                <div class="col-lg-6 mb-5">
                    <div class="product-detail-images">
                        <!-- Main Image -->
                        <div class="main-image mb-3">
                            <img id="main-product-image"
                                src="{{ $product->image ? asset($product->image) : '../../frontend/images/product-1.png' }}"
                                alt="{{ $product->name }}" class="img-fluid rounded"
                                style="width: 100%; height: 500px; object-fit: cover;">
                        </div>

                        <!-- Thumbnail Gallery -->
                        @if ($product->images && $product->images->count() > 0)
                            <div class="thumbnail-gallery d-flex gap-2">
                                <!-- Main image thumbnail -->
                                <div class="thumbnail-item"
                                    onclick="changeMainImage('{{ $product->image ? asset($product->image) : 'frontend/images/product-1.png' }}', this)">
                                    <img src="{{ $product->image ? asset($product->image) : 'frontend/images/product-1.png' }}"
                                        alt="Thumbnail" class="img-fluid rounded thumbnail-img"
                                        style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 2px solid #007bff;">
                                </div>
                                @foreach ($product->images as $image)
                                    <div class="thumbnail-item"
                                        onclick="changeMainImage('{{ asset($image->image) }}', this)">
                                        <img src="{{ asset($image->image) }}" alt="Thumbnail"
                                            class="img-fluid rounded thumbnail-img"
                                            style="width: 80px; height: 80px; object-fit: cover; cursor: pointer; border: 2px solid #ddd;">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6 mb-5">
                    <div class="product-detail-info">
                        <h2 class="mb-3">{{ $product->name }}</h2>

                        @if ($product->category)
                            <p class="text-muted mb-3">
                                <span>Category: </span>
                                <a href="{{ route('shop') }}" class="text-primary">{{ $product->category->name }}</a>
                            </p>
                        @endif

                        <!-- Price -->
                        <div class="product-price mb-4">
                            @if ($product->discount_price)
                                <div class="d-flex align-items-center gap-3">
                                    <strong class="product-price text-danger"
                                        style="font-size: 2rem;">${{ number_format($product->discount_price, 2) }}</strong>
                                    <strong class="product-price text-muted text-decoration-line-through"
                                        style="font-size: 1.5rem;">${{ number_format($product->price, 2) }}</strong>
                                    @if ($product->discount_percent)
                                        <span class="badge bg-danger">{{ round($product->discount_percent) }}% OFF</span>
                                    @endif
                                </div>
                            @else
                                <strong class="product-price"
                                    style="font-size: 2rem;">${{ number_format($product->price, 2) }}</strong>
                            @endif
                        </div>

                        <!-- Short Description -->
                        @if ($product->short_description)
                            <p class="mb-4">{{ $product->short_description }}</p>
                        @endif

                        <!-- Stock Status -->
                        <div class="mb-4">
                            @if ($product->stock > 0)
                                <p class="text-success mb-2">
                                    <i class="fa fa-check-circle"></i> In Stock ({{ $product->stock }} available)
                                </p>
                            @else
                                <p class="text-danger mb-2">
                                    <i class="fa fa-times-circle"></i> Out of Stock
                                </p>
                            @endif
                        </div>

                        <!-- SKU -->
                        @if ($product->sku)
                            <p class="text-muted mb-4">
                                <small>SKU: {{ $product->sku }}</small>
                            </p>
                        @endif

                        <!-- Add to Cart and WhatsApp -->
                        <div class="mb-4">
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="button" class="btn btn-primary btn-md" onclick="addToCart({{ $product->id }})"
                                    {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <i class="fa fa-shopping-cart"></i> Add to Cart
                                </button>
                                <a href="https://wa.me/923154764713?text={{ urlencode('Check out this product: ' . $product->name . ' - ' . route('productDetail', $product->slug)) }}" 
                                   target="_blank" 
                                   class="btn btn-success btn-md">
                                   <i class="fa-brands fa-whatsapp"></i> Share on WhatsApp
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Detail Section -->

    <!-- Product Tabs Section -->
    <div class=" before-footer-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <!-- Bootstrap Tabs -->
                    <ul class="nav nav-tabs mb-4" id="productTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                data-bs-target="#description" type="button" role="tab" aria-controls="description"
                                aria-selected="true">
                                <i class="fa fa-file-text me-2"></i> Description
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                type="button" role="tab" aria-controls="reviews" aria-selected="false">
                                <i class="fa fa-star me-2"></i> Reviews
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content" id="productTabsContent">
                        <!-- Description Tab -->
                        <div class="tab-pane fade show active" id="description" role="tabpanel"
                            aria-labelledby="description-tab">
                            <div class="product-description">
                                @if ($product->long_description)
                                    <div class="text-muted" style="line-height: 1.8;">
                                        {!! nl2br(e($product->long_description)) !!}
                                    </div>
                                @else
                                    <p class="text-muted">No detailed description available for this product.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-section">
                                <!-- Individual Reviews -->
                                <div class="reviews-list">
                                    <h5 class="mb-4">Customer Reviews</h5>

                                    <!-- Review 1 -->
                                    <div class="review-item mb-4 pb-4 border-bottom">
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <div>
                                                <h6 class="mb-1">John Doe</h6>
                                                <div class="mb-2">
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                    <i class="fa fa-star text-warning"></i>
                                                </div>
                                            </div>
                                            <small class="text-muted">2 days ago</small>
                                        </div>
                                        <p class="mb-0">Excellent product! The quality is outstanding and it looks
                                            exactly as described. Very satisfied with my purchase.</p>
                                    </div>
                                </div>

                                <!-- Write Review Section (Non-functional, just UI) -->
                                <div class="write-review-section mt-5 pt-4 border-top">
                                    <h5 class="mb-3">Write a Review</h5>
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Your Rating</label>
                                            <div class="rating-input">
                                                <i class="far fa-star text-warning"
                                                    style="font-size: 1.5rem; cursor: pointer;"></i>
                                                <i class="far fa-star text-warning"
                                                    style="font-size: 1.5rem; cursor: pointer;"></i>
                                                <i class="far fa-star text-warning"
                                                    style="font-size: 1.5rem; cursor: pointer;"></i>
                                                <i class="far fa-star text-warning"
                                                    style="font-size: 1.5rem; cursor: pointer;"></i>
                                                <i class="far fa-star text-warning"
                                                    style="font-size: 1.5rem; cursor: pointer;"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="reviewTitle" class="form-label">Review Title</label>
                                            <input type="text" class="form-control" id="reviewTitle"
                                                placeholder="Enter a title for your review">
                                        </div>
                                        <div class="mb-3">
                                            <label for="reviewText" class="form-label">Your Review</label>
                                            <textarea class="form-control" id="reviewText" rows="5"
                                                placeholder="Share your experience with this product..."></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Product Tabs Section -->

    <!-- Related Products Section -->
    @if ($relatedProducts && $relatedProducts->count() > 0)
        <div class="untree_co-section product-section before-footer-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12 text-center">
                        <h2 class="section-title">Related Products</h2>
                    </div>
                </div>
                <div class="row">
                    @foreach ($relatedProducts as $relatedProduct)
                        <div class="col-12 col-md-4 col-lg-3 mb-5">
                            <a class="product-item" href="{{ route('productDetail', $relatedProduct->slug) }}">
                                @if ($relatedProduct->image)
                                    <img src="{{ asset($relatedProduct->image) }}" alt="{{ $relatedProduct->name }}"
                                        class="img-fluid product-thumbnail">
                                @else
                                    <img src="../../frontend/images/product-1.png" alt="{{ $relatedProduct->name }}"
                                        class="img-fluid product-thumbnail">
                                @endif
                                <h3 class="product-title">{{ $relatedProduct->name }}</h3>
                                <strong class="product-price">
                                    @if ($relatedProduct->discount_price)
                                        ${{ number_format($relatedProduct->discount_price, 2) }}
                                    @else
                                        ${{ number_format($relatedProduct->price, 2) }}
                                    @endif
                                </strong>

                                <span class="icon-cross">
                                    <img src="../../frontend/images/cross.svg" class="img-fluid">
                                </span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <script>
        function changeMainImage(imageSrc, element) {
            document.getElementById('main-product-image').src = imageSrc;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail-item img').forEach(img => {
                img.style.border = '2px solid #ddd';
            });
            if (element) {
                const img = element.querySelector('img') || element;
                img.style.border = '2px solid #007bff';
            }
        }
    </script>
@endsection
