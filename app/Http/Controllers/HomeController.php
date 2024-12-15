<?php

namespace App\Http\Controllers;

use App\Models\SaleNews;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $threeDaysAgo = Carbon::now()->subDays(3);
        $data = SaleNews::with('images', 'channel') 
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.vip_package_id', '!=', null)
            ->where('sale_news.approved', 1)
            ->where('sale_news.price', '>', 0)
            ->leftJoin('channels', 'sale_news.channel_id', '=', 'channels.channel_id')
            ->where(function ($query) {
                $query->where('channels.status', 1)
                    ->orWhereNull('channels.channel_id');
            })
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->where(function ($query) {
                $query->where('users.status', 1)
                    ->orWhereNull('users.user_id');
            })
            ->select('sale_news.*', 'users.created_at as user_created_at')
            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            ->orderBy('sale_news.created_at', 'desc')
            ->inRandomOrder()
            ->get();
        $topRated = SaleNews::with('images', 'channel')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.approved', 1)
            ->where('sale_news.price', '<', 100)
            ->leftJoin('channels', 'sale_news.channel_id', '=', 'channels.channel_id')
            ->where(function ($query) {
                $query->where('channels.status', 1)
                    ->orWhereNull('channels.channel_id');
            })
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->where(function ($query) {
                $query->where('users.status', 1)
                    ->orWhereNull('users.user_id');
            })
            ->select('sale_news.*', 'users.created_at as user_created_at')
            ->orderByRaw("CASE WHEN sale_news.vip_package_id IS NOT NULL THEN 0 ELSE 1 END")
            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            ->orderBy('sale_news.created_at', 'desc')
            ->inRandomOrder()
            ->get();


        $Trending = SaleNews::with('images', 'channel')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.approved', 1)
            ->where('sale_news.price', '>', 0)
            ->leftJoin('channels', 'sale_news.channel_id', '=', 'channels.channel_id')
            ->where(function ($query) {
                $query->where('channels.status', 1)
                    ->orWhereNull('channels.channel_id');
            })
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->where(function ($query) {
                $query->where('users.status', 1)
                    ->orWhereNull('users.user_id');
            })
            ->select('sale_news.*', 'users.created_at as user_created_at')
            ->orderByRaw("CASE WHEN sale_news.vip_package_id IS NOT NULL THEN 0 ELSE 1 END")

            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            ->orderBy('sale_news.views', 'desc')
            ->inRandomOrder()
            ->get();
        $moderate = SaleNews::with('images', 'channel')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.approved', 1)
            ->where('sale_news.price', '>', 200)
            ->leftJoin('channels', 'sale_news.channel_id', '=', 'channels.channel_id')
            ->where(function ($query) {
                $query->where('channels.status', 1)
                    ->orWhereNull('channels.channel_id');
            })
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->where(function ($query) {
                $query->where('users.status', 1)
                    ->orWhereNull('users.user_id');
            })
            ->select('sale_news.*', 'users.created_at as user_created_at')
            ->orderByRaw("CASE WHEN sale_news.vip_package_id IS NOT NULL THEN 0 ELSE 1 END")

            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
            ->inRandomOrder()
            ->get();


        $recommendation = SaleNews::with('images', 'channel')
            ->where('sale_news.status', 1)
            ->whereNull('sale_news.is_delete')
            ->where('sale_news.approved', 1)
            ->where('sale_news.price', '>', 0)
            ->leftJoin('channels', 'sale_news.channel_id', '=', 'channels.channel_id')
            ->where(function ($query) {
                $query->where('channels.status', 1)
                    ->orWhereNull('channels.channel_id');
            })
            ->join('users', 'sale_news.user_id', '=', 'users.user_id')
            ->where(function ($query) {
                $query->where('users.status', 1)
                    ->orWhereNull('users.user_id');
            })
            ->select('sale_news.*', 'users.created_at as user_created_at')
            ->orderByRaw("CASE WHEN sale_news.vip_package_id IS NOT NULL THEN 0 ELSE 1 END")
            ->orderByRaw("CASE WHEN users.created_at >= ? THEN 0 ELSE 1 END", [$threeDaysAgo])
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
