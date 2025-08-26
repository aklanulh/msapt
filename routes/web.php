<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RFQController;

// Main pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/tentang-kami', [AboutController::class, 'index'])->name('about');
Route::get('/produk-layanan', [ProductController::class, 'index'])->name('products');
Route::get('/produk-layanan/{category}', [ProductController::class, 'category'])->name('products.category');
Route::get('/produk/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog');
Route::get('/klien-proyek', [ProjectController::class, 'index'])->name('projects');
Route::get('/artikel', [BlogController::class, 'index'])->name('blog');
Route::get('/artikel/{slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');

// Forms and actions
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/rfq/{product_id?}', [RFQController::class, 'create'])->name('rfq.create');
Route::post('/rfq', [RFQController::class, 'store'])->name('rfq.store');

// Search
Route::get('/search', [ProductController::class, 'search'])->name('search');

// Admin Routes
use App\Http\Controllers\AdminController;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
        Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
        Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
        Route::get('/products/category/{category}', [AdminController::class, 'productsByCategory'])->name('admin.products.category');
        Route::get('/products/{id}', [AdminController::class, 'showProduct'])->name('admin.products.show');
        Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
        Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
        Route::delete('/products/{id}', [AdminController::class, 'destroyProduct'])->name('admin.products.destroy');
        Route::get('/logs', [AdminController::class, 'logs'])->name('admin.logs');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    });
});
