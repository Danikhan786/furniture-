@extends('layouts.frontend')

@section('content')
    <!-- Start Hero Section -->
    <div class="hero">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-12">
                    <div class="text-center">
                        <h1>{{ __('messages.checkout.title') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Hero Section -->

    <div class="untree_co-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h2 class="h3 mb-3 text-black">{{ __('messages.checkout.billingDetails') }}</h2>
                    <form id="checkout-form" class="p-3 p-lg-5 border bg-white" method="POST" action="{{ route('checkout.store') }}">
                        @csrf
                        <input type="hidden" name="coupon_code" id="coupon_code_input" value="{{ isset($coupon) && $coupon ? $coupon->code : '' }}">
                        
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
                       
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_fname" class="text-black">{{ __('messages.checkout.firstName') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('c_fname') is-invalid @enderror" id="c_fname" name="c_fname" value="{{ old('c_fname') }}">
                                @error('c_fname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="c_lname" class="text-black">{{ __('messages.checkout.lastName') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('c_lname') is-invalid @enderror" id="c_lname" name="c_lname" value="{{ old('c_lname') }}">
                                @error('c_lname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_companyname" class="text-black">{{ __('messages.checkout.companyName') }} </label>
                                <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <label for="c_address" class="text-black">{{ __('messages.checkout.address') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('c_address') is-invalid @enderror" id="c_address" name="c_address"
                                    placeholder="{{ __('messages.checkout.addressPlaceholder') }}" value="{{ old('c_address') }}">
                                @error('c_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <input type="text" class="form-control" name="apartment" placeholder="{{ __('messages.checkout.apartment') }}">
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="c_state_country" class="text-black">{{ __('messages.checkout.stateCountry') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('c_state_country') is-invalid @enderror" id="c_state_country" name="c_state_country" value="{{ old('c_state_country') }}">
                                @error('c_state_country')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="c_postal_zip" class="text-black">{{ __('messages.checkout.postalZip') }} <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('c_postal_zip') is-invalid @enderror" id="c_postal_zip" name="c_postal_zip" value="{{ old('c_postal_zip') }}">
                                @error('c_postal_zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-5">
                            <div class="col-md-6">
                                <label for="c_email_address" class="text-black">{{ __('messages.checkout.email') }} <span
                                        class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('c_email_address') is-invalid @enderror" id="c_email_address" name="c_email_address" value="{{ old('c_email_address') }}">
                                @error('c_email_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="c_phone" class="text-black">{{ __('messages.checkout.phone') }} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('c_phone') is-invalid @enderror" id="c_phone" name="c_phone"
                                    placeholder="{{ __('messages.checkout.phonePlaceholder') }}" value="{{ old('c_phone') }}">
                                @error('c_phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="c_order_notes" class="text-black">{{ __('messages.checkout.orderNotes') }}</label>
                            <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control"
                                placeholder="{{ __('messages.checkout.orderNotesPlaceholder') }}"></textarea>
                        </div>
                    </form>
                </div>
                <div class="col-md-6">

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">{{ __('messages.checkout.couponCode') }}</h2>
                            <div class="p-3 p-lg-5 border bg-white">

                                <label for="c_code" class="text-black mb-3">{{ __('messages.checkout.enterCoupon') }}</label>
                                @if(isset($hasDiscountedProducts) && $hasDiscountedProducts)
                                    <div class="alert alert-warning mb-3">
                                        <small>{{ __('messages.checkout.couponCannotApply') }}</small>
                                    </div>
                                @endif
                                <div class="input-group w-75 couponcode-wrap">
                                    <input type="text" class="form-control me-2" id="c_code" name="coupon_code"
                                        placeholder="{{ __('messages.checkout.couponPlaceholder') }}" aria-label="Coupon Code"
                                        aria-describedby="button-addon2" 
                                        value="{{ old('coupon_code', isset($coupon) ? $coupon->code : '') }}"
                                        {{ (isset($hasDiscountedProducts) && $hasDiscountedProducts) ? 'disabled' : '' }}>
                                    <div class="input-group-append">
                                        <button class="btn btn-black btn-sm" type="button"
                                            id="button-addon2" onclick="applyCoupon()"
                                            {{ (isset($hasDiscountedProducts) && $hasDiscountedProducts) ? 'disabled' : '' }}>{{ __('messages.checkout.apply') }}</button>
                                    </div>
                                </div>
                                <div id="coupon-message" class="mt-2"></div>
                                @if(isset($coupon) && $coupon)
                                    <div class="alert alert-success mt-2">
                                        <strong>{{ __('messages.checkout.couponApplied') }}:</strong> {{ $coupon->name }} ({{ $coupon->discount_percent }}% OFF)
                                        <button type="button" class="btn btn-sm text-decoration-none btn-link p-2 ml-2" onclick="removeCoupon()">{{ __('messages.checkout.remove') }}</button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-md-12">
                            <h2 class="h3 mb-3 text-black">{{ __('messages.checkout.yourOrder') }}</h2>
                            <div class="p-3 p-lg-5 border bg-white">
                                @if(isset($cartItems) && $cartItems->count() > 0)
                                    <table class="table site-block-order-table mb-5">
                                        <thead>
                                            <th>{{ __('messages.checkout.product') }}</th>
                                            <th>{{ __('messages.checkout.total') }}</th>
                                        </thead>
                                        <tbody>
                                            @foreach($cartItems as $item)
                                                <tr>
                                                    <td>
                                                        @if($item->product)
                                                            {{ $item->product->name }} <strong class="mx-2">x</strong> {{ $item->quantity }}
                                                        @else
                                                            {{ __('messages.cart.productNotAvailable') }} <strong class="mx-2">x</strong> {{ $item->quantity }}
                                                        @endif
                                                    </td>
                                                    <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>{{ __('messages.checkout.cartSubtotal') }}</strong></td>
                                                <td class="text-black">${{ number_format($subtotal ?? 0, 2) }}</td>
                                            </tr>
                                            @if(isset($coupon) && $coupon && isset($discountAmount) && $discountAmount > 0)
                                            <tr>
                                                <td class="text-black">
                                                    <strong>{{ __('messages.checkout.couponDiscount') }} ({{ $coupon->code }})</strong>
                                                    <br><small class="text-success">{{ $coupon->discount_percent }}% OFF</small>
                                                </td>
                                                <td class="text-success">-${{ number_format($discountAmount, 2) }}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td class="text-black font-weight-bold"><strong>{{ __('messages.checkout.orderTotal') }}</strong></td>
                                                <td class="text-black font-weight-bold"><strong>${{ number_format($total ?? 0, 2) }}</strong></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @else
                                    <div class="alert alert-warning">
                                        <p>{{ __('messages.checkout.cartEmpty') }} <a href="{{ route('shop') }}">{{ __('messages.checkout.continueShopping') }}</a></p>
                                    </div>
                                @endif


                                <div class="border p-3 mb-3">
                                    <h3 class="h6 mb-0"><a class="d-block" data-bs-toggle="collapse"
                                            href="#collapsecheque" role="button" aria-expanded="false"
                                            aria-controls="collapsecheque">{{ __('messages.checkout.cashOnDelivery') }}</a></h3>

                                    <div class="collapse" id="collapsecheque">
                                        <div class="py-2">
                                            <p class="mb-0">{{ __('messages.checkout.cashOnDeliveryDesc') }}</p>
                                        </div>
                                    </div>
                                </div>



                                @if(isset($cartItems) && $cartItems->count() > 0)
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-black btn-sm py-3 btn-block" form="checkout-form">{{ __('messages.checkout.placeOrder') }}</button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function applyCoupon() {
            const couponCode = document.getElementById('c_code').value.trim();
            const messageDiv = document.getElementById('coupon-message');
            const button = document.getElementById('button-addon2');
            
            if (!couponCode) {
                messageDiv.innerHTML = '<div class="alert alert-danger">{{ __('messages.checkout.pleaseEnterCoupon') }}</div>';
                return;
            }

            button.disabled = true;
            button.textContent = '{{ __('messages.checkout.applying') }}';
            messageDiv.innerHTML = '';

            fetch('{{ route("checkout.validateCoupon") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    coupon_code: couponCode
                })
            })
            .then(async response => {
                const contentType = response.headers.get("content-type");
                if (contentType && contentType.includes("application/json")) {
                    const data = await response.json();
                    if (!response.ok) {
                        throw new Error(data.message || 'Invalid response from server');
                    }
                    return data;
                } else {
                    const text = await response.text();
                    throw new Error('Server returned non-JSON response: ' + text.substring(0, 100));
                }
            })
            .then(data => {
                if (data.success) {
                    messageDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                    const couponInput = document.getElementById('coupon_code_input');
                    if (couponInput) {
                        couponInput.value = data.coupon.code;
                    }
                    // Reload page to show updated totals
                    setTimeout(() => {
                        window.location.href = '{{ route("checkout") }}?coupon_code=' + encodeURIComponent(couponCode);
                    }, 1000);
                } else {
                    messageDiv.innerHTML = '<div class="alert alert-danger">' + (data.message || 'Error applying coupon') + '</div>';
                }
            })
            .catch(error => {
                console.error('Coupon Error:', error);
                messageDiv.innerHTML = '<div class="alert alert-danger">' + (error.message || 'An error occurred. Please try again.') + '</div>';
            })
            .finally(() => {
                button.disabled = false;
                button.textContent = '{{ __('messages.checkout.apply') }}';
            });
        }

        function removeCoupon() {
            window.location.href = '{{ route("checkout") }}';
        }
    </script>
@endsection

