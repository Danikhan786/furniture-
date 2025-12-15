@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>{{ __('messages.orderLookup.title') }}</h1>
                        <p class="mb-4">{{ __('messages.orderLookup.description') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section before-footer-section">
        <div class="container">
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row justify-content-center">
                <div class="col-lg-6 mb-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">{{ __('messages.orderLookup.findOrder') }}</h5>
                            <form method="POST" action="{{ route('order.lookup.submit') }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="order_number" class="form-label">{{ __('messages.orderLookup.orderNumber') }}</label>
                                    <input type="text" class="form-control" id="order_number" name="order_number" value="{{ old('order_number') }}" placeholder="{{ __('messages.orderLookup.orderNumberPlaceholder') }}" required>
                                    <small class="text-muted">{{ __('messages.orderLookup.orderNumberExample') }}</small>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">{{ __('messages.orderLookup.checkOrder') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if($order)
                <div class="row justify-content-center mt-4">
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h5 class="card-title mb-1">{{ __('messages.orderLookup.order') }} {{ $order->order_number }}</h5>
                                        <p class="text-muted mb-0">{{ __('messages.orderLookup.placedBy') }} {{ $order->first_name }} {{ $order->last_name }}</p>
                                    </div>
                                    <span class="badge bg-secondary text-uppercase">
                                        @if($order->status == 'pending')
                                            {{ __('messages.orderLookup.status.pending') }}
                                        @elseif($order->status == 'processing')
                                            {{ __('messages.orderLookup.status.processing') }}
                                        @elseif($order->status == 'completed')
                                            {{ __('messages.orderLookup.status.completed') }}
                                        @elseif($order->status == 'cancelled')
                                            {{ __('messages.orderLookup.status.cancelled') }}
                                        @else
                                            {{ ucfirst($order->status) }}
                                        @endif
                                    </span>
                                </div>

                                <p class="mb-2"><strong>{{ __('messages.orderLookup.email') }}</strong> {{ $order->email }}</p>
                                <p class="mb-2"><strong>{{ __('messages.orderLookup.phone') }}</strong> {{ $order->phone }}</p>
                                <p class="mb-3">
                                    <strong>{{ __('messages.orderLookup.address') }}</strong> {{ $order->address }}
                                    @if($order->apartment) , {{ $order->apartment }} @endif,
                                    {{ $order->state_country }} {{ $order->postal_zip }}
                                </p>

                                <h6 class="mb-3">{{ __('messages.orderLookup.items') }}</h6>
                                <div class="table-responsive">
                                    <table class="table align-middle">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.orderLookup.product') }}</th>
                                                <th class="text-center">{{ __('messages.orderLookup.qty') }}</th>
                                                <th class="text-end">{{ __('messages.orderLookup.price') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order->items as $item)
                                                <tr>
                                                    <td>{{ $item->product->name ?? __('messages.orderLookup.product') }}</td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td class="text-end">€{{ number_format($item->price * $item->quantity, 2) }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="d-flex justify-content-end">
                                    <div class="text-end">
                                        <p class="mb-1"><strong>{{ __('messages.orderLookup.subtotal') }}</strong> €{{ number_format($order->subtotal, 2) }}</p>
                                        @if($order->discount_amount > 0)
                                            <p class="mb-1"><strong>{{ __('messages.orderLookup.discount') }}</strong> -€{{ number_format($order->discount_amount, 2) }}</p>
                                        @endif
                                        <p class="mb-0 fs-5"><strong>{{ __('messages.orderLookup.total') }}</strong> €{{ number_format($order->total, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

