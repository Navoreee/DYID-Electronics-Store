<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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


// ACCESSED BY ALL
Route::get('/', [ProductController::class, 'showProductsHome'])->name('home');
Route::post('search', [ProductController::class, 'searchProduct'])->name('search');
Route::get('product/{id}', [ProductController::class, 'showProductDetails'])->name('details');


// ADMIN ONLY
Route::middleware('role:admin')->group(function ()
{
    Route::get('admin/product/view', [ProductController::class, 'showProductsAdmin'])->name('view_product');
    Route::get('admin/product/add', [ProductController::class, 'showAddProductForm'])->name('add_product');
    Route::post('admin/product/add', [ProductController::class, 'storeProduct'])->name('store_product');
    Route::get('admin/product/edit/{id}', [ProductController::class, 'showEditProductForm'])->name('edit_product');
    Route::post('admin/product/edit/{id}', [ProductController::class, 'updateProduct'])->name('update_product');
    Route::delete('admin/product/delete/{id}', [ProductController::class, 'deleteProduct'])->name('delete_product');

    Route::get('admin/category/view', [CategoryController::class, 'showCategories'])->name('view_category');
    Route::get('admin/category/add', [CategoryController::class, 'showAddCategoryForm'])->name('add_category');
    Route::post('admin/category/add', [CategoryController::class, 'storeCategory'])->name('store_category');
    Route::get('admin/category/edit/{id}', [CategoryController::class, 'showEditCategoryForm'])->name('edit_category');
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'updateCategory'])->name('update_category');
    Route::delete('admin/category/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('delete_category');
});


// MEMBERS ONLY
Route::middleware('role:member')->group(function ()
{
    Route::post('product/{id}/add', [CartController::class, 'addCartDetail'])->name('add_cart');

    Route::get('user/cart', [CartController::class, 'showCart'])->name('cart');
    Route::get('user/cart/edit/{id}', [CartController::class, 'showEditCartDetail'])->name('edit_cart');
    Route::post('user/cart/edit/{id}', [CartController::class, 'addCartDetail'])->name('update_cart');
    Route::delete('user/cart/delete/{id}', [CartController::class, 'deleteCartDetail'])->name('delete_cart');

    Route::delete('user/cart', [CartController::class, 'checkOut'])->name('check_out');

    Route::get('user/transaction-history', [CartController::class, 'showTransactionHistory'])->name('transaction_history');
});


//ADMIN AND MEMBERS ONLY
Route::post('logout', [LoginController::class, 'logout'])->name('logout')->middleware('role:member,admin');


// GUESTS ONLY
Route::middleware('role')->group(function ()
{
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);

    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});