@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>Shop</h1>
                        <p class="mb-4">Browse our collection of premium furniture</p>
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
                                <i class="fa fa-filter me-2"></i>Filters
                            </h5>
                            
                            <!-- Filter Form -->
                            <form action="{{ route('shop') }}" method="GET" id="filterForm">
                                <!-- Category Filter -->
                                <div class="mb-4">
                                    <h6 class="mb-3">Categories</h6>
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
                                    <h6 class="mb-3">Price Range</h6>
                                    <div class="row g-2">
                                        <div class="col-6">
                                            <label for="min_price" class="form-label small">Min Price ($)</label>
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
                                            <label for="max_price" class="form-label small">Max Price ($)</label>
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
                                        <i class="fa fa-search me-1"></i>Apply Filters
                                    </button>
                                    @if(request('categories') || request('min_price') || request('max_price'))
                                        <a href="{{ route('shop') }}" class="btn btn-outline-secondary btn-sm">
                                            <i class="fa fa-times me-1"></i>Clear Filters
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
                                Showing {{ $products->total() }} {{ Str::plural('result', $products->total()) }}
                                @if(request('categories'))
                                    @php
                                        $selectedCategoryIds = (array)request('categories', []);
                                        $selectedCategoryNames = $categories->whereIn('id', $selectedCategoryIds)->pluck('name')->toArray();
                                    @endphp
                                    @if(count($selectedCategoryNames) > 0)
                                        in 
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
                                <h3 class="text-muted">No products found</h3>
                                <p class="text-muted">
                                    @if(request('categories') || request('min_price') || request('max_price'))
                                        Try adjusting your filters or 
                                        <a href="{{ route('shop') }}">view all products</a>
                                    @else
                                        Check back later for new arrivals!
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
