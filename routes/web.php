<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RuleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('product', ProductController::class);
Route::get('/datatable', [ProductController::class, 'datatable'])->name('product.datatable');
Route::resource('rule', RuleController::class);
Route::post('rule/{id}/apply', [RuleController::class, 'applyRule'])
    ->name('rule.apply');

// Route::resource('product','ProductController');
// Route::resource('/products',[ProductController::class]);
// Route::resource('/datatable',[ProductController::class]);
// Route::resource('/rule',[RuleController::class]);
