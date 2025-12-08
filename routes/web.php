<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\backendController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
use App\Http\Controllers\Backend\CouponController as BackendCouponController;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


 Route::get('/', [FrontendController::class, 'index'])->name('index');
 Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
 Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
 Route::get('/product/{slug}', [FrontendController::class, 'productDetail'])->name('productDetail');
 Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
 
 // Cart Routes (no auth required for add to cart)
 Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
 Route::get('/cart', [CartController::class, 'index'])->name('cart');
 Route::put('/cart/update-all', [CartController::class, 'updateAll'])->name('cart.updateAll');
 Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
 Route::get('/cart/{id}/remove', [CartController::class, 'destroy'])->name('cart.remove');
 
 Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout'); 
 Route::post('/checkout/validate-coupon', [FrontendController::class, 'validateCoupon'])->name('checkout.validateCoupon');
 Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');
 Route::get('/thankyou', [FrontendController::class, 'thankyou'])->name('thankyou');




/*------------------------------------------
--------------------------------------------
All Normal Users Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:user'])->group(function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

/*------------------------------------------
--------------------------------------------
All Admin Routes List
--------------------------------------------
--------------------------------------------*/
Route::middleware(['auth', 'user-access:admin'])->group(function () {

    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/dashboard', [backendController::class, 'index'])->name('admin.dashboard');
    
    // Category Routes
    Route::resource('admin/categories', CategoryController::class)->names([
        'index' => 'admin.categories.index',
        'create' => 'admin.categories.create',
        'store' => 'admin.categories.store',
        'edit' => 'admin.categories.edit',
        'update' => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);


    Route::resource('admin/products', ProductController::class)->names([
        'index' => 'admin.products.index',
        'create' => 'admin.products.create',
        'store' => 'admin.products.store',
        'edit' => 'admin.products.edit',
        'update' => 'admin.products.update',
        'destroy' => 'admin.products.destroy',
    ]);
    
    Route::delete('admin/products/images/{id}', [ProductController::class, 'deleteImage'])->name('admin.products.images.delete');
    
    // Order Routes
    Route::get('admin/orders', [BackendOrderController::class, 'index'])->name('admin.orders.index');
    Route::get('admin/orders/{id}', [BackendOrderController::class, 'show'])->name('admin.orders.show');
    Route::get('admin/orders/{id}/edit', [BackendOrderController::class, 'edit'])->name('admin.orders.edit');
    Route::put('admin/orders/{id}', [BackendOrderController::class, 'update'])->name('admin.orders.update');
    Route::delete('admin/orders/{id}', [BackendOrderController::class, 'destroy'])->name('admin.orders.destroy');
    
    // Coupon Routes
    Route::get('admin/coupons', [BackendCouponController::class, 'index'])->name('admin.coupons.index');
    Route::get('admin/coupons/create', [BackendCouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('admin/coupons', [BackendCouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('admin/coupons/{id}/edit', [BackendCouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::put('admin/coupons/{id}', [BackendCouponController::class, 'update'])->name('admin.coupons.update');
    Route::delete('admin/coupons/{id}', [BackendCouponController::class, 'destroy'])->name('admin.coupons.destroy');
});
