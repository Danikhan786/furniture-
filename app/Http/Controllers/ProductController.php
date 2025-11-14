<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// Uncomment when you create the Product model
// use App\Models\Product;

class ProductController extends Controller
{

    /**
     * Display a listing of the products.
     */
    public function index()
    {
        // TODO: Uncomment when Product model is created
        // $products = Product::latest()->paginate(10);
        // $products = []; // Placeholder - replace with actual data
        
        return view('backend.products.index');
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specifications' => 'nullable|string',
            'sku' => 'nullable|string|max:255',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // TODO: Uncomment when Product model is created
        // $product = Product::create($validated);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        // TODO: Uncomment when Product model is created
        // $product = Product::findOrFail($id);
        
        // Placeholder product data - replace with actual data
        $product = (object) [
            'id' => $id,
            'name' => 'Sample Product',
            'description' => 'Sample description',
            'category' => 'chairs',
            'price' => 99.99,
            'stock' => 10,
            'status' => 'active',
            'image' => null,
            'specifications' => '',
            'sku' => 'FURN-001',
        ];
        
        return view('backend.products.edit', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'specifications' => 'nullable|string',
            'sku' => 'nullable|string|max:255',
        ]);

        // TODO: Uncomment when Product model is created
        // $product = Product::findOrFail($id);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            // if ($product->image) {
            //     Storage::disk('public')->delete($product->image);
            // }
            $validated['image'] = $request->file('image')->store('products', 'public');
        } else {
            // Keep existing image if no new image uploaded
            // unset($validated['image']);
        }

        // TODO: Uncomment when Product model is created
        // $product->update($validated);
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        // TODO: Uncomment when Product model is created
        // $product = Product::findOrFail($id);
        
        // Delete image if exists
        // if ($product->image) {
        //     Storage::disk('public')->delete($product->image);
        // }
        
        // $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }
}
