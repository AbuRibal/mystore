<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

// الصفحة الرئيسية - المتجر
Route::get('/', [HomeController::class, 'index'])->name('home');

// صفحات المنتجات
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// سلة التسوق - مع تعطيل CSRF مؤقتاً
Route::prefix('cart')->name('cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('/add', [CartController::class, 'add'])->name('add')->withoutMiddleware([VerifyCsrfToken::class]);
    Route::put('/update/{id}', [CartController::class, 'update'])->name('update')->withoutMiddleware([VerifyCsrfToken::class]);
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('remove')->withoutMiddleware([VerifyCsrfToken::class]);
    Route::post('/clear', [CartController::class, 'clear'])->name('clear')->withoutMiddleware([VerifyCsrfToken::class]);
});

// الطلبات - مع تعطيل CSRF مؤقتاً
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store')->withoutMiddleware([VerifyCsrfToken::class]);
Route::get('/orders/confirmation/{id}', [OrderController::class, 'confirmation'])->name('orders.confirmation');

// لوحة التحكم (خاصة بالمستخدمين المسجلين)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// ملف المستخدم (خاص بالمستخدمين المسجلين) - للجميع
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // صفحة الملف الشخصي بتصميم لوحة التحكم (للجميع)
    Route::get('/admin-profile', [ProfileController::class, 'adminProfile'])->name('profile.admin');
});

// مسارات لوحة التحكم (Admin) - فقط للأدمن
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // الطلبات
    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::put('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update');
    Route::delete('/orders/{id}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
    
    // المنتجات (باستخدام resource)
    Route::resource('products', App\Http\Controllers\Admin\ProductManagementController::class);
    
    // المتغيرات (variants)
    Route::post('/products/{product}/variants', [App\Http\Controllers\Admin\ProductManagementController::class, 'addVariant'])->name('products.variants.add');
    Route::delete('/variants/{id}', [App\Http\Controllers\Admin\ProductManagementController::class, 'deleteVariant'])->name('variants.delete');
});

// مسار مؤقت للتجربة
Route::get('/test-login', function() {
    $user = App\Models\User::where('email', 'admin@admin.com')->first();
    Auth::login($user);
    return redirect('/admin/orders');
});

require __DIR__.'/auth.php';