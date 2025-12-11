<x-mail::message>
# Thank you for your order, {{ $order->first_name }}!

Your order **{{ $order->order_number }}** has been received and is currently **{{ ucfirst($order->status) }}**.

## Order Summary
@component('mail::table')
| Item | Qty | Price |
| :--- |:---:| ----: |
@foreach($order->items as $item)
| {{ $item->product->name ?? 'Product' }} | {{ $item->quantity }} | ${{ number_format($item->price * $item->quantity, 2) }} |
@endforeach
| **Subtotal** |  | ${{ number_format($order->subtotal, 2) }} |
@if($order->discount_amount > 0)
| **Discount** |  | -${{ number_format($order->discount_amount, 2) }} |
@endif
| **Total** |  | ${{ number_format($order->total, 2) }} |
@endcomponent

**Shipping to:**  
{{ $order->first_name }} {{ $order->last_name }}  
{{ $order->address }}  
@if($order->apartment){{ $order->apartment }}@endif  
{{ $order->state_country }}, {{ $order->postal_zip }}  
{{ $order->phone }}

If you have any questions, just reply to this email and we'll be happy to help.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
