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
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PartnerProductController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\PartnerProfileController;
use App\Http\Controllers\UsermanagementController;

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
});

require __DIR__ . '/auth.php';


Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/verify', [VerificationController::class, 'showVerifyForm'])->name('verification.show');
Route::post('/verify', [VerificationController::class, 'verify'])->name('verification.verify');
Route::GET('/test', [ImageUploadController::class, 'store'])->name('test');

Route::get('staff/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login');
Route::post('staff/login', [StaffAuthController::class, 'login']);
Route::post('staff/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');

// Dashboard route
Route::get('/dashboard', function () {
    return view('admin.index');
});

// Grouped routes for products
Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/add', function () {
        return view('admin.products.add-product');
    });
    Route::post('/add', [ProductController::class, 'store'])->name('add.product');
    Route::get('/add', [ProductController::class, 'create'])->name('products.create');


    Route::put('/update/{id}', [ProductController::class, 'update'])->name('updateProduct');
    Route::get('/update/{id}', [ProductController::class, 'edit'])->name('editProduct');


    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('deleteProduct');
    Route::get('/approve', function () {
        return view('admin.products.approve-product');
    });
});




Route::get('/get-subcategories/{categoryId}', [ProductController::class, 'getSubcategories']);
Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::match(['get', 'post'], '/add', [CategoryController::class, 'store'])->name('addCategory');
    Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');
});
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

});


Route::get('/blogs', function () {
    return view('admin.blogs.index');
});
Route::get('/notifications', function () {
    return view('admin.notifications.list_notifications');
});
Route::prefix('notifications')->name('notifications.')->group(function () {
    Route::resource('/', NotificationController::class)->except(['show']); // Trừ show vì không có route cho nó
    Route::get('/create', [NotificationController::class, 'create'])->name('create');
    Route::get('/edit/{id}', [NotificationController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [NotificationController::class, 'update'])->name('update');
    Route::get('/trashed', [NotificationController::class, 'trashed'])->name('trashed');
    Route::delete('/destroy/{id}', [NotificationController::class, 'destroy'])->name('destroy');
    Route::post('restore/{id}/', [NotificationController::class, 'restore'])->name('restore');
    Route::delete('forceDelete/{id}/', [NotificationController::class, 'forceDelete'])->name('forceDelete');
    Route::patch('/toggleStatus/{id}', [NotificationController::class, 'toggleStatus'])->name('toggleStatus');
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

Route::prefix('product')->group(function () {
    Route::get('/details/{id}', [ProductController::class, 'renderProductDetails'])->name('product.detail');
})->middleware(['auth', 'verified']);

Route::prefix('cart')->group(function () {
    Route::get('/cart-detail', [CartController::class, 'show'])->name('cart.detail');
    Route::post('/cart-add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/update-stock', [CartController::class, 'updateStock'])->name('cart.updateStock');
    Route::delete('/remove-item', [CartController::class, 'removeItem'])->name('cart.removeItem');
})->middleware(['auth', 'verified']);


Route::prefix('partner')->group(function () {
    Route::resource('partner', PartnerController::class);
    Route::resource('channels', ChannelController::class);
    Route::resource('products', PartnerProductController::class);
    // Route::resource('orders', PartnerProductController::class);
    Route::resource('profile', PartnerProfileController::class);
});
Route::prefix('partners')->name('partners.')->group(function () {
    // Route::resource('/', PartnerController::class);
    Route::get('/', function () {
        return view('partner.dashboard');
    });
    Route::get('profile', [PartnerProfileController::class, 'index'])->name('profile');
    Route::put('/profile/{profile}', [PartnerProfileController::class, 'update'])->name('profile.update');

    // Route::resource('/orders/', OrderController::class);
    // Route::patch('/toggleStatus/{id}', [OrderController::class, 'toggleStatus'])->name('toggleStatus');


    // ------ ProductPartnerController ------
    Route::resource('/product/', PartnerProductController::class);
    Route::get('/trashed', [PartnerProductController::class, 'trashed'])->name('trashed');
    Route::delete('/destroy/{id}', [PartnerProductController::class, 'destroy'])->name('destroy');
    Route::post('restore/{id}/', [PartnerProductController::class, 'restore'])->name('restore');
    Route::delete('forceDelete/{id}/', [PartnerProductController::class, 'forceDelete'])->name('forceDelete');
    Route::patch('/toggleStatus/{id}', [PartnerProductController::class, 'toggleStatus'])->name('toggleStatus');
});
Route::resource('channels', ChannelController::class);

Route::prefix('trash')->group(function () {
    Route::get('/user', function () {
        return view('admin.index');
    });
    Route::get('/product', function () {
        return view('admin.index');
    });
    Route::get('/channel', function () {
        return view('admin.index');
    });
    Route::get('/category', function () {
        return view('admin.index');
    });
    Route::get('/blog', function () {
        return view('admin.index');
    });
});
