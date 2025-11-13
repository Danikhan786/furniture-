@extends('layouts.backend')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h4 class="card-title mb-0">Products</h4>
                            <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">
                                <i class="mdi mdi-plus"></i> Add New Product
                            </a>
                        </div>
                        
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @forelse($products ?? [] as $product) --}}
                                        <tr>
                                            <td>{{ $product->id ?? 'N/A' }}</td>
                                          
                                            <td>{{ $product->name ?? 'Product Name' }}</td>
                                           
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('admin.products.edit', $product->id ?? 1) }}" 
                                                       class="btn btn-sm btn-info" 
                                                       title="Edit">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                    <form action="{{ route('admin.products.destroy', $product->id ?? 1) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this product?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete">
                                                            <i class="mdi mdi-delete"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    {{-- @empty --}}
                                        {{-- <tr>
                                            <td colspan="8" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="mdi mdi-package-variant" style="font-size: 48px;"></i>
                                                    <p class="mt-2">No products found</p>
                                                    <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm mt-2">
                                                        <i class="mdi mdi-plus"></i> Add Your First Product
                                                    </a>
                                                </div>
                                            </td>
                                        </tr> --}}
                                    {{-- @endforelse --}}
                                </tbody>
                            </table>
                        </div>

                        @if(isset($products) && $products->hasPages())
                            <div class="mt-4">
                                {{ $products->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
