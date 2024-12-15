<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\StaffAuthController;
use App\Http\Controllers\ManageProfileController;
use App\Http\Controllers\PartnerProfileController;
use App\Http\Controllers\VipPackageController;
use App\Http\Controllers\UsermanagementController;
use App\Http\Controllers\VnPayController;
use App\Http\Controllers\SaleNewsController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\StaffForgotPasswordController;
use App\Http\Controllers\StaffResetPasswordController;
use App\Http\Controllers\UserManageController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\DashboardController;

require __DIR__ . '/auth.php';


// staff
Route::middleware(['auth.admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/blogs/add', [BlogController::class, 'create'])->name('blogs.create');
    Route::get('/blogs/edit', [BlogController::class, 'update'])->name('blogs.update');
    Route::resource('/blogs', BlogController::class);
    Route::post('/blogs/{blog}/toggle-status', [BlogController::class, 'toggleStatus'])->name('blogs.toggleStatus');


    Route::post('staff/logout', [StaffAuthController::class, 'logout'])->name('staff.logout');
    Route::prefix('category')->group(function () {
        Route::get('/', [CategoryController::class, 'index']);
        Route::match(['get', 'post'], '/add', [CategoryController::class, 'store'])->name('addCategory');
        Route::put('/update/{id}', [CategoryController::class, 'update'])->name('updateCategory');
        Route::get('/update/{id}', [CategoryController::class, 'edit'])->name('editCategory');
        Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy'])->name('deleteCategory');
    });
    Route::prefix('account')->group(function () {
        Route::get('/user-account-management', [UsermanagementController::class, 'index']);
        Route::put('/user-account-management/lock/{id}', [UsermanagementController::class, 'updateLock'])->name('updateLock');
        Route::put('/user-account-management/unlock/{id}', [UsermanagementController::class, 'updateUnlock'])->name('updateUnlock');
    });
    Route::post('/channel/togglestatus/{id}', [ChannelController::class, 'toggleStatus'])->name('channel.toggleStatus');
    // Route::post('/channel/togglesalenew/{id}', [SaleNewsController::class, 'toggleStatus'])->name('sale-news-channel.toggleStatus');
    Route::get('/channel', [ChannelController::class, 'list_channel'])->name('channel');
    Route::get('/vip-packages', [VipPackageController::class, 'index'])->name('vip-packages.index');
    Route::post('/vip-packages', [VipPackageController::class, 'store'])->name('vip-packages.store');
    Route::put('/vip-package/unlock/{id}', [VipPackageController::class, 'updateUnlock'])->name('upU.Vip');
    Route::put('/vip-package/lock/{id}', [VipPackageController::class, 'updateLock'])->name('upL.Vip');
    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::resource('/', NotificationController::class)->except(['show']); // Trừ show vì không có Route cho nó
        Route::get('/create', [NotificationController::class, 'create'])->name('create');
        Route::get('/edit/{id}', [NotificationController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [NotificationController::class, 'update'])->name('update');
        Route::get('/trashed', [NotificationController::class, 'trashed'])->name('trashed');
        Route::delete('/destroy/{id}', [NotificationController::class, 'destroy'])->name('destroy');
        Route::post('restore/{id}/', [NotificationController::class, 'restore'])->name('restore');
        Route::delete('forceDelete/{id}/', [NotificationController::class, 'forceDelete'])->name('forceDelete');
        Route::patch('/toggleStatus/{id}', [NotificationController::class, 'toggleStatus'])->name('toggleStatus');
    });
    Route::get('/sale_news', [SaleNewsController::class, 'list_salenew'])->name('sale_new.list');

    route::post('/sale_news/reject/{id}', [SaleNewsController::class, 'reject'])->name('sale_news.reject');
    Route::delete('/sale_news/{id}', [SaleNewsController::class, 'destroy'])->name('sale_news.destroy');
    route::post('/sale_news/approve/{id}', [SaleNewsController::class, 'approve'])->name('sale_news.approve');
    Route::get('/manage-profile', [ManageProfileController::class, 'index'])->name('manage-profile.index');
    Route::patch('/manage-profile', [ManageProfileController::class, 'update'])->name('manage-profile.update');
    Route::get('/change-password', [ManageProfileController::class, 'showChangePasswordForm'])->name('change-password.index');
    Route::post('/change-password', [ManageProfileController::class, 'updatePassword'])->name('change-password.update');
    Route::get('/setting', [SettingsController::class, 'index'])->name('setting.index');

    Route::post('/update-settings', [SettingsController::class, 'updateSettings'])->name('settings.update');
    Route::prefix('payment')->group(function () {
        Route::get('/preview', function () {
            return view('admin.payments.preview');
        });
        Route::get('/transactions', [TransactionController::class, 'index']);
        Route::get('/account', function () {
            return view('admin.payments.receiving-account');
        });
    });
});


