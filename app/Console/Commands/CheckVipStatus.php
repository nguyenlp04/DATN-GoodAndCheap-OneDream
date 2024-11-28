<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Listing;
use App\Models\Channel;
use App\Models\SaleNews;
use App\Services\PhpMailerService;
// use App\Services\PhpMailerService;
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
        $currentDate = Carbon::now();
        $threeDaysAgo = $currentDate->subDays(3);
        $Check = Channel::with('vipPackage', 'user')->where('vip_end_at', '<', $threeDaysAgo)->get();
        // $this->info($Check);
        if ($Check->count() > 0) {
            foreach ($Check as $channel) {
                $to = $channel->user->email; // Giả sử email của channel được lưu trong trường 'email'
                $subject = 'Notice of VIP package renewal';
                $body = '
        <div marginwidth="0" marginheight="0">
            <div style="color: transparent; opacity: 0; font-size: 0px; border: 0; max-height: 1px; width: 1px; margin: 0px; padding: 0px; border-width: 0px !important; display: none !important; line-height: 0px !important;">
                <img
                    border="0"
                    width="1"
                    height="1"
                    src="https://ci3.googleusercontent.com/meips/ADKq_NZczalnaVYGnYrdvaFWfKkm8MYubPmbZKksh79EtOmsJVGumVcFQEkSA3KM0spgbbZe16ndYwTlQ4lW91Bqi6il2kGz4DROkZph8Mw_GL6oI8vlZaDNzVZs_sz82yDTMMtECwkerljbHkAKqAPh784fpZxNEW3LqXOn7H3R0uwF0RF_ix87udY3_4V7xB29GfUEjQE=s0-d-e1-ft#http://click.rayobyte.com/q/deUYDB8guD08uoMF_kvxYg~~/AACLYQA~/RgRpGXGcPVcDc3BjQgpnNxw-OGezTUEPUhBoYXZ5QGxpbmRzZS5zaG9wWAQAAAAA"
                    alt=""
                    class="CToWUd"
                    data-bit="iit"
                />
            </div>
            <center>
                <table align="center" border="0" cellpadding="0" cellspacing="0" height="100%" width="100%" id="bodyTable">
                    <tbody>
                        <tr>
                            <td align="center" valign="top" id="bodyCell">
                                <table border="0" cellpadding="0" cellspacing="0" id="templateContainer" style="max-width: 100%; width: 100%;">
                                    <tbody>
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" id="templateHeader" style="max-width: 100%; width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top">

                                                                    <img
                                                                        src="https://drive.google.com/drive/folders/1Qx_x5POPc9jladjUF3c2O07kEpevQbva"
                                                                        style="max-width: 600px; padding: 20px;"
                                                                        id="headerImage"
                                                                        alt="Rayobyte"
                                                                        class="CToWUd"
                                                                        data-bit="iit"
                                                                    />

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td align="center" valign="top">
                                                <table border="0" cellpadding="0" cellspacing="0" id="templateBody" style="max-width: 100%; width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td valign="top">
                                                                <p dir="ltr"><span>Dear ' . $channel->user->full_name . ',</span></p>
                                                                <p dir="ltr">
                                                                    <span>I hope you are doing well and having a great day. This is a billing reminder that your Invoice VIP.</span> ' . $channel->vipPackage->vip_package_id . ' <strong></strong>
                                                                    <span> is due on </span> <strong>' . $channel->vip_end_at . '</strong> <span>.</span>
                                                                </p>
                                                                <p>
                                                                    <span><span>&nbsp;</span></span>
                                                                </p>
                                                                <p dir="ltr"><span>Pay attention and complete the renewal so it doesn t disrupt the selling experience</span></p>
                                                                <p dir="ltr"><span>Balance Due: ' . $channel->vipPackage->price . ' USD</span></p>
                                                                <p dir="ltr">
                                                                    <span>
                                                                        Sincerely,<br />
                                                                        <br />
                                                                        OneDream Support
                                                                    </span>
                                                                </p>
                                                                <div><span>&nbsp;</span></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </center>
        </div>
        ';


                // Gửi email
                $result = PhpMailerService::sendEmail($to, $subject, $body);

                //     if ($result !== true) {

                //         echo "Lỗi khi gửi email cho kênh {$channel->name}: {$result}";
                //     }
            }

            // $this->info('thanh cong');
        }






        // Lấy thời gian hiện tại

        // Cập nhật trạng thái VIP cho các tin rao nếu gói VIP đã hết hạn
        SaleNews::where('vip_end_at', '<', $currentDate)
            ->update(['vip_package_id' => null, 'vip_start_at' => null, 'vip_end_at' => null]);

        // Cập nhật trạng thái VIP cho các kênh nếu gói VIP đã hết hạn
        Channel::where('vip_end_at', '<', $currentDate)
            ->update(['vip_package_id' => null, 'vip_start_at' => null, 'vip_end_at' => null]);

        // In ra thông báo sau khi hoàn thành
        $this->info('VIP status has been checked and updated.');
    }
}
