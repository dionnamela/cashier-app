<?php

use App\Livewire\Dashboard\Product;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Dashboard\Dashboard;
use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard\ProductCategories;

Route::view('/', 'welcome');

Route::get('/dashboard/products', Product::class)
    ->middleware(['auth'])
    ->name('products');

Route::get('/dashboard/product_categories', ProductCategories::class)
    ->middleware(['auth'])
    ->name('productCategories');

Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth'])
    ->name('dashboard');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Atur redirect sesuai kebutuhan
})->name('logout');







Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
