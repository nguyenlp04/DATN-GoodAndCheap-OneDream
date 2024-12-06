<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = Setting::first() ?? new Setting();
        return view("admin.setting.setting", compact('setting'));
    }


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








    public function updateSettings(Request $request)
    {

        $settings = Setting::first();
        if (!$settings) {
            $settings = new Setting();
        }

        $request->validate([
            'site_name' => 'required|string|max:255',
            'meta_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string',
            'contact_email' => 'required|email|max:255',
            'contact_phone' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'facebook_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'twitter_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'logo' => 'nullable|image|mimes:png|max:6048',
            'logo_mobile' => 'nullable|image|mimes:png|max:6048',
            'favicon' => 'nullable|image|mimes:png|max:6048',
            'banner1' => 'nullable|image|max:6048',
            'banner2' => 'nullable|image|max:6048',
            'banner3' => 'nullable|image|max:6048',
        ], [
            'logo.mimes' => 'The logo must be in PNG format.',
            'logo.max' => 'The logo must not exceed 6MB.',
            'logo_mobile.mimes' => 'The mobile logo must be in PNG format.',
            'logo_mobile.max' => 'The mobile logo must not exceed 6MB.',
            'favicon.mimes' => 'The favicon must be in PNG format.',
            'favicon.max' => 'The favicon must not exceed 6MB.',
        ]);
        try {
            // Update các cột trong bảng `settings`
            $settings->site_name = $request->input('site_name');
            $settings->meta_title = $request->input('meta_title');
            $settings->meta_description = $request->input('meta_description');
            $settings->contact_email = $request->input('contact_email');
            $settings->contact_phone = $request->input('contact_phone');
            $settings->address = $request->input('address');
            $settings->facebook_link = $request->input('facebook_link');
            $settings->instagram_link = $request->input('instagram_link');
            $settings->twitter_link = $request->input('twitter_link');
            $settings->youtube_link = $request->input('youtube_link');

            $uploadFields = ['logo', 'logo_mobile', 'favicon', 'banner1', 'banner2', 'banner3'];
            foreach ($uploadFields as $field) {
                if ($request->hasFile($field)) {
                    if (!empty($settings->$field)) {
                        $oldImagePath = public_path($settings->$field);
                        if (file_exists($oldImagePath)) {
                            unlink($oldImagePath);
                        }
                    }
                    // Lưu ảnh mới
                    $imageName = $field . '_' . time() . '.' . $request->file($field)->extension();
                    $imagePath = $request->file($field)->storeAs('settings', $imageName, 'public');
                    $settings->$field = 'storage/' . $imagePath;
                }
            }
            $settings->save();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Settings updated successfully!',
            ]);
        } catch (\Exception $e) {
            // Nếu có lỗi xảy ra
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'An error occurred while updating settings: ' . $e->getMessage(),
            ]);
        }
    }
}