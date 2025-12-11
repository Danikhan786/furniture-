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
                                <span>{{ __('messages.productDetail.category') }} </span>
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
                                    <i class="fa fa-check-circle"></i> {{ __('messages.productDetail.inStock') }} ({{ $product->stock }} {{ __('messages.productDetail.available') }})
                                </p>
                            @else
                                <p class="text-danger mb-2">
                                    <i class="fa fa-times-circle"></i> {{ __('messages.productDetail.outOfStock') }}
                                </p>
                            @endif
                        </div>

                        <!-- SKU -->
                        @if ($product->sku)
                            <p class="text-muted mb-4">
                                <small>{{ __('messages.productDetail.sku') }} {{ $product->sku }}</small>
                            </p>
                        @endif

                        <!-- Add to Cart and WhatsApp -->
                        <div class="mb-4">
                            <div class="d-flex gap-2 flex-wrap">
                                <form method="POST" action="{{ route('cart.add') }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="btn btn-primary btn-md"
                                        {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                        <i class="fa fa-shopping-cart"></i> {{ __('messages.productDetail.addToCart') }}
                                    </button>
                                </form>
                                <a href="https://wa.me/33621792848?text={{ urlencode('Check out this product: ' . $product->name . ' - ' . route('productDetail', $product->slug)) }}"
                                    target="_blank" class="btn btn-success btn-md">
                                    <i class="fa-brands fa-whatsapp"></i> {{ __('messages.productDetail.shareWhatsApp') }}
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
                                <i class="fa fa-file-text me-2"></i> {{ __('messages.productDetail.description') }}
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews"
                                type="button" role="tab" aria-controls="reviews" aria-selected="false">
                                <i class="fa fa-star me-2"></i> {{ __('messages.productDetail.reviews') }}
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
                                    <p class="text-muted">{{ __('messages.productDetail.noDescription') }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Reviews Tab -->
                        <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                            <div class="reviews-section">
                                @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif

                                <!-- Review Summary -->
                                @php
                                    $approvedReviews = $product->approvedReviews;
                                    $averageRating = $product->average_rating;
                                    $reviewsCount = $product->reviews_count;
                                @endphp

                                @if ($reviewsCount > 0)
                                    <div class="review-summary mb-5 pb-4 border-bottom">
                                        <div class="row">
                                            <div class="col-md-4 text-center mb-3 mb-md-0">
                                                <h2 class="mb-2">{{ number_format($averageRating, 1) }}</h2>
                                                <div class="mb-2">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= floor($averageRating))
                                                            <i class="fa fa-star text-warning"></i>
                                                        @elseif($i - 0.5 <= $averageRating)
                                                            <i class="fa fa-star-half-alt text-warning"></i>
                                                        @else
                                                            <i class="far fa-star text-warning"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <p class="text-muted mb-0">{{ __('messages.productDetail.basedOn') }} {{ $reviewsCount }}
                                                    {{ $reviewsCount == 1 ? __('messages.productDetail.review') : __('messages.productDetail.reviewsPlural') }}</p>
                                            </div>
                                            <div class="col-md-8">
                                                @for ($rating = 5; $rating >= 1; $rating--)
                                                    @php
                                                        $count = $approvedReviews->where('rating', $rating)->count();
                                                        $percent =
                                                            $reviewsCount > 0 ? ($count / $reviewsCount) * 100 : 0;
                                                    @endphp
                                                    <div class="d-flex align-items-center mb-2">
                                                        <small class="me-2" style="width: 30px;">{{ $rating }} <i
                                                                class="fa fa-star text-warning"></i></small>
                                                        <div class="progress flex-grow-1 me-2" style="height: 8px;">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: {{ $percent }}%"></div>
                                                        </div>
                                                        <small class="text-muted"
                                                            style="width: 40px;">{{ $count }}</small>
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <!-- Individual Reviews -->
                                <div class="reviews-list mb-5">
                                    <h5 class="mb-4">{{ __('messages.productDetail.customerReviews') }} ({{ $reviewsCount }})</h5>

                                    @if ($approvedReviews->count() > 0)
                                        @foreach ($approvedReviews as $review)
                                            <div class="review-item mb-4 pb-4 border-bottom">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <div>
                                                        <h6 class="mb-1">{{ $review->name }}</h6>
                                                        <div class="mb-2">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                @if ($i <= $review->rating)
                                                                    <i class="fa fa-star text-warning"></i>
                                                                @else
                                                                    <i class="far fa-star text-warning"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                    <small
                                                        class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                                </div>
                                                @if ($review->title)
                                                    <h6 class="mb-2"><strong>{{ $review->title }}</strong></h6>
                                                @endif
                                                <p class="mb-0">{{ $review->comment }}</p>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-center py-4">
                                            <p class="text-muted">{{ __('messages.productDetail.noReviews') }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Write Review Section -->
                                <div class="write-review-section mt-5 pt-4 border-top">
                                    <h5 class="mb-3">{{ __('messages.productDetail.writeReview') }}</h5>
                                    <form method="POST" action="{{ route('reviews.store') }}">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul class="mb-0">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="mb-3">
                                            <label class="form-label">{{ __('messages.productDetail.yourRating') }} <span
                                                    class="text-danger">*</span></label>
                                            <div class="rating-input">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i class="far fa-star text-warning rating-star"
                                                        data-rating="{{ $i }}"
                                                        style="font-size: 1.5rem; cursor: pointer; margin-right: 5px;"></i>
                                                @endfor
                                            </div>
                                            <input type="hidden" name="rating" id="rating-input"
                                                value="{{ old('rating', 0) }}" required>
                                            @error('rating')
                                                <span class="text-danger"><small>{{ $message }}</small></span>
                                            @enderror
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <label for="reviewName" class="form-label">{{ __('messages.productDetail.yourName') }} <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    id="reviewName" name="name" value="{{ old('name') }}" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label for="reviewEmail" class="form-label">{{ __('messages.productDetail.yourEmail') }}</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    id="reviewEmail" name="email" value="{{ old('email') }}">
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="reviewTitle" class="form-label">{{ __('messages.productDetail.reviewTitle') }}</label>
                                            <input type="text"
                                                class="form-control @error('title') is-invalid @enderror" id="reviewTitle"
                                                name="title" value="{{ old('title') }}"
                                                placeholder="{{ __('messages.productDetail.reviewTitlePlaceholder') }}">
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="reviewText" class="form-label">{{ __('messages.productDetail.yourReview') }} <span
                                                    class="text-danger">*</span></label>
                                            <textarea class="form-control @error('comment') is-invalid @enderror" id="reviewText" name="comment" rows="5"
                                                placeholder="{{ __('messages.productDetail.reviewPlaceholder') }}" required>{{ old('comment') }}</textarea>
                                            <small class="form-text text-muted">{{ __('messages.productDetail.minChars') }}</small>
                                            @error('comment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('messages.productDetail.submitReview') }}</button>
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
                        <h2 class="section-title">{{ __('messages.productDetail.relatedProducts') }}</h2>
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

        // Rating stars functionality
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating-star');
            const ratingInput = document.getElementById('rating-input');

            stars.forEach((star, index) => {
                star.addEventListener('click', function() {
                    const rating = index + 1;
                    ratingInput.value = rating;

                    // Update star display
                    stars.forEach((s, i) => {
                        if (i < rating) {
                            s.classList.remove('far');
                            s.classList.add('fa');
                        } else {
                            s.classList.remove('fa');
                            s.classList.add('far');
                        }
                    });
                });

                star.addEventListener('mouseenter', function() {
                    const rating = index + 1;
                    stars.forEach((s, i) => {
                        if (i < rating) {
                            s.classList.remove('far');
                            s.classList.add('fa');
                        } else {
                            s.classList.remove('fa');
                            s.classList.add('far');
                        }
                    });
                });
            });

            // Reset stars on mouse leave if no rating selected
            document.querySelector('.rating-input').addEventListener('mouseleave', function() {
                const currentRating = parseInt(ratingInput.value) || 0;
                stars.forEach((s, i) => {
                    if (i < currentRating) {
                        s.classList.remove('far');
                        s.classList.add('fa');
                    } else {
                        s.classList.remove('fa');
                        s.classList.add('far');
                    }
                });
            });
        });
    </script>
@endsection
