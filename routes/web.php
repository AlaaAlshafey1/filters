<?php

use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AppPageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CompanyDetailController;
use App\Http\Controllers\CompanySectionController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ExclusiveDistributorController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SliderFeatureController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('roles', RoleController::class);
    Route::post('roles/import', [RoleController::class, 'import'])->name('roles.import');
    Route::get('roles/export', [RoleController::class, 'export'])->name('roles.export');
    Route::resource('users', \App\Http\Controllers\UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('sliders', SliderController::class);
    Route::resource('features', SliderFeatureController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('faqs', FaqController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('employees', EmployeeController::class);

    Route::delete(
        '/product-images/{image}',
        [ProductsController::class, 'destroyImage']
    )->name('product-images.destroy');
    Route::resource(
        'exclusive-distributors',
        ExclusiveDistributorController::class
    );
    Route::resource(
        'company-sections',
        CompanySectionController::class
    );
    Route::resource(
        'company-details',
        CompanyDetailController::class
    );
    Route::resource('blogs', \App\Http\Controllers\BlogController::class);

    Route::get('contact-us', [ContactUsController::class,'index'])->name('admin.contact.index');
    Route::get('contact-us/{contactUsMessage}', [ContactUsController::class,'show'])->name('admin.contact.show');
    Route::delete('contact-us/{contactUsMessage}', [ContactUsController::class,'destroy'])->name('admin.contact.destroy');
    Route::get('settings', [SettingsController::class,'index'])->name('settings.index');
    Route::put('settings', [SettingsController::class,'update'])->name('settings.update');

});
Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
    }
    return redirect()->back();
})->name('change.language');

require __DIR__.'/auth.php';
