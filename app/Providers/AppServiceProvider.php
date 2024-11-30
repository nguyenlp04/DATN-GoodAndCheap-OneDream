<?php

namespace App\Providers;

use App\Models\Channel;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;


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
        Paginator::useBootstrap();
        $setting = Setting::first() ?? new Setting();
        View::share('setting', $setting);
        View::composer('*', function ($view) {
            // Loại trừ các view trong thư mục admin
            if (str_starts_with($view->getName(), 'admin')) {
                return; // Không chia sẻ biến với view admin
            }
            
            // Lấy tất cả các thông báo công khai
            $notifications_userid = Notification::where('status', 'public')->get();
            $notification_web = Notification::where('type', 'website')->get();

            // ID của người dùng hiện tại
            $userId = Auth::check() ? Auth::user()->user_id : null;

            // Lọc thông báo theo user_id
            $filteredNotifications = $notifications_userid->filter(function ($notification) use ($userId) {
                $selectedUsers = json_decode($notification->selected_users, true);
                return in_array($userId, $selectedUsers);
            });

            // Kết hợp và sắp xếp theo ngày
            $mergedNotifications = $filteredNotifications->merge($notification_web)
                ->sortByDesc('created_at')
                ->toArray();

            // Kết quả
            // dd($mergedNotifications);


            $view->with(['notifications' => $mergedNotifications]);
        });
    }
}
