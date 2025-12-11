@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center text-white">
                        <h1>{{ __('messages.thankyou.title') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center pt-5">
                    <span class="display-3 thankyou-icon text-success mb-4">
                        <i class="fa fa-check-circle" style="font-size: 5rem;"></i>
                    </span>
                    <h2 class="display-4 text-black mb-3">{{ __('messages.thankyou.orderPlaced') }}</h2>
                    
                    @if(session('order_number'))
                        <div class="alert alert-success d-inline-block mb-4">
                            <h4 class="mb-2">{{ __('messages.thankyou.orderNumber') }} <strong>{{ session('order_number') }}</strong></h4>
                            <p class="mb-0">{{ __('messages.thankyou.orderProcessed') }}</p>
                        </div>
                    @else
                        <p class="lead mb-4">{{ __('messages.thankyou.orderCompleted') }}</p>
                    @endif
                    
                    <p class="mb-4">{{ __('messages.thankyou.orderReceived') }}</p>
                    
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <a href="{{ route('shop') }}" class="btn btn-primary btn-lg">
                            <i class="fa fa-shopping-bag me-2"></i> {{ __('messages.thankyou.continueShopping') }}
                        </a>
                        <a href="{{ route('index') }}" class="btn btn-outline-black btn-lg">
                            <i class="fa fa-home me-2"></i> {{ __('messages.thankyou.backToHome') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection