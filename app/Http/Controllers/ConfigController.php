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
        //
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

        // Lấy dữ liệu khác từ cơ sở dữ liệu
        $channels = Channel::all();
        $users = User::all();

        // Trả về view với dữ liệu
        return view('admin.config.telegram', compact('users', 'channels', 'data'));
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
    public function createVnPay()
    {
        $channels = Channel::all();
        $users = User::all();
        return view('admin.config.vnpay', compact('users', 'channels'));
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
