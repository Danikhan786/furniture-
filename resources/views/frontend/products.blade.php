@extends('layouts.frontend')

@section('content')
    <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner"
        style="background-image:url(frontend/images/img_bg_2.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2 text-center">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeIn">
                            <h1>Product</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div id="fh5co-product">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <span>Cool Stuff</span>
                    <h2>Products.</h2>
                    <p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit
                        ab aliquam dolor eius.</p>
                </div>
            </div>
            <div class="row">

  <!-- Right Side - Filters -->
  <div class="col-md-3 animate-box">
    <div class="filter-sidebar">
        <!-- Category Filter -->
        <div class="filter-section">
            <h3 class="filter-title">
                <i class="icon-list"></i> Categories
            </h3>
            <div class="filter-content">
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="category" value="chairs" checked>
                        Chairs
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="category" value="tables">
                        Tables
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="category" value="sofas">
                        Sofas
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="category" value="cabinets">
                        Cabinets
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="category" value="lighting">
                        Lighting
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="category" value="decor">
                        Decor
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="category" value="accessories">
                        Accessories
                    </label>
                </div>
            </div>
        </div>

        <!-- Price Filter -->
        <div class="filter-section">
            <h3 class="filter-title">
                <i class="icon-tag"></i> Price Range
            </h3>
            <div class="filter-content">
                <div class="price-inputs">
                    <div class="form-group">
                        <label for="min_price">Min Price ($)</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" min="0" value="0" placeholder="0">
                    </div>
                    <div class="form-group">
                        <label for="max_price">Max Price ($)</label>
                        <input type="number" class="form-control" id="max_price" name="max_price" min="0" value="1000" placeholder="1000">
                    </div>
                </div>
                <div class="price-range-slider">
                    <input type="range" class="form-control-range" id="price_range" min="0" max="2000" value="1000" step="50">
                    <div class="price-display">
                        <span id="price_min_display">$0</span> - <span id="price_max_display">$1000</span>
                    </div>
                </div>
                <div class="price-presets">
                    <button type="button" class="btn btn-sm btn-default price-preset" data-min="0" data-max="100">$0 - $100</button>
                    <button type="button" class="btn btn-sm btn-default price-preset" data-min="100" data-max="300">$100 - $300</button>
                    <button type="button" class="btn btn-sm btn-default price-preset" data-min="300" data-max="500">$300 - $500</button>
                    <button type="button" class="btn btn-sm btn-default price-preset" data-min="500" data-max="1000">$500 - $1000</button>
                    <button type="button" class="btn btn-sm btn-default price-preset" data-min="1000" data-max="2000">$1000+</button>
                </div>
            </div>
        </div>

        <!-- Filter Actions -->
        <div class="filter-actions">
            <button type="button" class="btn btn-primary btn-block" onclick="applyFilters()">
                <i class="icon-check"></i> Apply Filters
            </button>
            <button type="button" class="btn btn-default btn-block" onclick="resetFilters()">
                <i class="icon-refresh"></i> Reset
            </button>
        </div>
    </div>
