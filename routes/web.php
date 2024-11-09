<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UsermanagementController;

Route::get('/', function () {
    return view('home');
});


// Route::get('/home', function () {
//     return view('home');
// })->middleware(['auth', 'verified'])->name('home');

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

    Route::post('/submit-review', [ReviewController::class, 'store'])->name('submit.review');
    Route::patch('/orders/{order_id}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
});

require __DIR__ . '/auth.php';


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/verify', [VerificationController::class, 'showVerifyForm'])->name('verification.show');
Route::post('/verify', [VerificationController::class, 'verify'])->name('verification.verify');



// Route::get('/test', function () {
//     return view('test');
// });

Route::GET('/test', [ImageUploadController::class, 'store'])->name('test');

// Route::get('/test', function () {
//     if (Auth::check()) {
//         $userId = Auth::id();
//         return view('test', ['userId' => $userId]);
//     } else {
//         return "User is not logged in";
//     }
// });


// Dashboard route
Route::get('/dashboard', function () {
    return view('admin.index');
});

// Grouped routes for products
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');

    // Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');


    Route::get('/add', function () {
        return view('admin.products.add-product');
    });

    Route::post('/add', [ProductController::class, 'store'])->name('add.product');
    Route::get('/add', [ProductController::class, 'create'])->name('products.create');


    Route::get('/approve', function () {
        return view('admin.products.approve-product');
    });

    // Route::post('/save-variants', [ProductController::class, 'saveVariants'])->name('save.variants');

});




Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);

// Route::post('/products', [ProductController::class, 'store'])->name('products.store');


// Grouped routes for categoris
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::match(['get', 'post'], '/add', [CategoryController::class, 'store'])->name('addCategory');
});

// // Other routes
// Route::get('/category', function () {
//     return view('admin.categories.index');
// });

// Grouped routes for account management   - Nguyễn Quang Cường
Route::prefix('account')->group(function () {
    // staffx
    Route::get('/employee-management', [StaffController::class, 'index']);
    Route::post('/employee-management', [StaffController::class, 'store'])->name('addStaff');
    Route::get('/employee-management/employeedetails/edit/{id}', [StaffController::class, 'edit'])->name('editStaff');
    Route::put('/employee-management/employeedetails/update/{id}', [StaffController::class, 'update'])->name('updateStaff');
    Route::delete('/employee-management/employeedetails/delete/{id}', [StaffController::class, 'destroy'])->name('deleteStaff');
    // account user
    Route::get('/user-account-management', [UsermanagementController::class, 'index']);
    Route::put('/user-account-management/lock/{id}', [UsermanagementController::class, 'updateLock'])->name('updateLock');
    Route::put('/user-account-management/unlock/{id}', [UsermanagementController::class, 'updateUnlock'])->name('updateUnlock');

    // });
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
Route::get('/order-affiliate', function () {
    return view('admin.orders.index');
});

// Grouped routes for payments
Route::prefix('payment')->group(function () {
    Route::get('/method', function () {
        return view('admin.payments.payment-method');
    });
    Route::get('/account', function () {
        return view('admin.payments.receiving-account');
    });
});


Route::prefix('message')->group(function () {
    Route::get('/conversations', [ConversationController::class, 'loadConversations'])->name('message.conversations');
    Route::get('/check-conversations', [ConversationController::class, 'CheckConversation'])->name('message.checkconversations');
    Route::get('/create-conversations', [ConversationController::class, 'CreateConversation'])->name('message.createconversations');
    Route::post('/save-message/{namechannel}', [MessageController::class, 'store'])->name('message.savemessage');
    Route::get('/get-messages/{name}', [MessageController::class, 'getMessages'])->name('message.getmessage');
})->middleware(['auth', 'verified']);

Route::prefix('cart')->group(function () {
    Route::get('/cart-detail', [CartController::class, 'show'])->name('cart.detail');
    Route::post('/update-stock', [CartController::class, 'updateStock'])->name('cart.updateStock');
    Route::delete('/remove-item', [CartController::class, 'removeItem'])->name('cart.removeItem');
})->middleware(['auth', 'verified']);
