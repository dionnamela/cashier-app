<?php

use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Product;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('/dashboard/products', Product::class)
    ->middleware(['auth'])
    ->name('products');


Route::get('/dashboard', Dashboard::class)
    ->middleware(['auth'])
    ->name('dashboard');







    
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
