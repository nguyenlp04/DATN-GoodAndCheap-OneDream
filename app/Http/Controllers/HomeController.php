<?php

namespace App\Http\Controllers;

use App\Models\SaleNews;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);
        $data = SaleNews::with('images')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.vip_package_id')
            ->where('sale_news.approved', '1')
            ->where('sale_news.price', '>', 0)
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->select('sale_news.*', 'users.created_at as user_created_at')
            // Sắp xếp các sản phẩm có vip_package_id lên đầu

            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            // Sắp xếp theo thời gian tạo
            ->orderBy('sale_news.created_at', 'desc')
            // Lấy kết quả ngẫu nhiên
            ->inRandomOrder()
            ->get();

        $topRated = SaleNews::with('images')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.approved', '1')
            ->where('sale_news.price', '<', 100)
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->select('sale_news.*', 'users.created_at as user_created_at')
            // Sắp xếp các sản phẩm có vip_package_id lên đầu
            ->orderByRaw("CASE WHEN vip_package_id IS NOT NULL THEN 0 ELSE 1 END")
            // Sắp xếp các sản phẩm có user_id mới tạo trong vòng 3 ngày lên đầu
            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            // Sắp xếp theo thời gian tạo
            ->orderBy('sale_news.created_at', 'desc')
            // Lấy kết quả ngẫu nhiên
            ->inRandomOrder()
            ->get();

        $Trending = SaleNews::with('images')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.approved', '1')
            ->where('sale_news.price', '>', 0)
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->select('sale_news.*', 'users.created_at as user_created_at')
            // Sắp xếp các sản phẩm có vip_package_id lên đầu
            ->orderByRaw("CASE WHEN vip_package_id IS NOT NULL THEN 0 ELSE 1 END")
            // Sắp xếp các sản phẩm có user_id mới tạo trong vòng 3 ngày lên đầu
            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            // Sắp xếp theo thời gian tạo
            ->orderBy('sale_news.views', 'desc')
            // Lấy kết quả ngẫu nhiên
            ->inRandomOrder()
            ->get();
        $moderate =
            SaleNews::with('images')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.approved', '1')
            ->where('sale_news.price', '>', 200)
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->select('sale_news.*', 'users.created_at as user_created_at')
            // Sắp xếp các sản phẩm có vip_package_id lên đầu
            ->orderByRaw("CASE WHEN vip_package_id IS NOT NULL THEN 0 ELSE 1 END")
            // Sắp xếp các sản phẩm có user_id mới tạo trong vòng 3 ngày lên đầu
            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            // Sắp xếp theo thời gian tạo
            ->orderBy('sale_news.views', 'desc')
            // Lấy kết quả ngẫu nhiên
            ->inRandomOrder()
            ->get();


        $recommendation = SaleNews::with('images')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.approved', '1')
            ->where('sale_news.price', '>', 0)
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->select('sale_news.*', 'users.created_at as user_created_at')
            // Sắp xếp các sản phẩm có vip_package_id lên đầu
            ->orderByRaw("CASE WHEN vip_package_id IS NOT NULL THEN 0 ELSE 1 END")
            // Sắp xếp các sản phẩm có user_id mới tạo trong vòng 3 ngày lên đầu
            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            // Sắp xếp theo thời gian tạo
            ->orderBy('sale_news.views', 'desc')
            // Lấy kết quả ngẫu nhiên
            ->inRandomOrder()
            ->get();

        return view('home', [
            'data' => $data,
            'topRated' => $topRated,
            'Trending' => $Trending,
            'onSale' => $moderate,
            'recommendation' => $recommendation,
        ]);
    }
}