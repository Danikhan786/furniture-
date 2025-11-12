<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\backendController;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();


 Route::get('/', [FrontendController::class, 'index'])->name('index');
 Route::get('/about-us', [FrontendController::class, 'about'])->name('about');
 Route::get('/products', [FrontendController::class, 'products'])->name('products');
 Route::get('/productDetail', [FrontendController::class, 'productDetail'])->name('productDetail');
 Route::get('/cart', [FrontendController::class, 'cart'])->name('cart'); 
 Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout'); 
 Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');




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
});
