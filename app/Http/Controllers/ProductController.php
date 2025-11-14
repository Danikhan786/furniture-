<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Generate a unique SKU for the product.
     */
    private function generateSKU($name = null)
    {
        $prefix = 'FURN';
        $counter = 1;
        
        // Try to create SKU from product name if provided
        if ($name) {
            $namePart = strtoupper(substr(preg_replace('/[^A-Za-z0-9]/', '', $name), 0, 3));
            if (strlen($namePart) >= 2) {
                $prefix = $namePart;
            }
        }
        
        // Generate SKU with format: PREFIX-XXXX
        do {
            $sku = $prefix . '-' . str_pad($counter, 4, '0', STR_PAD_LEFT);
            $exists = Product::where('sku', $sku)->exists();
            $counter++;
        } while ($exists && $counter < 9999);
        
        return $sku;
    }

    /**
     * Generate a unique slug for the product.
     */
    private function generateSlug($name)
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;
        
        // Ensure slug is unique
        while (Product::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }
        
        return $slug;
    }

    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::with('category', 'images')
            ->latest()
            ->paginate(15);
        
        return view('backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        $categories = Category::active()->orderBy('name')->get();
        return view('backend.products.create', compact('categories'));
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sku' => 'nullable|string|max:255|unique:products,sku',
        ]);

        // Calculate discount percent
        if ($validated['discount_price'] && $validated['price'] > 0) {
            $validated['discount_percent'] = round((($validated['price'] - $validated['discount_price']) / $validated['price']) * 100, 2);
        }

        // Auto-generate SKU if not provided
        if (empty($validated['sku'])) {
            $validated['sku'] = $this->generateSKU($validated['name']);
        }

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            $validated['slug'] = $this->generateSlug($validated['name']);
        }

        // Handle main image upload - store in public/products folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = public_path('products');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'products/' . $imageName;
        }

        $product = Product::create($validated);

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $destinationPath = public_path('products');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            foreach ($request->file('images') as $index => $file) {
                $imageName = time() . '_' . Str::random(10) . '_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $imageName);
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'products/' . $imageName,
                    'sort_order' => $index,
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::with('category', 'images')->findOrFail($id);
        $categories = Category::active()->orderBy('name')->get();
        
        return view('backend.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:products,slug,' . $id,
            'short_description' => 'nullable|string|max:500',
            'long_description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sku' => 'nullable|string|max:255|unique:products,sku,' . $id,
        ]);

        // Calculate discount percent
        if ($validated['discount_price'] && $validated['price'] > 0) {
            $validated['discount_percent'] = round((($validated['price'] - $validated['discount_price']) / $validated['price']) * 100, 2);
        } else {
            $validated['discount_percent'] = null;
        }

        // Auto-generate SKU if not provided and product doesn't have one
        if (empty($validated['sku'])) {
            if (empty($product->sku)) {
                $validated['sku'] = $this->generateSKU($validated['name']);
            } else {
                // Keep existing SKU if not provided in update
                unset($validated['sku']);
            }
        }

        // Auto-generate slug if not provided
        if (empty($validated['slug'])) {
            // Generate slug from name if name changed, otherwise keep existing
            if ($validated['name'] !== $product->name) {
                $validated['slug'] = $this->generateSlug($validated['name']);
            } else {
                // Keep existing slug if name hasn't changed
                unset($validated['slug']);
            }
        }

        // Handle main image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                $oldImagePath = public_path($product->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            
            $image = $request->file('image');
            $imageName = time() . '_' . Str::random(10) . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = public_path('products');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'products/' . $imageName;
        }

        $product->update($validated);

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            $destinationPath = public_path('products');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $maxSortOrder = $product->images()->max('sort_order') ?? -1;

            foreach ($request->file('images') as $index => $file) {
                $imageName = time() . '_' . Str::random(10) . '_' . $index . '.' . $file->getClientOriginalExtension();
                $file->move($destinationPath, $imageName);
                
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => 'products/' . $imageName,
                    'sort_order' => $maxSortOrder + $index + 1,
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified product from storage.
     */
    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);
        
        // Delete main image if exists
        if ($product->image) {
            $imagePath = public_path($product->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // Delete all product images
        foreach ($product->images as $productImage) {
            $imagePath = public_path($productImage->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
    }

    /**
     * Delete a product image.
     */
    public function deleteImage($id)
    {
        $productImage = ProductImage::findOrFail($id);
        
        // Delete image file
        $imagePath = public_path($productImage->image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
        
        $productImage->delete();
        
        return response()->json(['success' => true, 'message' => 'Image deleted successfully.']);
    }
}
