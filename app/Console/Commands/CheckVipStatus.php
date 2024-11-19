<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Listing;
use App\Models\Channel;
use App\Models\SaleNews;
use Carbon\Carbon;

class CheckVipStatus extends Command
{
    // Định nghĩa tên và tham số của command
    protected $signature = 'vip:check-status';

    // Mô tả của command, sẽ hiển thị khi chạy `php artisan list`
    protected $description = 'Check and update VIP status for listings and channels';

    // Constructor để khởi tạo command
    public function __construct()
    {
        parent::__construct();
    }

    // Phương thức `handle` sẽ được gọi khi chạy command
    public function handle()
    {
        // Lấy thời gian hiện tại
        $currentDate = Carbon::now();

        // Cập nhật trạng thái VIP cho các tin rao nếu gói VIP đã hết hạn
        SaleNews::where('vip_end_date', '<', $currentDate)
            ->update(['vip_package_id' => null, 'vip_start_date' => null, 'vip_end_date' => null]);

        // Cập nhật trạng thái VIP cho các kênh nếu gói VIP đã hết hạn
        Channel::where('vip_end_date', '<', $currentDate)
            ->update(['vip_package_id' => null, 'vip_start_date' => null, 'vip_end_date' => null]);

        // In ra thông báo sau khi hoàn thành
        $this->info('VIP status has been checked and updated.');
    }
}
