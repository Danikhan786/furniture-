@extends('layouts.frontend')

@section('content')
	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(frontend/images/img_bg_2.jpg);">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeIn">
							<h1>Shopping Cart</h1>
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
					{{-- @if(isset($cartItems) && count($cartItems) > 0) --}}
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<th class="text-center">Image</th>
									<th>Product</th>
									<th class="text-center">Price</th>
									<th class="text-center">Quantity</th>
									<th class="text-center">Subtotal</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								{{-- @foreach($cartItems as $item) --}}
								<tr>
									<td class="text-center">
										<img src="frontend/images/product-{{ $item['id'] ?? 1 }}.jpg" alt="{{ $item['name'] ?? 'Product' }}" style="width: 80px; height: 80px; object-fit: cover;">
									</td>
									<td>
										<h4><a href="{{ route('productDetail') }}">{{ $item['name'] ?? 'Hauteville Rocking Chair' }}</a></h4>
										<p class="text-muted">SKU: {{ $item['sku'] ?? 'SKU-001' }}</p>
									</td>
									<td class="text-center">
										<span class="price">${{ number_format($item['price'] ?? 350, 2) }}</span>
									</td>
									<td class="text-center">
										<div class="quantity-wrapper">
											<div class="quantity-controls">
												<button class="qty-btn qty-minus" type="button" onclick="decreaseQuantity({{ $item['id'] ?? 1 }})">
													<i class="icon-minus"></i>
												</button>
												<input type="number" class="quantity-input" value="{{ $item['quantity'] ?? 1 }}" 
													min="1" id="qty-{{ $item['id'] ?? 1 }}" 
													onchange="validateQuantity({{ $item['id'] ?? 1 }})"
													onkeyup="validateQuantity({{ $item['id'] ?? 1 }})">
												<button class="qty-btn qty-plus" type="button" onclick="increaseQuantity({{ $item['id'] ?? 1 }})">
													<i class="icon-plus"></i>
												</button>
											</div>
											<button class="btn btn-primary btn-sm btn-update" type="button" 
												onclick="updateCartItem({{ $item['id'] ?? 1 }})" 
												id="update-btn-{{ $item['id'] ?? 1 }}">
												<i class="icon-check"></i> Update
											</button>
										</div>
									</td>
									<td class="text-center">
										<span class="price">${{ number_format(($item['price'] ?? 350) * ($item['quantity'] ?? 1), 2) }}</span>
									</td>
									<td class="text-center">
										<button class="btn btn-danger btn-sm" onclick="removeItem({{ $item['id'] ?? 1 }})">
											<i class="icon-trash"></i> Remove
										</button>
									</td>
								</tr>
								{{-- @endforeach --}}
							</tbody>
						</table>
					</div>

					<div class="row">
						<div class="col-md-6">
							<div class="cart-actions">
								<a href="{{ route('products') }}" class="btn btn-primary btn-outline">
									<i class="icon-arrow-left"></i> Continue Shopping
								</a>
								<button class="btn btn-default" onclick="clearCart()">
									<i class="icon-refresh"></i> Clear Cart
								</button>
							</div>
						</div>
						<div class="col-md-6">
							<div class="cart-totals">
								<table class="table">
									<tbody>
										<tr>
											<td><strong>Subtotal:</strong></td>
											<td class="text-right"><strong>${{ number_format($subtotal ?? 1050, 2) }}</strong></td>
										</tr>
										<tr>
											<td><strong>Shipping:</strong></td>
											<td class="text-right">${{ number_format($shipping ?? 50, 2) }}</td>
										</tr>
										<tr>
											<td><strong>Tax:</strong></td>
											<td class="text-right">${{ number_format($tax ?? 105, 2) }}</td>
										</tr>
										<tr class="total-row">
											<td><strong>Total:</strong></td>
											<td class="text-right"><strong class="price">${{ number_format($total ?? 1205, 2) }}</strong></td>
										</tr>
									</tbody>
								</table>
								<div class="text-right">
									<a href="{{route('checkout')}}" class="btn btn-primary btn-lg btn-block">
										Proceed to Checkout <i class="icon-arrow-right"></i>
									</a>
								</div>
							</div>
						</div>
					</div>
					{{-- @else --}}
					{{-- <div class="row animate-box">
						<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
							<h2>Your cart is empty</h2>
							<p>Looks like you haven't added any items to your cart yet.</p>
							<p>
								<a href="{{ route('products') }}" class="btn btn-primary btn-outline btn-lg">
									<i class="icon-shopping-cart"></i> Start Shopping
								</a>
							</p>
						</div>
					</div> --}}
					{{-- @endif --}}
				</div>
			</div>
		</div>
	</div>



	<script>
		function decreaseQuantity(itemId) {
			var qtyInput = document.getElementById('qty-' + itemId);
			var currentQty = parseInt(qtyInput.value) || 1;
			var newQty = currentQty - 1;
			
			if (newQty < 1) {
				newQty = 1;
			}
			
			qtyInput.value = newQty;
		}

		function increaseQuantity(itemId) {
			var qtyInput = document.getElementById('qty-' + itemId);
			var currentQty = parseInt(qtyInput.value) || 1;
			var newQty = currentQty + 1;
			
			qtyInput.value = newQty;
		}

		function validateQuantity(itemId) {
			var qtyInput = document.getElementById('qty-' + itemId);
			var qty = parseInt(qtyInput.value) || 1;
			
			if (qty < 1) {
				qty = 1;
			}
			
			qtyInput.value = qty;
		}

		function updateCartItem(itemId) {
			var qtyInput = document.getElementById('qty-' + itemId);
			var updateBtn = document.getElementById('update-btn-' + itemId);
			var quantity = parseInt(qtyInput.value) || 1;
			
			if (quantity < 1) {
				alert('Quantity must be at least 1');
				qtyInput.value = 1;
				return;
			}
			
			// Disable button and show loading state
			updateBtn.disabled = true;
			updateBtn.innerHTML = '<i class="icon-spinner"></i> Updating...';
			
			// Here you would typically make an AJAX call to update the cart
			// Example AJAX call (uncomment and modify as needed):
			/*
			fetch('/cart/update', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
				},
				body: JSON.stringify({
					item_id: itemId,
					quantity: quantity
				})
			})
			.then(response => response.json())
			.then(data => {
				if (data.success) {
					// Show success feedback
					updateBtn.classList.add('updated');
					updateBtn.innerHTML = '<i class="icon-check"></i> Updated!';
					
					// Reload page or update totals via AJAX
					setTimeout(function() {
						location.reload();
					}, 1000);
				} else {
					alert('Error updating cart: ' + (data.message || 'Unknown error'));
					updateBtn.disabled = false;
					updateBtn.innerHTML = '<i class="icon-check"></i> Update';
				}
			})
			.catch(error => {
				console.error('Error:', error);
				alert('Error updating cart. Please try again.');
				updateBtn.disabled = false;
				updateBtn.innerHTML = '<i class="icon-check"></i> Update';
			});
			*/
			
			// Placeholder: Show success feedback and reload
			setTimeout(function() {
				updateBtn.classList.add('updated');
				updateBtn.innerHTML = '<i class="icon-check"></i> Updated!';
				setTimeout(function() {
					location.reload(); // Replace with actual AJAX update
				}, 1000);
			}, 500);
		}

		function removeItem(itemId) {
			if (confirm('Are you sure you want to remove this item from your cart?')) {
				// Here you would typically make an AJAX call to remove the item
				// For now, we'll just reload the page
				location.reload(); // This is a placeholder - replace with actual AJAX call
			}
		}

		function clearCart() {
			if (confirm('Are you sure you want to clear your entire cart?')) {
				// Here you would typically make an AJAX call to clear the cart
				// For now, we'll just reload the page
				location.reload(); // This is a placeholder - replace with actual AJAX call
			}
		}
	</script>
@endsection
