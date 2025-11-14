<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;

class backendController extends Controller
{
    public function index(){
        // Get total counts
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $activeProducts = Product::where('status', 'active')->count();
        $activeCategories = Category::where('status', 'active')->count();
        
        // Get counts from last month for percentage calculation
        $lastMonth = Carbon::now()->subMonth();
        $productsLastMonth = Product::where('created_at', '<=', $lastMonth)->count();
        $categoriesLastMonth = Category::where('created_at', '<=', $lastMonth)->count();
        
        // Calculate percentage change
        $productChange = $productsLastMonth > 0 
            ? round((($totalProducts - $productsLastMonth) / $productsLastMonth) * 100, 1)
            : ($totalProducts > 0 ? 100 : 0);
        
        $categoryChange = $categoriesLastMonth > 0
            ? round((($totalCategories - $categoriesLastMonth) / $categoriesLastMonth) * 100, 1)
            : ($totalCategories > 0 ? 100 : 0);
        
        return view('backend.index', compact(
            'totalProducts',
            'totalCategories',
            'activeProducts',
            'activeCategories',
            'productChange',
            'categoryChange'
        ));
    }
}
