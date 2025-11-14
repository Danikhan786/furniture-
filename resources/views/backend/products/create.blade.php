@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title mb-0">Add New Product</h4>
                            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">
                                <i class="mdi mdi-arrow-left"></i> Back to Products
                            </a>
                        </div>

                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               placeholder="Enter product name"
                                               required>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category_id">Category <span class="text-danger">*</span></label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" 
                                                id="category_id" 
                                                name="category_id" 
                                                required>
                                            <option value="">Select Category</option>
                                            @foreach($categories ?? [] as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea class="form-control @error('short_description') is-invalid @enderror" 
                                          id="short_description" 
                                          name="short_description" 
                                          rows="3" 
                                          placeholder="Enter short description (max 500 characters)">{{ old('short_description') }}</textarea>
                                <small class="form-text text-muted">Brief description that will appear in product listings (max 500 characters)</small>
                                @error('short_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="long_description">Long Description</label>
                                <textarea class="form-control @error('long_description') is-invalid @enderror" 
                                          id="long_description" 
                                          name="long_description" 
                                          rows="6" 
                                          placeholder="Enter detailed product description">{{ old('long_description') }}</textarea>
                                <small class="form-text text-muted">Detailed description of the product</small>
                                @error('long_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="price">Price ($) <span class="text-danger">*</span></label>
                                        <input type="number" 
                                               class="form-control @error('price') is-invalid @enderror" 
                                               id="price" 
                                               name="price" 
                                               value="{{ old('price') }}" 
                                               step="0.01" 
                                               min="0"
                                               placeholder="0.00"
                                               required>
                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="discount_price">Discount Price ($)</label>
                                        <input type="number" 
                                               class="form-control @error('discount_price') is-invalid @enderror" 
                                               id="discount_price" 
                                               name="discount_price" 
                                               value="{{ old('discount_price') }}" 
                                               step="0.01" 
                                               min="0"
                                               placeholder="0.00">
                                        <small class="form-text text-muted">Discount percent will be calculated automatically</small>
                                        @error('discount_price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stock">Stock Quantity <span class="text-danger">*</span></label>
                                        <input type="number" 
                                               class="form-control @error('stock') is-invalid @enderror" 
                                               id="stock" 
                                               name="stock" 
                                               value="{{ old('stock') }}" 
                                               min="0"
                                               placeholder="0"
                                               required>
                                        @error('stock')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="status">Status <span class="text-danger">*</span></label>
                                        <select class="form-control @error('status') is-invalid @enderror" 
                                                id="status" 
                                                name="status" 
                                                required>
                                            <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="sku">SKU (Stock Keeping Unit)</label>
                                        <input type="text" 
                                               class="form-control @error('sku') is-invalid @enderror" 
                                               id="sku" 
                                               name="sku" 
                                               value="{{ old('sku') }}" 
                                               placeholder="Leave empty to auto-generate">
                                        <small class="form-text text-muted">SKU will be generated automatically if left empty</small>
                                        @error('sku')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" 
                                               class="form-control @error('slug') is-invalid @enderror" 
                                               id="slug" 
                                               name="slug" 
                                               value="{{ old('slug') }}" 
                                               placeholder="Leave empty to auto-generate">
                                        <small class="form-text text-muted">Slug will be generated automatically from product name if left empty</small>
                                        @error('slug')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="image">Main Product Image</label>
                                <input type="file" 
                                       class="form-control-file @error('image') is-invalid @enderror" 
                                       id="image" 
                                       name="image"
                                       accept="image/*">
                                <small class="form-text text-muted">Upload main product image (JPG, PNG, GIF - Max: 2MB)</small>
                                @error('image')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div id="image-preview" class="mt-3" style="display: none;">
                                    <img id="preview-img" src="" alt="Preview" style="max-width: 200px; max-height: 200px; border-radius: 4px; border: 1px solid #ddd;">
                                    <p class="text-muted mt-2">Image Preview</p>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="images">Additional Product Images</label>
                                <input type="file" 
                                       class="form-control-file @error('images.*') is-invalid @enderror" 
                                       id="images" 
                                       name="images[]"
                                       accept="image/*"
                                       multiple>
                                <small class="form-text text-muted">Upload multiple images (JPG, PNG, GIF - Max: 2MB each)</small>
                                @error('images.*')
                                    <span class="invalid-feedback d-block" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <div id="images-preview" class="mt-3 row"></div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <a href="{{ route('admin.products.index') }}" class="btn btn-light mr-2">Cancel</a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="mdi mdi-content-save"></i> Create Product
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Main image preview
        const imageInput = document.getElementById('image');
        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const previewImg = document.getElementById('preview-img');
                const imagePreview = document.getElementById('image-preview');
                
                if (file && previewImg && imagePreview) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        imagePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(file);
                } else if (imagePreview) {
                    imagePreview.style.display = 'none';
                }
            });
        }

        // Multiple images preview
        const imagesInput = document.getElementById('images');
        if (imagesInput) {
            imagesInput.addEventListener('change', function(e) {
                const files = e.target.files;
                const previewContainer = document.getElementById('images-preview');
                previewContainer.innerHTML = '';

                if (files && files.length > 0) {
                    Array.from(files).forEach((file, index) => {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const col = document.createElement('div');
                            col.className = 'col-md-3 mb-3';
                            col.innerHTML = `
                                <div class="position-relative">
                                    <img src="${e.target.result}" alt="Preview ${index + 1}" 
                                         style="width: 100%; height: 150px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                                </div>
                            `;
                            previewContainer.appendChild(col);
                        }
                        reader.readAsDataURL(file);
                    });
                }
            });
        }
    </script>
@endsection