</div>


                <!-- Left Side - Products -->
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-1.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">Hauteville Concrete Rocking Chair</a></h3>
                                <span class="price">$350</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-2.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">Pavilion Speaker</a></h3>
                                <span class="price">$600</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-3.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">Ligomancer</a></h3>
                                <span class="price">$780</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-4.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">Alato Cabinet</a></h3>
                                <span class="price">$800</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-5.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">Earing Wireless</a></h3>
                                <span class="price">$100</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-6.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">Sculptural Coffee Table</a></h3>
                                <span class="price">$960</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-7.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">The WW Chair</a></h3>
                                <span class="price">$540</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-8.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">Himitsu Money Box</a></h3>
                                <span class="price">$55</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 text-center animate-box">
                        <div class="product">
                            <div class="product-grid" style="background-image:url(frontend/images/product-9.jpg);">
                                <div class="inner">
                                    <p>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-shopping-cart"></i></a>
                                        <a href="{{ route('productDetail') }}" class="icon"><i class="icon-eye"></i></a>
                                    </p>
                                </div>
                            </div>
                            <div class="desc">
                                <h3><a href="{{ route('productDetail') }}">Ariane Prin</a></h3>
                                <span class="price">$99</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>


    <style>
        .filter-sidebar {
            background-color: #fff;
            padding: 25px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: sticky;
            top: 20px;
        }
        .filter-section {
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 1px solid #e0e0e0;
        }
        .filter-section:last-child {
            border-bottom: none;
            margin-bottom: 20px;
        }
        .filter-title {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 15px;
            color: #333;
        }
        .filter-title i {
            margin-right: 8px;
            color: #337ab7;
        }
        .filter-content {
            margin-top: 15px;
        }
        .filter-content .checkbox {
            margin-bottom: 12px;
        }
        .filter-content .checkbox label {
            font-weight: normal;
            cursor: pointer;
            color: #555;
            font-size: 14px;
        }
        .filter-content .checkbox input[type="checkbox"] {
            margin-right: 8px;
        }
        .price-inputs {
            margin-bottom: 15px;
        }
        .price-inputs .form-group {
            margin-bottom: 15px;
        }
        .price-inputs label {
            font-size: 13px;
            font-weight: 500;
            color: #555;
            margin-bottom: 5px;
        }
        .price-inputs .form-control {
            padding: 8px 12px;
            font-size: 14px;
        }
        .price-range-slider {
            margin-bottom: 15px;
        }
        .price-range-slider input[type="range"] {
            width: 100%;
            margin-bottom: 10px;
        }
        .price-display {
            text-align: center;
            font-weight: 600;
            color: #337ab7;
            font-size: 14px;
        }
        .price-presets {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .price-presets .btn {
            text-align: left;
            font-size: 13px;
            padding: 8px 12px;
        }
        .price-presets .btn.active {
            background-color: #337ab7;
            color: #fff;
            border-color: #337ab7;
        }
        .filter-actions {
            margin-top: 20px;
        }
        .filter-actions .btn {
            margin-bottom: 10px;
        }
        @media (max-width: 768px) {
            .filter-sidebar {
                position: relative;
                top: 0;
                margin-top: 30px;
            }
        }
    </style>

    <script>
        // Price range slider
        const priceRange = document.getElementById('price_range');
        const minPriceInput = document.getElementById('min_price');
        const maxPriceInput = document.getElementById('max_price');
        const priceMinDisplay = document.getElementById('price_min_display');
        const priceMaxDisplay = document.getElementById('price_max_display');

        // Update price display when slider changes
        if (priceRange) {
            priceRange.addEventListener('input', function() {
                const maxValue = this.value;
                maxPriceInput.value = maxValue;
                priceMaxDisplay.textContent = '$' + maxValue;
            });
        }

        // Update slider when input changes
        if (minPriceInput) {
            minPriceInput.addEventListener('input', function() {
                priceMinDisplay.textContent = '$' + this.value;
            });
        }

        if (maxPriceInput) {
            maxPriceInput.addEventListener('input', function() {
                priceRange.value = this.value;
                priceMaxDisplay.textContent = '$' + this.value;
            });
        }

        // Price preset buttons
        document.querySelectorAll('.price-preset').forEach(function(btn) {
            btn.addEventListener('click', function() {
                // Remove active class from all buttons
                document.querySelectorAll('.price-preset').forEach(function(b) {
                    b.classList.remove('active');
                });
                // Add active class to clicked button
                this.classList.add('active');
                // Set price values
                minPriceInput.value = this.dataset.min;
                maxPriceInput.value = this.dataset.max;
                priceRange.value = this.dataset.max;
                priceMinDisplay.textContent = '$' + this.dataset.min;
                priceMaxDisplay.textContent = '$' + this.dataset.max;
            });
        });

        // Apply filters
        function applyFilters() {
            const selectedCategories = [];
            document.querySelectorAll('input[name="category"]:checked').forEach(function(checkbox) {
                selectedCategories.push(checkbox.value);
            });

            const minPrice = minPriceInput.value;
            const maxPrice = maxPriceInput.value;

            // Here you would typically make an AJAX call to filter products
            // Example:
            /*
            fetch('/products/filter', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    categories: selectedCategories,
                    min_price: minPrice,
                    max_price: maxPrice
                })
            })
            .then(response => response.json())
            .then(data => {
                // Update product list
                console.log('Filters applied:', data);
            });
            */

            // Demo: Show alert
            alert('Filters applied!\nCategories: ' + (selectedCategories.length > 0 ? selectedCategories.join(', ') : 'All') + 
                  '\nPrice Range: $' + minPrice + ' - $' + maxPrice);
        }

        // Reset filters
        function resetFilters() {
            // Uncheck all category checkboxes
            document.querySelectorAll('input[name="category"]').forEach(function(checkbox) {
                checkbox.checked = false;
            });
            // Reset price inputs
            minPriceInput.value = 0;
            maxPriceInput.value = 1000;
            priceRange.value = 1000;
            priceMinDisplay.textContent = '$0';
            priceMaxDisplay.textContent = '$1000';
            // Remove active class from preset buttons
            document.querySelectorAll('.price-preset').forEach(function(btn) {
                btn.classList.remove('active');
            });
        }
    </script>
@endsection
