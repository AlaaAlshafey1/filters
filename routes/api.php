<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\QuestionController;
use App\Http\Controllers\API\AnswerController;
use App\Http\Controllers\API\BlogController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CompanyDetailController;
use App\Http\Controllers\API\ContactUsController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ServicesFaqsController;
use App\Http\Controllers\API\SettingsController;
use App\Http\Controllers\API\SocialAuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// ------------------ AUTH ------------------
Route::get('/home', [HomeController::class, 'index']);
Route::get('/about', [HomeController::class, 'aboutUs']);
Route::get('/settings', [SettingsController::class, 'index']);



// ------------------ PUBLIC ENDPOINTS ------------------
Route::get('categories', [CategoryController::class, 'index']);
Route::get('settings', [SettingsController::class, 'index']);

// Products
Route::get('products', [ProductController::class, 'index']); // كل المنتجات
Route::get('products/{id}', [ProductController::class, 'show']);

// Categories
Route::get('categories/{id}/products', [CategoryController::class, 'products']);

// Blogs
Route::get('blogs', [BlogController::class, 'index']);
Route::get('blogs/{id}', [BlogController::class, 'show']);
Route::get('services-faqs', [ServicesFaqsController::class, 'index']);

// Contact Us
Route::post('contact', [ContactUsController::class, 'store']);
Route::get('company-details/{section_key}', [CompanyDetailController::class, 'index']);

