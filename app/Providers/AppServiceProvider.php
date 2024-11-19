<?php

namespace App\Providers;

use App\Models\Channel;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */


    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Loại trừ các view trong thư mục admin
            if (str_starts_with($view->getName(), 'admin')) {
                return; // Không chia sẻ biến với view admin
            }

            // Kiểm tra nếu người dùng đã đăng nhập và lấy ID người dùng
            $userId = Auth::check() ? Auth::user()->id : null;
            // Lấy các thông báo mà người dùng có thể nhận
            $notifications = Notification::where('status', 'public')
                ->orWhere(function ($query) use ($userId) {
                    $query->where('status', 'private')
                        ->whereJsonContains('selected_users', (string) $userId); // Kiểm tra ID người dùng trong mảng JSON
                })
                ->paginate(10);

            // Chia sẻ biến với các view khác
            $view->with(['notifications' => $notifications, 'userId' => $userId]);
        });
    }
}
