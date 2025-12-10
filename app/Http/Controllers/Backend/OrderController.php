<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of orders.
     */
    public function index(Request $request)
    {
        $query = Order::with('user', 'items.product.images', 'coupon');
        
        // Search by order number
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('order_number', 'like', '%' . $search . '%');
        }
        
        $orders = $query->latest()->paginate(15)->withQueryString();

        return view('backend.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::with('user', 'items.product.images', 'coupon')
            ->findOrFail($id);

        return view('backend.orders.view', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = Order::with('user', 'items.product.images', 'coupon')
            ->findOrFail($id);

        return view('backend.orders.edit', compact('order'));
    }

    /**
     * Update the specified order.
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,completed,cancelled',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'state_country' => 'required|string|max:255',
            'postal_zip' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'apartment' => 'nullable|string|max:255',
            'order_notes' => 'nullable|string',
        ]);

        $order->update($validated);

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order updated successfully.');
    }

    /**
     * Remove the specified order from storage.
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        
        // Order items will be deleted automatically due to cascade delete
        $orderNumber = $order->order_number;
        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', "Order #{$orderNumber} has been deleted successfully.");
    }
}
