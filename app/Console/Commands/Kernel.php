<?php
namespace App\Console;

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\CheckVipStatusJob;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Chạy command hàng ngày
        $schedule->command('vip:check-status')->daily();
    }
}
