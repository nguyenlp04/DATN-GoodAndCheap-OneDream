<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Channel;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Services\TelegramService;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.setting.seo');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createBotTeleGram()
    {
        $filePath = public_path('admin/js/telegram.json');

        // Biến để lưu dữ liệu từ JSON
        $data = [];

        // Kiểm tra nếu file tồn tại
        if (File::exists($filePath)) {
            // Đọc nội dung của file
            $content = File::get($filePath);

            // Chuyển đổi nội dung JSON thành mảng PHP
            $data = json_decode($content, true);

            // Kiểm tra lỗi khi giải mã JSON
            if (json_last_error() !== JSON_ERROR_NONE) {
                // return response()->json(['error' => 'Invalid JSON format'], 400);
            }
        }


        // Trả về view với dữ liệu
        return view('admin.config.telegram', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeBotTeleGram(Request $request)
    {
        $message = $request->input('message');
        $filePath = public_path('admin/js/telegram.json');

        $requiredPlaceholders = [
            '{UPGRADE}',
            '{NAME_PACKAGE}',
            '{CHANNEL/SALE_NEWS_ID}',
            '{PERIOD}',
            '{TRANSACTION_ID}',
            '{AMOUNT}',
            '{PAYMENT_DATE}',
        ];

        $missingPlaceholders = [];
        foreach ($requiredPlaceholders as $placeholder) {
            if (strpos($message, $placeholder) === false) {
                $missingPlaceholders[] = $placeholder;
            }
        }

        if (!empty($missingPlaceholders)) {
            $missingPlaceholdersString = implode(', ', $missingPlaceholders);

            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'The message is missing required placeholders: ' . $missingPlaceholdersString
            ]);
        }

        // Lưu message vào file JSON
        $jsonContent = json_encode([
            'message' => $message,
        ], JSON_PRETTY_PRINT);

        try {
            File::put($filePath, $jsonContent);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Failed to save message to JSON file!'
            ]);
        }

        // Lưu chatID và botToken vào file .env
        $chatID = $request->input('chatID');
        $botToken = $request->input('botToken');

        try {
            $this->updateEnv([
                'TELEGRAM_CHAT_ID' => $chatID,
                'TELEGRAM_BOT_TOKEN' => $botToken,
            ]);

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Configuration saved successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Failed to save chat ID and bot token to .env!'
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createMail()
    {
        return view('admin.config.mail');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeMail(Request $request)
    {

        $request->validate([
            'mailUserName' => 'required|email', // Validate email format
        ]);

        $mailUserName = $request->input('mailUserName');
        $mailPassWord = $request->input('mailPassWord');
        $mailPassWord = str_replace(' ', '', $mailPassWord);


        try {
            $this->updateEnv([
                'MAIL_USERNAME' => $mailUserName,
                'MAIL_FROM_ADDRESS' => $mailUserName,
                'MAIL_PASSWORD' => $mailPassWord,

            ]);

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Configuration saved successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Failed to save chat ID and bot token to .env!'
            ]);
        }
    }

    public function createVnPay()
    {
        return view('admin.config.vnpay');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeVnPay(Request $request)
    {

        $terminalID = $request->input('terminalID');
        $secretKey = $request->input('secretKey');
        $webUrl = $request->input('webUrl');

        if (!preg_match('/^https?:\/\//', $webUrl)) {
            $webUrl = 'https://' . $webUrl;
        }


        if (!filter_var($webUrl, FILTER_VALIDATE_URL)) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'The provided URL is not valid!'
            ]);
        }



        // Lấy hostname từ URL
        $parsedUrl = parse_url($webUrl);
        $host = $parsedUrl['host'] ?? null;

        $webUrl = preg_replace('/^https?:\/\//', '', $host);
        if (!$host) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'The URL is invalid. Could not extract the domain!'
            ]);
        }



        // dd($webUrl);

        try {
            $this->updateEnv([
                'VNPAY_TERMINAL_ID' => $terminalID,
                'VNPAY_SECRET_KEY' => $secretKey,
                'VNPAY_WEB_URL' => $webUrl,

            ]);

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Configuration saved successfully!'
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Failed to save chat ID and bot token to .env!'
            ]);
        }
    }

    // Hàm cập nhật file .env
    private function updateEnv(array $data)
    {
        $envPath = base_path('.env');
        $envContent = file_get_contents($envPath);

        foreach ($data as $key => $value) {
            $pattern = "/^{$key}=.*$/m";

            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, "{$key}={$value}", $envContent);
            } else {
                $envContent .= "\n{$key}={$value}";
            }
        }

        file_put_contents($envPath, $envContent);
    }


    /**
     * Display the specified resource.
     */

    public function saveScript(Request $request)
    {
        // Lấy nội dung script từ yêu cầu
        $nameContent = $request->input('name');
        $scriptContent = $request->input('script');

        // Đường dẫn đến file script.js
        $filePath = public_path('admin/js/seo.json');

        // Đọc nội dung hiện có của tệp JSON
        $currentData = [];
        if (File::exists($filePath)) {
            $currentData = json_decode(File::get($filePath), true) ?? [];
        }

        // Kiểm tra tên trùng lặp
        foreach ($currentData as $entry) {
            if ($entry['name'] == $nameContent) {
                return response()->json(['error' => 'Name already exists'], 400);
            }
        }

        // Thêm nội dung mới vào mảng
        $currentData[] = [
            'name' => $nameContent,
            'script' => $scriptContent
        ];

        // Chuyển đổi mảng thành JSON
        $jsonContent = json_encode($currentData, JSON_PRETTY_PRINT);

        // Lưu nội dung vào file
        try {
            File::put($filePath, $jsonContent);
            return response()->json([
                'alert' => [
                    'type' => 'success',
                    'message' => 'Settings updated successfully!'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to save script'], 500);
        }
    }
    public function getScripts()
    {
        $filePath = public_path('admin/js/seo.json');

        if (File::exists($filePath)) {
            $scripts = json_decode(File::get($filePath), true) ?? [];
        } else {
            $scripts = [];
        }

        return response()->json($scripts);
    }
    public function deleteScript(Request $request)
    {
        $name = $request->input('name');
        $filePath = public_path('admin/js/seo.json');
        if (File::exists($filePath)) {
            $scripts = json_decode(File::get($filePath), true) ?? [];
            $scripts = array_filter($scripts, function ($script) use ($name) {
                return $script['name'] !== $name;
            });
            File::put($filePath, json_encode(array_values($scripts), JSON_PRETTY_PRINT));
            return response()->json(['alert' => ['type' => 'success', 'message' => 'Script deleted successfully!']]);
        } else {
            return response()->json(['error' => 'Failed to delete script'], 500);
        }
    }


    public function saveNotification(Request $request)
    {
        $notificationContent = $request->input('Floating-notifications');
        $filePath = public_path('admin/js/notification.json');
        $jsonContent = json_encode(['Floating-notifications' => $notificationContent], JSON_PRETTY_PRINT);

        try {
            File::put($filePath, $jsonContent);
            return response()->json([
                'alert' => [
                    'type' => 'success',
                    'message' => 'The notification has been changed!'
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Không thể lưu thông báo'], 500);
        }
    }


    public function getNotification()
    {
        $filePath = public_path('admin/js/notification.json');

        // Kiểm tra nếu file tồn tại
        if (File::exists($filePath)) {
            // Đọc nội dung của file
            $content = File::get($filePath);

            // Chuyển đổi nội dung JSON thành mảng PHP
            $notification = json_decode($content, true);

            // Trả về nội dung dưới dạng JSON response
            return response()->json($notification);
        } else {
            // Trả về thông báo lỗi nếu file không tồn tại
            return response()->json(['error' => 'File not found'], 404);
        }
    }





    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}