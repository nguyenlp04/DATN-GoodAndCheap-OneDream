<?php

namespace App\Http\Controllers;

use App\Models\SaleNews;

class HomeController extends Controller
{
    public function index()
    {
        $data = SaleNews::where('status', '1')
            ->with('images')
            ->where('is_delete', null)
            ->whereNotNull('vip_package_id')
            ->where('approved', '1')
            ->get();

        $topRated = SaleNews::where('status', '1')
            ->with('images')
            ->where('is_delete', null)
            ->whereNull('vip_package_id')
            ->where('approved', '1')
            ->inRandomOrder()
            ->get();

        $bestSelling = SaleNews::where('status', '1')
            ->with('images')
            ->where('is_delete', null)
            ->where('approved', '1')
            ->inRandomOrder()
            ->get();

        $onSale = SaleNews::where('status', '1')
            ->with('images')
            ->where('is_delete', null)
            ->where('approved', '1')
            ->inRandomOrder()
            ->get();

        $recommendation = SaleNews::where('status', '1')
            ->with('images')
            ->where('is_delete', null)
            ->where('approved', '1')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        return view('home', [
            'data' => $data,
            'topRated' => $topRated,
            'bestSelling' => $bestSelling,
            'onSale' => $onSale,
            'recommendation' => $recommendation,
        ]);
    }
}
