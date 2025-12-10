<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent', 'children')
            ->orderBy('parent_id')
            ->orderBy('name')
            ->paginate(15);
        
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::parents()->active()->orderBy('name')->get();
        return view('backend.categories.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Generate slug from name
        $validated['slug'] = Str::slug($validated['name']);
        
        // Ensure slug is unique
        $originalSlug = $validated['slug'];
        $counter = 1;
        while (Category::where('slug', $validated['slug'])->exists()) {
            $validated['slug'] = $originalSlug . '-' . $counter;
            $counter++;
        }

        // Handle image upload - store in public/categories folder
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->guessExtension() ?: $image->getClientOriginalExtension();
            $imageName = time() . '_' . Str::random(10) . '.' . $extension;
            
            // Create categories directory if it doesn't exist
            $destinationPath = public_path('categories');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            // Move image to public/categories folder
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'categories/' . $imageName;
        }

        Category::create($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::with('parent', 'children')->findOrFail($id);
        return view('backend.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::with('parent')->findOrFail($id);
        $parentCategories = Category::parents()
            ->where('id', '!=', $id)
            ->active()
            ->orderBy('name')
            ->get();
        
        return view('backend.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id|not_in:' . $id,
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Prevent category from being its own parent
        if ($validated['parent_id'] == $id) {
            return redirect()->back()
                ->withErrors(['parent_id' => 'A category cannot be its own parent.'])
                ->withInput();
        }

        // Prevent circular references (category cannot be parent of its own parent)
        if ($validated['parent_id']) {
            $parent = Category::find($validated['parent_id']);
            if ($parent && $parent->parent_id == $id) {
                return redirect()->back()
                    ->withErrors(['parent_id' => 'Cannot set parent: this would create a circular reference.'])
                    ->withInput();
            }
        }

        // Generate slug from name if name changed
        if ($category->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
            
            // Ensure slug is unique
            $originalSlug = $validated['slug'];
            $counter = 1;
            while (Category::where('slug', $validated['slug'])->where('id', '!=', $id)->exists()) {
                $validated['slug'] = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        // Handle image upload - store in public/categories folder
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($category->image) {
                $oldImagePath = public_path($category->image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
            
            $image = $request->file('image');
            $extension = $image->guessExtension() ?: $image->getClientOriginalExtension();
            $imageName = time() . '_' . Str::random(10) . '.' . $extension;
            
            // Create categories directory if it doesn't exist
            $destinationPath = public_path('categories');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            // Move image to public/categories folder
            $image->move($destinationPath, $imageName);
            $validated['image'] = 'categories/' . $imageName;
        }

        $category->update($validated);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        // Check if category has children
        if ($category->children()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category. It has subcategories. Please delete or reassign subcategories first.');
        }

        // Delete image from public folder if exists
        if ($category->image) {
            $imagePath = public_path($category->image);
            if (File::exists($imagePath)) {
                try {
                    File::delete($imagePath);
                } catch (\Exception $e) {
                    \Log::warning('Failed to delete category image: ' . $imagePath . ' - ' . $e->getMessage());
                }
            }
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Category and associated image deleted successfully.');
    }
}