// admin

Route::middleware(['auth.role.admin'])->group(function () {

    Route::prefix('account')->group(function () {
        Route::get('/employee-management', [StaffController::class, 'index'])->name('renderstaff');
        Route::post('/employee-management', [StaffController::class, 'store'])->name('addStaff');
        Route::get('/employee-management/employeedetails/edit/{id}', [StaffController::class, 'edit'])->name('editStaff');
        Route::put('/employee-management/employeedetails/update/{id}', [StaffController::class, 'update'])->name('updateStaff');
        Route::delete('/employee-management/employeedetails/delete/{id}', [StaffController::class, 'destroy'])->name('deleteStaff');
    });
    Route::prefix('trash')->group(function () {
        Route::get('/trash-sale-news', [SaleNewsController::class, 'trash'])->name('trash.salenews');
        Route::post('/sale-news/restore/{id}', [SaleNewsController::class, 'restore'])->name('restore-salenews');
        Route::delete('/sale-news/delete/{id}', [SaleNewsController::class, 'destroyofadmin'])->name('delete-salenews');

        Route::get('/trash-blog', [BlogController::class, 'trash'])->name('trash.blog');
        Route::post('/blog/restore/{id}', [BlogController::class, 'restore'])->name('restore-blog');
        Route::delete('/blog/delete/{id}', [BlogController::class, 'destroyofadmin'])->name('delete-blog');

        Route::get('/trash-categories', [CategoryController::class, 'trash'])->name('trash.category');
        Route::post('/category/restore/{id}', [CategoryController::class, 'restore'])->name('restore-category');
        Route::delete('/category/delete/{id}', [CategoryController::class, 'destroyofadmin'])->name('delete-category');
    });

    Route::prefix('config')->group(function () {
        Route::get('/seo', [ConfigController::class, 'index'])->name('seo');
        Route::get('/get-scripts', [ConfigController::class, 'getScripts'])->name('getScripts');
        Route::post('/save-script', [ConfigController::class, 'saveScript'])->name('saveScript');
        Route::post('/delete-script', [ConfigController::class, 'deleteScript'])->name('deleteScript');
        Route::post('/save-notification', [ConfigController::class, 'saveNotification'])->name('saveNotification');
        Route::get('/get-notification', [ConfigController::class, 'getnotification'])->name('getnotification');

        Route::get('/telegram', [ConfigController::class, 'createBotTeleGram'])->name('config.telegram');
        Route::post('/telegram', [ConfigController::class, 'storeBotTeleGram'])->name('store.telegram');

        Route::get('/vnpay', [ConfigController::class, 'createVnPay'])->name('config.vnpay');
        Route::post('/vnpay', [ConfigController::class, 'storeVnPay'])->name('store.vnpay');

        Route::get('/mail', [ConfigController::class, 'createMail'])->name('config.mail');
        Route::post('/mail', [ConfigController::class, 'storeMail'])->name('store.mail');
    });
});
// user
Route::middleware('auth')->group(function () {
    Route::post('/channel/togglesalenew/{id}', [SaleNewsController::class, 'toggleStatus'])->name('sale-news-channel.toggleStatus');

    Route::delete('wishlist/{like}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
    Route::post('/add-to-wishlist', [WishlistController::class, 'addToWishlist'])->name('addToWishlist');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
    Route::get('/wishlist-count', [WishlistController::class, 'count'])->name('wishlist.count');

    Route::post('/wishlist/toggle', [WishlistController::class, 'toggleWishlist'])->name('toggleWishlist');

    //end wishlisst

    Route::post('payment', [VnPayController::class, 'initiatePayment'])->name('vnpay.initiatePayment');
    Route::get('/IPN', [VnpayController::class, 'handleIPN']);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::prefix('message')->group(function () {
        Route::get('/conversations', [ConversationController::class, 'loadConversations'])->name('message.conversations');
        Route::get('/check-conversations', [ConversationController::class, 'CheckConversation'])->name('message.checkconversations');
        Route::get('/create-conversations', [ConversationController::class, 'CreateConversation'])->name('message.createconversations');
        Route::post('/save-message/{namechannel}', [MessageController::class, 'store'])->name('message.savemessage');
        Route::get('/get-messages/{name}', [MessageController::class, 'getMessages'])->name('message.getmessage');
    })->middleware(['auth', 'verified']);
    Route::prefix('partners')->name('partners.')->group(function () {
        Route::get('/', [PartnerController::class, 'dashboard'])->name('dashboard');
        Route::get('profile', [PartnerProfileController::class, 'index'])->name('profile');
        Route::patch('/profile/{profile}', [PartnerProfileController::class, 'update'])->name('profile.update');
        Route::get('/infomation/', [PartnerProfileController::class, 'infomation'])->name('infomation');
        Route::get('/infomation/create', [PartnerProfileController::class, 'createInfomation'])->name('create.infomation');
        Route::post('/infomation/store', [PartnerProfileController::class, 'storeInfomation'])->name('store.infomation');
        Route::get('/infomation/edit/{channel_id}', [PartnerProfileController::class, 'editInfomation'])->name('edit.infomation');
        Route::put('/infomation/update/{channel_id}', [PartnerProfileController::class, 'updateInfomation'])->name('update.infomation');

        Route::get('/sale-news/add', [SaleNewsController::class, 'createSaleNewsPartner'])->name('createSaleNewsPartner');
        Route::post('/sale-news/add', [SaleNewsController::class, 'storeSaleNewsPartner'])->name('add.storeSaleNewsPartner');
        Route::get('/sale-news', [SaleNewsController::class, 'indexSaleNewsPartner'])->name('indexSaleNewsPartner');

        Route::post('/sale-news/{id}/toggle-status', [BlogController::class, 'toggleStatus'])->name('saleNews.toggleStatus');
    });
    Route::get('/salenews/{id}/promote', [SaleNewsController::class, 'promote'])->name('salenew.promote');
    Route::get('/salenews-status', [SaleNewsController::class, 'getAllSaleStatus'])->name('sl.index');
    Route::get('/confirmedSale/{id}', [SaleNewsController::class, 'confirmedSale'])->name('sl.confirmedSale');
    Route::prefix('sale-news')->group(function () {
        Route::get('/add', [SaleNewsController::class, 'create'])->name('products.create');
        Route::post('/add', [SaleNewsController::class, 'store'])->name('add.sale-news');
    });

    Route::get('/get-subcategories/{categoryId}', [SaleNewsController::class, 'getSubcategories']);
    Route::post('/follow-channel/{channel_id}', [ChannelController::class, 'followChannel'])->name('follow.channel');
    Route::delete('/unfollow-channel/{channel_id}', [ChannelController::class, 'unfollowChannel'])->name('unfollow.channel');
    Route::get('/redirect-to-payment', [VnPayController::class, 'initiatePayment'])->name('redirect_to_payment');

    Route::prefix('notifications')->name('notifications.')->group(function () {
        Route::get('/view-all/', [NotificationController::class, 'show'])->name('show');
        Route::get('/{notification}', [NotificationController::class, 'detail'])->name('detail');
    });
    Route::get('/user/manage', [UserManageController::class, 'index'])->name('user.manage');
    Route::post('/user/manage/update', [UserManageController::class, 'updateProfile'])->name('user.manage.update');

    Route::delete('/unfollow/{id}', [UserManageController::class, 'unfollow'])->name('channels.unfollow');
    Route::get('/transaction-history', [TransactionController::class, 'user_transaction_history'])->name('user.transaction_history');
    Route::get('partners/list-notification', [PartnerController::class, 'list_notification'])->name('list_notification');
});
// enduser





// guest

Route::get('/search', [SaleNewsController::class, 'search'])->name('search');
Route::get('/seach-category', [SaleNewsController::class, 'search_category'])->name('seach-category');
Route::match(['get', 'post'], '/search-channel/{id}', [ChannelController::class, 'search_channel'])->name('search_channel');
Route::get('all-sale-news', [SaleNewsController::class, 'all_sale_news'])->name('salenews.all');
Route::get('/user/{id}', [UserManageController::class, 'show'])->name('user.show');
//end show
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog/search', [BlogController::class, 'search'])->name('blog.search');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/blog/listting', [BlogController::class, 'listting'])->name('blogs.listting');
Route::get('/blog/detail/{id}', [BlogController::class, 'detail'])->name('blogs.detail');
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/verify', [VerificationController::class, 'showVerifyForm'])->name('verification.show');
Route::post('/verify', [VerificationController::class, 'verify'])->name('verification.verify');
Route::get('staff/login', [StaffAuthController::class, 'showLoginForm'])->name('staff.login');
Route::post('staff/login', [StaffAuthController::class, 'login']);
Route::get('/salenew-detail/{id}', [SaleNewsController::class, 'renderSaleNewDetail'])->name('salenew.detail');
Route::prefix('staff')->group(function () {
    Route::get('/forgot-password', [StaffForgotPasswordController::class, 'showLinkRequestForm'])->name('staff.password.request');
    Route::post('/forgot-password', [StaffForgotPasswordController::class, 'sendResetLinkEmail'])->name('staff.password.email');
    Route::get('/reset-password/{token}', [StaffResetPasswordController::class, 'showResetForm'])->name('staff.password.reset');
    Route::post('/reset-password', [StaffResetPasswordController::class, 'reset'])->name('staff.password.update');
});
Route::resource('channels', ChannelController::class);

    // end guest