<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaleNewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/account', [AccountController::class, 'index'])->name('account');
    Route::post('/account/update', [AccountController::class, 'updateProfile'])->name('account.update');
    // Route hiển thị danh sách đơn hàng
    Route::get('/account/orders', [AccountController::class, 'showOrders'])->name('account.orders');
    // Route hiển thị trang quản lý (Manager)
    Route::get('/account/manager', [AccountController::class, 'showManager'])->name('account.manager');
    // Route hiển thị địa chỉ của người dùng
    Route::get('/account/address', [AccountController::class, 'showAddress'])->name('account.address');
    // Route hiển thị chi tiết tài khoản của người dùng
    Route::get('/account/edit', [AccountController::class, 'showDetails'])->name('account.edit');
    // Route hiển thị chi tiết from đăng tin bán hàng
    Route::get('/sale_news', [SaleNewsController::class, 'index'])->name('sale_news');
});

require __DIR__ . '/auth.php';

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\StaffController;

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/verify', [VerificationController::class, 'showVerifyForm'])->name('verification.show');
Route::post('/verify', [VerificationController::class, 'verify'])->name('verification.verify');





// Dashboard route
// Route::get('/dashboard', function () {
//     return view('admin.index');
// });

// Grouped routes for products
Route::prefix('product')->group(function () {
    Route::get('/', function () {
        return view('admin.products.index');
    });
    Route::get('/add', function () {
        return view('admin.products.add-product');
    });
    Route::get('/approve', function () {
        return view('admin.products.approve-product');
    });
});

// Grouped routes for categoris
Route::prefix('category')->group(function () {
    Route::get('/', function () {
        return view('admin.categories.index');
    });
    Route::get('/add', function () {
        return view('admin.categories.add-category');
    });
});

// // Other routes
// Route::get('/category', function () {
//     return view('admin.categories.index');
// });

// Grouped routes for account management
Route::prefix('account')->group(function () {

    Route::get('/employee-management', [StaffController::class, 'index']);
    Route::get('/confirm', function () {
        return view('admin.account.confirm-partner');
    });
    Route::get('/lock', function () {
        return view('admin.account.lock-account');
    });
});


Route::get('/blogs', function () {
    return view('admin.blogs.index');
});
Route::get('/notifications', function () {
    return view('admin.notifications.index');
});

use App\Http\Controllers\Admin\OrderController;

Route::get('/order-affiliate', [OrderController::class, 'index'])->name('orders.index');

// Grouped routes for payments
Route::prefix('payment')->group(function () {
    Route::get('/method', function () {
        return view('admin.payments.payment-method');
    });
    Route::get('/account', function () {
        return view('admin.payments.receiving-account');
    });
});
