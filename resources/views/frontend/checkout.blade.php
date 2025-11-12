@extends('layouts.frontend')

@section('content')
	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(frontend/images/img_bg_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>Checkout</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id="fh5co-product">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-12">
					<div class="row">
						<!-- Billing & Shipping Form -->
						<div class="col-md-8">
							<div class="checkout-form-wrapper">
								<!-- Billing Information -->
								<div class="checkout-section">
									<h3 class="section-title">
										<i class="icon-user"></i> Billing Information
									</h3>
									<form id="checkout-form">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="first_name">First Name <span class="required">*</span></label>
													<input type="text" class="form-control" id="first_name" name="first_name" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="last_name">Last Name <span class="required">*</span></label>
													<input type="text" class="form-control" id="last_name" name="last_name" required>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label for="email">Email Address <span class="required">*</span></label>
											<input type="email" class="form-control" id="email" name="email" required>
										</div>
										<div class="form-group">
											<label for="phone">Phone Number <span class="required">*</span></label>
											<input type="tel" class="form-control" id="phone" name="phone" required>
										</div>
										<div class="form-group">
											<label for="address">Street Address <span class="required">*</span></label>
											<input type="text" class="form-control" id="address" name="address" required>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="city">City <span class="required">*</span></label>
													<input type="text" class="form-control" id="city" name="city" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="state">State/Province <span class="required">*</span></label>
													<input type="text" class="form-control" id="state" name="state" required>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label for="zip">ZIP/Postal Code <span class="required">*</span></label>
													<input type="text" class="form-control" id="zip" name="zip" required>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label for="country">Country <span class="required">*</span></label>
													<select class="form-control" id="country" name="country" required>
														<option value="">Select Country</option>
														<option value="US">United States</option>
														<option value="CA">Canada</option>
														<option value="UK">United Kingdom</option>
														<option value="AU">Australia</option>
														<option value="DE">Germany</option>
														<option value="FR">France</option>
														<option value="IT">Italy</option>
														<option value="ES">Spain</option>
													</select>
												</div>
											</div>
										</div>

										<!-- Payment Method -->
										<div class="payment-section">
											<h3 class="section-title">
												<i class="icon-credit-card"></i> Payment Method
											</h3>
											<div class="payment-methods">
												<div class="radio">
													<label>
														<input type="radio" name="payment_method" value="cash_on_delivery" checked>
														<strong>Cash on Delivery</strong>
													</label>
												</div>
												<div class="payment-info">
													<p class="text-muted">
														<i class="icon-info"></i> You will pay in cash when your order is delivered.
													</p>
												</div>
											</div>
										</div>

										<!-- Order Notes -->
										<div class="form-group">
											<label for="order_notes">Order Notes (Optional)</label>
											<textarea class="form-control" id="order_notes" name="order_notes" rows="3" placeholder="Special instructions for your order..."></textarea>
										</div>
									</form>
								</div>
							</div>
						</div>

						<!-- Order Summary -->
						<div class="col-md-4">
							<div class="order-summary">
								<h3 class="summary-title">
									<i class="icon-shopping-cart"></i> Order Summary
								</h3>
								
								<div class="order-items">
									@if(isset($cartItems) && count($cartItems) > 0)
										@foreach($cartItems as $item)
										<div class="order-item">
											<div class="item-image">
												<img src="frontend/images/product-{{ $item['id'] ?? 1 }}.jpg" alt="{{ $item['name'] ?? 'Product' }}">
											</div>
											<div class="item-details">
												<h5>{{ $item['name'] ?? 'Hauteville Rocking Chair' }}</h5>
												<p class="item-meta">Qty: {{ $item['quantity'] ?? 1 }} × ${{ number_format($item['price'] ?? 350, 2) }}</p>
											</div>
											<div class="item-price">
												${{ number_format(($item['price'] ?? 350) * ($item['quantity'] ?? 1), 2) }}
											</div>
										</div>
										@endforeach
									@else
										<!-- Sample items for display -->
										<div class="order-item">
											<div class="item-image">
												<img src="frontend/images/product-1.jpg" alt="Product">
											</div>
											<div class="item-details">
												<h5>Hauteville Rocking Chair</h5>
												<p class="item-meta">Qty: 2 × $350.00</p>
											</div>
											<div class="item-price">
												$700.00
											</div>
										</div>
										<div class="order-item">
											<div class="item-image">
												<img src="frontend/images/product-2.jpg" alt="Product">
											</div>
											<div class="item-details">
												<h5>Pavilion Speaker</h5>
												<p class="item-meta">Qty: 1 × $600.00</p>
											</div>
											<div class="item-price">
												$600.00
											</div>
										</div>
									@endif
								</div>

								<!-- Coupon Code -->
								<div class="coupon-section">
									<h4 class="coupon-title">
										<i class="icon-tag"></i> Add Coupon Code
									</h4>
									<div class="coupon-form">
										<div class="input-group">
											<input type="text" class="form-control" id="coupon_code" name="coupon_code" placeholder="Enter coupon code">
											<span class="input-group-btn">
												<button class="btn btn-primary" type="button" id="apply-coupon-btn" onclick="applyCoupon()">
													Apply
												</button>
											</span>
										</div>
										<div id="coupon-message" class="coupon-message"></div>
									</div>
								</div>

								<div class="order-totals">
									<div class="total-row">
										<span>Subtotal:</span>
										<span>${{ number_format($subtotal ?? 1300, 2) }}</span>
									</div>
									<div id="discount-row" class="total-row discount-row" style="display: none;">
										<span>Discount:</span>
										<span class="discount-amount">-$0.00</span>
									</div>
									<div class="total-row">
										<span>Shipping:</span>
										<span>${{ number_format($shipping ?? 50, 2) }}</span>
									</div>
									<div class="total-row">
										<span>Tax:</span>
										<span>${{ number_format($tax ?? 130, 2) }}</span>
									</div>
									<div class="total-row final-total">
										<span><strong>Total:</strong></span>
										<span><strong class="price" id="final-total">${{ number_format($total ?? 1480, 2) }}</strong></span>
									</div>
								</div>

								<div class="checkout-actions">
									<a href="{{ route('cart') }}" class="btn btn-default btn-block">
										<i class="icon-arrow-left"></i> Back to Cart
									</a>
									<button type="submit" form="checkout-form" class="btn btn-primary btn-lg btn-block">
										<i class="icon-check"></i> Place Order
									</button>
								</div>

								<div class="security-info">
									<p class="text-center">
										<i class="icon-lock"></i> Secure checkout. Your information is safe.
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	<script>
		let appliedCoupon = null;
		let discountAmount = 0;
		const originalTotal = {{ $total ?? 1480 }};
		const subtotal = {{ $subtotal ?? 1300 }};
		const shipping = {{ $shipping ?? 50 }};
		const tax = {{ $tax ?? 130 }};

		function applyCoupon() {
			const couponCode = document.getElementById('coupon_code').value.trim();
			const couponMessage = document.getElementById('coupon-message');
			const applyBtn = document.getElementById('apply-coupon-btn');
			
			if (!couponCode) {
				couponMessage.className = 'coupon-message error';
				couponMessage.textContent = 'Please enter a coupon code';
				return;
			}

			// Disable button and show loading
			applyBtn.disabled = true;
			applyBtn.innerHTML = 'Applying...';

			// Here you would typically make an AJAX call to validate the coupon
			// Example AJAX call (uncomment and modify as needed):
			/*
			fetch('/checkout/apply-coupon', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
				},
				body: JSON.stringify({
					coupon_code: couponCode
				})
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					appliedCoupon = data.coupon;
					discountAmount = data.discount;
					updateTotals();
					couponMessage.className = 'coupon-message success';
					couponMessage.textContent = data.message || 'Coupon applied successfully!';
					applyBtn.innerHTML = 'Applied';
				} else {
					couponMessage.className = 'coupon-message error';
					couponMessage.textContent = data.message || 'Invalid coupon code';
					applyBtn.disabled = false;
					applyBtn.innerHTML = 'Apply';
				}
			})
			.catch(error => {
				console.error('Error:', error);
				couponMessage.className = 'coupon-message error';
				couponMessage.textContent = 'Error applying coupon. Please try again.';
				applyBtn.disabled = false;
				applyBtn.innerHTML = 'Apply';
			});
			*/

			// Demo: Simulate coupon validation
			setTimeout(function() {
				// Example coupon codes for demo
				const validCoupons = {
					'SAVE10': { discount: subtotal * 0.10, type: 'percentage', message: '10% discount applied!' },
					'SAVE20': { discount: subtotal * 0.20, type: 'percentage', message: '20% discount applied!' },
					'FLAT50': { discount: 50, type: 'fixed', message: '$50 discount applied!' },
					'WELCOME': { discount: subtotal * 0.15, type: 'percentage', message: 'Welcome discount applied!' }
				};

				if (validCoupons[couponCode.toUpperCase()]) {
					const coupon = validCoupons[couponCode.toUpperCase()];
					appliedCoupon = couponCode.toUpperCase();
					discountAmount = coupon.discount;
					updateTotals();
					couponMessage.className = 'coupon-message success';
					couponMessage.textContent = coupon.message;
					applyBtn.innerHTML = 'Applied';
				} else {
					couponMessage.className = 'coupon-message error';
					couponMessage.textContent = 'Invalid coupon code. Try: SAVE10, SAVE20, FLAT50, or WELCOME';
					applyBtn.disabled = false;
					applyBtn.innerHTML = 'Apply';
				}
			}, 500);
		}

		function updateTotals() {
			const discountRow = document.getElementById('discount-row');
			const discountAmountEl = document.querySelector('.discount-amount');
			const finalTotalEl = document.getElementById('final-total');

			if (discountAmount > 0) {
				const newTotal = originalTotal - discountAmount;
				discountRow.style.display = 'flex';
				discountAmountEl.textContent = '-$' + discountAmount.toFixed(2);
				finalTotalEl.textContent = '$' + newTotal.toFixed(2);
			} else {
				discountRow.style.display = 'none';
				finalTotalEl.textContent = '$' + originalTotal.toFixed(2);
			}
		}

		// Allow Enter key to apply coupon
		document.getElementById('coupon_code').addEventListener('keypress', function(e) {
			if (e.key === 'Enter') {
				e.preventDefault();
				applyCoupon();
			}
		});

		// Form submission
		document.getElementById('checkout-form').addEventListener('submit', function(e) {
			e.preventDefault();
			
			// Here you would typically validate and submit the form via AJAX
			// For now, we'll show a confirmation
			if (confirm('Are you sure you want to place this order? Payment will be collected on delivery.')) {
				// Submit form
				alert('Order placed successfully! (This is a demo - implement actual order processing)');
				// Uncomment below to actually submit:
				// this.submit();
			}
		});
	</script>
@endsection
