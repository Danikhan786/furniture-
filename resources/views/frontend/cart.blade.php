@extends('layouts.frontend')

@section('content')
	<!-- Start Hero Section -->
	<div class="hero">
			<div class="container">
					<div class="row justify-content-between">
							<div class="col-lg-12	">
									<div class="text-center">
											<h1>{{ __('messages.cart.title') }}</h1>
									</div>
							</div>
					</div>
			</div>
	</div>
	<!-- End Hero Section -->



	<div class="untree_co-section before-footer-section">
			<div class="container">
					@if(session('success'))
						<div class="alert alert-success alert-dismissible fade show" role="alert">
							{{ session('success') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					@if(session('error'))
						<div class="alert alert-danger alert-dismissible fade show" role="alert">
							{{ session('error') }}
							<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
					@endif
					@if(isset($cartItems) && $cartItems->count() > 0)
						<form method="POST" action="{{ route('cart.updateAll') }}">
							@csrf
							@method('PUT')
							<div class="row mb-5">
									<div class="col-md-12">
											<div class="site-blocks-table">
													<table class="table">
															<thead>
																	<tr>
																			<th class="product-thumbnail">{{ __('messages.cart.image') }}</th>
																			<th class="product-name">{{ __('messages.cart.product') }}</th>
																			<th class="product-price">{{ __('messages.cart.price') }}</th>
																			<th class="product-quantity">{{ __('messages.cart.quantity') }}</th>
																			<th class="product-total">{{ __('messages.cart.total') }}</th>
																			<th class="product-remove">{{ __('messages.cart.remove') }}</th>
																	</tr>
															</thead>
															<tbody>
																	@foreach($cartItems as $item)
																			<tr>
																					<td class="product-thumbnail">
																							@if($item->product && $item->product->image)
																									<img src="{{ asset($item->product->image) }}" alt="{{ $item->product->name }}" class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
																							@else
																									<img src="frontend/images/product-1.png" alt="Product" class="img-fluid" style="width: 80px; height: 80px; object-fit: cover;">
																							@endif
																					</td>
																					<td class="product-name">
																							@if($item->product)
																									<h2 class="h5 text-black">
																											<a href="{{ route('productDetail', $item->product->slug) }}">{{ $item->product->name }}</a>
																									</h2>
																							@else
																									<h2 class="h5 text-black">{{ __('messages.cart.productNotAvailable') }}</h2>
																							@endif
																					</td>
																					<td class="product-price">${{ number_format($item->price, 2) }}</td>
																					<td>
																							<div class="input-group mb-3 d-flex align-items-center quantity-container" style="max-width: 120px;">
																									<div class="input-group-prepend">
																											<button class="btn btn-outline-black decrease" type="button" onclick="return decreaseQty({{ $item->id }}, event)">&minus;</button>
																									</div>
																									<input type="number" 
																											name="quantities[{{ $item->id }}]"
																											class="form-control text-center quantity-amount" 
																											id="qty-{{ $item->id }}"
																											value="{{ $item->quantity }}" 
																											min="1" 
																											max="{{ $item->product ? $item->product->stock : 1 }}"
																											step="1"
																											onchange="updateTotal({{ $item->id }})">
																									<div class="input-group-append">
																											<button class="btn btn-outline-black increase" type="button" onclick="return increaseQty({{ $item->id }}, {{ $item->product ? $item->product->stock : 1 }}, event)">&plus;</button>
																									</div>
																							</div>
																					</td>
																					<td class="product-total" id="item-total-{{ $item->id }}" data-price="{{ $item->price }}">${{ number_format($item->price * $item->quantity, 2) }}</td>
																					<td>
																							<a href="{{ route('cart.remove', $item->id) }}" class="btn btn-black btn-sm" onclick="return confirm('{{ __('messages.cart.removeConfirm') }}')">X</a>
																					</td>
																			</tr>
																	@endforeach
															</tbody>
													</table>
											</div>
									</div>
							</div>

							<div class="row">
									<div class="col-md-6">
											<div class="row mb-5">
													<div class="col-md-6 mb-3 mb-md-0">
															<button type="submit" class="btn btn-black btn-sm btn-block">{{ __('messages.cart.updateCart') }}</button>
													</div>
													<div class="col-md-6">
															<a href="{{ route('shop') }}" class="btn btn-outline-black btn-sm btn-block">{{ __('messages.cart.continueShopping') }}</a>
													</div>
											</div>
									</div>
									<div class="col-md-6 pl-5">
											<div class="row justify-content-end">
													<div class="col-md-7">
															<div class="row">
																	<div class="col-md-12 text-right border-bottom mb-5">
																			<h3 class="text-black h4 text-uppercase">{{ __('messages.cart.cartTotals') }}</h3>
																	</div>
															</div>
															<div class="row mb-3">
																	<div class="col-md-6">
																			<span class="text-black">{{ __('messages.cart.subtotal') }}</span>
																	</div>
																	<div class="col-md-6 text-right">
																			<strong class="text-black" id="cart-subtotal">${{ number_format($cartItems->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</strong>
																	</div>
															</div>
															<div class="row mb-5">
																	<div class="col-md-6">
																			<span class="text-black">{{ __('messages.cart.total') }}</span>
																	</div>
																	<div class="col-md-6 text-right">
																			<strong class="text-black" id="cart-total">${{ number_format($cartItems->sum(function($item) { return $item->price * $item->quantity; }), 2) }}</strong>
																	</div>
															</div>

															<div class="row">
																	<div class="col-md-12">
																			<a href="{{ route('checkout') }}" class="btn btn-black btn-sm py-3 btn-block">{{ __('messages.cart.proceedToCheckout') }}</a>
																	</div>
															</div>
													</div>
											</div>
									</div>
							</div>
						</form>
					@else
						<div class="row">
								<div class="col-12 text-center py-5">
										<h3 class="text-muted">{{ __('messages.cart.empty') }}</h3>
										<p class="text-muted">{{ __('messages.cart.emptyDesc') }}</p>
										<a href="{{ route('shop') }}" class="btn btn-primary mt-3">{{ __('messages.cart.continueShopping') }}</a>
								</div>
						</div>
					@endif
			</div>
	</div>

	<script>
		// Prevent theme's sitePlusMinus from interfering with cart quantity controls
		document.addEventListener('DOMContentLoaded', function() {
			// Remove event listeners added by theme's custom.js
			const cartQuantityContainers = document.querySelectorAll('.quantity-container');
			cartQuantityContainers.forEach(function(container) {
				const increaseBtns = container.querySelectorAll('.increase');
				const decreaseBtns = container.querySelectorAll('.decrease');
				
				// Clone and replace buttons to remove all event listeners
				increaseBtns.forEach(function(btn) {
					const newBtn = btn.cloneNode(true);
					btn.parentNode.replaceChild(newBtn, btn);
				});
				
				decreaseBtns.forEach(function(btn) {
					const newBtn = btn.cloneNode(true);
					btn.parentNode.replaceChild(newBtn, btn);
				});
			});
		});

		function decreaseQty(cartId, event) {
			if (event) {
				event.preventDefault();
				event.stopPropagation();
				event.stopImmediatePropagation();
			}
			
			const input = document.getElementById('qty-' + cartId);
			if (!input) return false;
			
			let val = parseInt(input.value, 10) || 1;
			if (val > 1) {
				val = val - 1;
				input.value = val;
				updateTotal(cartId);
			}
			return false;
		}

		function increaseQty(cartId, maxStock, event) {
			if (event) {
				event.preventDefault();
				event.stopPropagation();
				event.stopImmediatePropagation();
			}
			
			const input = document.getElementById('qty-' + cartId);
			if (!input) return false;
			
			let val = parseInt(input.value, 10) || 1;
			if (val < maxStock) {
				val = val + 1;
				input.value = val;
				updateTotal(cartId);
			}
			return false;
		}

		function updateTotal(cartId) {
			const input = document.getElementById('qty-' + cartId);
			const totalCell = document.getElementById('item-total-' + cartId);
			if (input && totalCell) {
				const qty = parseInt(input.value) || 1;
				const price = parseFloat(totalCell.dataset.price);
				const total = price * qty;
				totalCell.textContent = '$' + total.toFixed(2);
				calculateCartTotal();
			}
		}

		function calculateCartTotal() {
			let subtotal = 0;
			document.querySelectorAll('[id^="item-total-"]').forEach(element => {
				const totalText = element.textContent.replace('$', '');
				subtotal += parseFloat(totalText) || 0;
			});
			document.getElementById('cart-subtotal').textContent = '$' + subtotal.toFixed(2);
			document.getElementById('cart-total').textContent = '$' + subtotal.toFixed(2);
		}
	</script>
@endsection
