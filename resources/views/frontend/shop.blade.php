@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>{{ __('messages.shop.title') }}</h1>
                        <p class="mb-4">{{ __('messages.shop.description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section product-section before-footer-section">
        <div class="container">
            <div class="row">
                <!-- Sidebar Filters -->
                <div class="col-lg-3 mb-5 mb-lg-0">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <i class="fa fa-filter me-2"></i>{{ __('messages.shop.filters') }}
                            </h5>
                            
                            <!-- Filter Form -->
                            <form action="{{ route('shop') }}" method="GET" id="filterForm">
                                <!-- Category Filter -->
                                <div class="mb-4">
                                    <h6 class="mb-3">{{ __('messages.shop.categories') }}</h6>
                                    @foreach($parentCategories ?? [] as $category)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="categories[]" id="category_{{ $category->id }}" 
                                                   value="{{ $category->id }}" 
                                                   {{ in_array($category->id, (array)request('categories', [])) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="category_{{ $category->id }}">
                                                <strong>{{ $category->name }}</strong>
                                                @if($category->children->count() > 0)
                                                    <small class="text-muted">({{ $category->children->count() }})</small>
                                                @endif
                                            </label>
                                        </div>
                                        @foreach($category->children->where('status', 'active') as $subcategory)
                                            <div class="form-check mb-2 ms-4">
                                                <input class="form-check-input" type="checkbox" name="categories[]" id="category_{{ $subcategory->id }}" 
                                                       value="{{ $subcategory->id }}" 
                                                       {{ in_array($subcategory->id, (array)request('categories', [])) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="category_{{ $subcategory->id }}">
                                                    {{ $subcategory->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>

                                <!-- Price Filter -->
                                <div class="mb-4">
                                    <h6 class="mb-3">{{ __('messages.shop.priceRange') }}</h6>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label for="min_price" class="form-label small">{{ __('messages.shop.minPrice') }}</label>
                                            <input type="number" 
                                                   class="form-control form-control-sm" 
                                                   id="min_price" 
                                                   name="min_price" 
                                                   placeholder="0" 
                                                   min="0" 
                                                   step="0.01"
                                                   value="{{ request('min_price') }}">
                                        </div>
                                        <div class="col-6">
                                            <label for="max_price" class="form-label small">{{ __('messages.shop.maxPrice') }}</label>
                                            <input type="number" 
                                                   class="form-control form-control-sm" 
                                                   id="max_price" 
                                                   name="max_price" 
                                                   placeholder="9999" 
                                                   min="0" 
                                                   step="0.01"
                                                   value="{{ request('max_price') }}">
                                        </div>
                                    </div>
                                </div>

                                <!-- Filter Buttons -->
                                <div class="d-grid gap-2">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-search me-1"></i>{{ __('messages.shop.applyFilters') }}
                                    </button>
                                    @if(request('categories') || request('min_price') || request('max_price'))
                                        <a href="{{ route('shop') }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fa fa-times me-1"></i>{{ __('messages.shop.clearFilters') }}
                                        </a>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-lg-9">
                    @if(isset($products) && $products->count() > 0)
                        <!-- Results Info -->
                        @if(request('categories') || request('min_price') || request('max_price'))
                            <div class="alert alert-info mb-4">
                                <i class="fa fa-info-circle me-2"></i>
                                {{ __('messages.shop.showingResults') }} {{ $products->total() }} {{ $products->total() == 1 ? __('messages.shop.result') : __('messages.shop.results') }}
                                @if(request('categories'))
                                    @php
                                        $selectedCategoryIds = (array)request('categories', []);
                                        $selectedCategoryNames = $categories->whereIn('id', $selectedCategoryIds)->pluck('name')->toArray();
                                    @endphp
                                    @if(count($selectedCategoryNames) > 0)
                                        {{ __('messages.shop.in') }} 
                                        @foreach($selectedCategoryNames as $index => $name)
                                            <strong>{{ $name }}</strong>@if($index < count($selectedCategoryNames) - 1), @endif
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                        @endif

                        <div class="row">
                            @foreach($products as $product)
                                <div class="col-12 col-md-6 col-lg-4 mb-5">
                                    <a class="product-item" href="{{ route('productDetail', $product->slug) }}">
                                        @if($product->image)
                                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid product-thumbnail">
                                        @else
                                            <img src="frontend/images/product-1.png" alt="{{ $product->name }}" class="img-fluid product-thumbnail">
                                        @endif
                                        <h3 class="product-title">{{ $product->name }}</h3>
                                        <strong class="product-price">
                                            @if($product->discount_price)
                                                <span class="text-danger">€{{ number_format($product->discount_price, 2) }}</span>
                                                <span class="text-muted text-decoration-line-through ms-2" style="font-size: 0.9rem;">€{{ number_format($product->price, 2) }}</span>
                                            @else
                                                €{{ number_format($product->price, 2) }}
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
                                        {{ $products->links('pagination.custom') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="row">
                            <div class="col-12 text-center py-5">
                                <h3 class="text-muted">{{ __('messages.shop.noProductsFound') }}</h3>
                                <p class="text-muted">
                                    @if(request('categories') || request('min_price') || request('max_price'))
                                        {{ __('messages.shop.tryAdjusting') }} 
                                        <a href="{{ route('shop') }}">{{ __('messages.shop.viewAllProducts') }}</a>
                                    @else
                                        {{ __('messages.shop.checkBackLater') }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
