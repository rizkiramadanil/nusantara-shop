<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminPostCategoryController;
use App\Http\Controllers\AdminProductCategoryController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardHistoryController;
use App\Http\Controllers\DashboardHomeController;
use App\Http\Controllers\DashboardMessageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardPostController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);

Route::get('products/{product:slug}', [ProductController::class, 'show'])->middleware('auth');

Route::post('products/{product:id}', [ProductController::class, 'order']);

Route::get('/posts', [PostController::class, 'index']);

Route::get('posts/{post:slug}', [PostController::class, 'show'])->middleware('auth');

Route::get('/about', [AboutController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);

Route::post('/contact', [ContactController::class, 'store']);

Route::get('check_out', [CartController::class, 'index']);

Route::get('confirm_check_out', [CartController::class, 'confirm']);

Route::delete('check_out/{id}', [CartController::class, 'delete']);

Route::get('user/history', [HistoryController::class, 'index']);

Route::get('user/history/{id}', [HistoryController::class, 'detail']);

Route::middleware('auth')->group(function() {
    Route::resource('/user', UserController::class);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::middleware('auth')->group(function() {
    Route::middleware('seller')->group(function() {
        Route::get('/dashboard', [DashboardHomeController::class, 'index']);
    });
});

Route::middleware('auth')->group(function() {
    Route::middleware('seller')->group(function() {
        Route::get('/dashboard/products/checkSlug', [DashboardProductController::class, 'checkSlug']);
        Route::resource('/dashboard/products', DashboardProductController::class);
    });
});

Route::middleware('auth')->group(function() {
    Route::middleware('seller')->group(function() {
        Route::get('dashboard/history', [DashboardHistoryController::class, 'index']);
        Route::get('dashboard/history/{id}', [DashboardHistoryController::class, 'detail']);
    });
});

Route::middleware('auth')->group(function() {
    Route::middleware('seller')->group(function() {
        Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug']);
        Route::resource('/dashboard/posts', DashboardPostController::class);
    });
});

Route::middleware('auth')->group(function() {
    Route::middleware('seller')->group(function() {
        Route::resource('/dashboard/messages', DashboardMessageController::class);
        Route::delete('/dashboard/messages/{message:id}', [DashboardMessageController::class, 'destroy']);
    });
});

Route::middleware('auth')->group(function() {
    Route::middleware('admin')->group(function() {
        Route::get('/dashboard/product_categories/checkSlug', [AdminProductCategoryController::class, 'checkSlug']);
        Route::resource('/dashboard/product_categories', AdminProductCategoryController::class);
        Route::get('dashboard/product_categories/{product_category:slug}', [AdminProductCategoryController::class, 'show']);
    });
});

Route::middleware('auth')->group(function() {
    Route::middleware('admin')->group(function() {
        Route::get('/dashboard/post_categories/checkSlug', [AdminPostCategoryController::class, 'checkSlug']);
        Route::resource('/dashboard/post_categories', AdminPostCategoryController::class);
        Route::get('dashboard/post_categories/{post_category:slug}', [AdminPostCategoryController::class, 'show']);
    });
});

Route::middleware('auth')->group(function() {
    Route::middleware('admin')->group(function() {
        Route::resource('/dashboard/users', AdminUserController::class);
        Route::get('dashboard/users/{user:username}', [AdminUserController::class, 'show']);
    });
});