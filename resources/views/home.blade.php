@extends('layouts.frontend')
  
@section('content')
<!-- Start Hero Section -->
<div class="hero">
<div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-12">
                <div class="text-center">
                    <h1>My Dashboard</h1>
                    <p class="mb-4">Welcome back, {{ Auth::user()->name }}! Manage your orders and view your account details.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Hero Section -->

<!-- Start Dashboard Section -->
<div class="untree_co-section">
    <div class="container">
                    @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

        <!-- Statistics Cards -->
        <div class="row mb-5">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center p-4" style="border-left: 4px solid #4c84ff;">
                    <h3 class="mb-2">{{ $totalOrders ?? 0 }}</h3>
                    <p class="text-muted mb-0">Total Orders</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center p-4" style="border-left: 4px solid #28a745;">
                    <h3 class="mb-2">${{ number_format($totalSpent ?? 0, 2) }}</h3>
                    <p class="text-muted mb-0">Total Spent</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center p-4" style="border-left: 4px solid #ffc107;">
                    <h3 class="mb-2">{{ $pendingOrders ?? 0 }}</h3>
                    <p class="text-muted mb-0">Pending Orders</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center p-4" style="border-left: 4px solid #17a2b8;">
                    <h3 class="mb-2">{{ $completedOrders ?? 0 }}</h3>
                    <p class="text-muted mb-0">Completed Orders</p>
                </div>
            </div>
        </div>

        <!-- Orders Section -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-shopping-bag me-2"></i>My Orders</h4>
                    </div>
                    <div class="card-body">
                        @if($orders->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Order Number</th>
                                            <th>Date</th>
                                            <th>Items</th>
                                            <th>Total</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>
                                                    <strong>{{ $order->order_number }}</strong>
                                                </td>
                                                <td>
                                                    {{ $order->created_at->format('M d, Y') }}
                                                    <br>
                                                    <small class="text-muted">{{ $order->created_at->format('h:i A') }}</small>
                                                </td>
                                                <td>
                                                    {{ $order->items->count() }} item(s)
                                                    <br>
                                                    <small class="text-muted">
                                                        @foreach($order->items->take(2) as $item)
                                                            {{ $item->product->name ?? 'Product Deleted' }}{{ !$loop->last ? ', ' : '' }}
                                                        @endforeach
                                                        @if($order->items->count() > 2)
                                                            +{{ $order->items->count() - 2 }} more
                                                        @endif
                                                    </small>
                                                </td>
                                                <td>
                                                    <strong>${{ number_format($order->total, 2) }}</strong>
                                                    @if($order->discount_amount > 0)
                                                        <br>
                                                        <small class="text-success">
                                                            Saved: ${{ number_format($order->discount_amount, 2) }}
                                                        </small>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($order->status == 'pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @elseif($order->status == 'processing')
                                                        <span class="badge bg-info">Processing</span>
                                                    @elseif($order->status == 'completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @elseif($order->status == 'cancelled')
                                                        <span class="badge bg-danger">Cancelled</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-primary" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#orderModal{{ $order->id }}">
                                                        <i class="fas fa-eye"></i> View Details
                                                    </button>
                                                </td>
                                            </tr>

                                            <!-- Order Details Modal -->
                                            <div class="modal fade" id="orderModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderModalLabel{{ $order->id }}" aria-hidden="true">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-primary text-white">
                                                            <h5 class="modal-title" id="orderModalLabel{{ $order->id }}">
                                                                Order Details - {{ $order->order_number }}
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- Order Status -->
                                                            <div class="mb-4">
                                                                <h6>Order Status</h6>
                                                                <p>
                                                                    @if($order->status == 'pending')
                                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                                    @elseif($order->status == 'processing')
                                                                        <span class="badge bg-info">Processing</span>
                                                                    @elseif($order->status == 'completed')
                                                                        <span class="badge bg-success">Completed</span>
                                                                    @elseif($order->status == 'cancelled')
                                                                        <span class="badge bg-danger">Cancelled</span>
                                                                    @endif
                                                                </p>
                                                                <small class="text-muted">Order placed on {{ $order->created_at->format('F d, Y h:i A') }}</small>
                                                            </div>

                                                            <!-- Billing Details -->
                                                            <div class="mb-4">
                                                                <h6>Billing Details</h6>
                                                                <table class="table table-sm table-borderless">
                                                                    <tr>
                                                                        <th width="30%">Name:</th>
                                                                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Email:</th>
                                                                        <td>{{ $order->email }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Phone:</th>
                                                                        <td>{{ $order->phone }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Address:</th>
                                                                        <td>
                                                                            {{ $order->address }}<br>
                                                                            @if($order->apartment)
                                                                                {{ $order->apartment }}<br>
                                                                            @endif
                                                                            {{ $order->state_country }}, {{ $order->postal_zip }}
                                                                        </td>
                                                                    </tr>
                                                                    @if($order->company_name)
                                                                    <tr>
                                                                        <th>Company:</th>
                                                                        <td>{{ $order->company_name }}</td>
                                                                    </tr>
                                                                    @endif
                                                                    <tr>
                                                                        <th>Payment Method:</th>
                                                                        <td>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</td>
                                                                    </tr>
                                                                </table>
                                                            </div>

                                                            <!-- Order Items -->
                                                            <div class="mb-4">
                                                                <h6>Order Items</h6>
                                                                <table class="table table-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Product</th>
                                                                            <th>Quantity</th>
                                                                            <th>Price</th>
                                                                            <th>Total</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($order->items as $item)
                                                                            <tr>
                                                                                <td>
                                                                                    @if($item->product)
                                                                                        <div class="d-flex align-items-center">
                                                                                            @if($item->product->image)
                                                                                                <img src="{{ asset($item->product->image) }}" 
                                                                                                     alt="{{ $item->product->name }}" 
                                                                                                     style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 4px;">
                                                                                            @elseif($item->product->images && $item->product->images->count() > 0)
                                                                                                <img src="{{ asset($item->product->images->first()->image) }}" 
                                                                                                     alt="{{ $item->product->name }}" 
                                                                                                     style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 4px;">
                                                                                            @else
                                                                                                <img src="{{ asset('frontend/images/product-1.png') }}" 
                                                                                                     alt="{{ $item->product->name }}" 
                                                                                                     style="width: 50px; height: 50px; object-fit: cover; margin-right: 10px; border-radius: 4px;">
                                                                                            @endif
                                                                                            <span>{{ $item->product->name }}</span>
                                                                                        </div>
                                                                                    @else
                                                                                        Product Deleted
                                                                                    @endif
                                                                                </td>
                                                                                <td>{{ $item->quantity }}</td>
                                                                                <td>${{ number_format($item->price, 2) }}</td>
                                                                                <td>${{ number_format($item->total, 2) }}</td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                            <!-- Order Summary -->
                                                            <div class="mb-4">
                                                                <h6>Order Summary</h6>
                                                                <table class="table table-sm table-borderless">
                                                                    <tr>
                                                                        <th width="50%">Subtotal:</th>
                                                                        <td class="text-end">${{ number_format($order->subtotal, 2) }}</td>
                                                                    </tr>
                                                                    @if($order->discount_amount > 0)
                                                                    <tr>
                                                                        <th>Discount 
                                                                            @if($order->coupon_code)
                                                                                ({{ $order->coupon_code }})
                                                                            @endif
                                                                        </th>
                                                                        <td class="text-end text-success">-${{ number_format($order->discount_amount, 2) }}</td>
                                                                    </tr>
                                                                    @endif
                                                                    <tr class="border-top">
                                                                        <th><strong>Total:</strong></th>
                                                                        <td class="text-end"><strong>${{ number_format($order->total, 2) }}</strong></td>
                                                                    </tr>
                                                                </table>
                                                            </div>

                                                            @if($order->order_notes)
                                                            <div class="mb-4">
                                                                <h6>Order Notes</h6>
                                                                <p class="text-muted">{{ $order->order_notes }}</p>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="mt-4">
                                {{ $orders->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-shopping-bag fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">No orders yet</h5>
                                <p class="text-muted">Start shopping to see your orders here!</p>
                                <a href="{{ route('shop') }}" class="btn btn-primary mt-3">
                                    <i class="fas fa-shopping-cart me-2"></i>Go Shopping
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Dashboard Section -->
@endsection