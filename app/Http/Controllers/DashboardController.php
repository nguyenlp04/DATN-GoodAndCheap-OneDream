<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = Carbon::today();
        $previousDate = Carbon::yesterday();

        $staffId = Auth::guard('staff')->user()->staff_id;
        $infoStaff = DB::table('staffs')->where('staff_id', $staffId)->first();

        // Tổng doanh thu hôm nay và hôm qua
        $todayRevenue = DB::table('transactions')
            ->whereDate('created_at', $currentDate)
            ->sum('amount');

        $yesterdayRevenue = DB::table('transactions')
            ->whereDate('created_at', $previousDate)
            ->sum('amount');

        // Tính toán sự thay đổi phần trăm
        $percentageDifference = $yesterdayRevenue > 0
            ? (($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100
            : ($todayRevenue > 0 ? 100 : 0); // Tránh chia cho 0

        $todayTransactionsCount = DB::table('transactions')
            ->whereDate('created_at', $currentDate) // Lọc theo ngày hôm nay
            ->count();

        $thisMonthRevenue = DB::table('transactions')
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        $totalSaleNewsVip = DB::table('vip_packages')
            ->where('type', 'user') // Lọc theo type = 'user' cho Sale News
            ->count(); // Tính tổng số tiền hoặc số lượng gói VIP (dựa trên cột 'amount')

        // Tổng gói VIP của loại 'channel'
        $totalChannelVip = DB::table('vip_packages')
            ->where('type', 'channel') // Lọc theo type = 'channel'
            ->count(); // Tính tổng số tiền hoặc số lượng gói VIP (dựa trên cột 'amount')

        $revenuePackageSaleNews = DB::table('transactions')
            ->where('upgrade', 'Upgrade Sale News')
            ->sum('amount');
        $totalOrdersPackageSaleNews = DB::table('transactions')
            ->where('upgrade', 'Upgrade Sale News')
            ->count();

        $revenuePackageChannel = DB::table('transactions')
            ->where('upgrade', 'Upgrade Channel')
            ->sum('amount');

        $totalOrdersPackageChannel = DB::table('transactions')
            ->where('upgrade', 'Upgrade Channel')
            ->count();

        $totalSaleNews = DB::table('sale_news')
            ->count();

        $totalChannels = DB::table('channels')
            ->count();

        $totalTarget = $totalSaleNews + $totalChannels;
        if ($totalTarget == 0) {
            $totalTarget = 1;
        }
        $percentageSaleNews = ($totalSaleNews / $totalTarget) * 100;
        // Tính phần trăm của Channels
        $percentageChannels = ($totalChannels / $totalTarget) * 100;

        $totalSaleNewsPending = DB::table('sale_news')
            ->where('approved', 0)
            ->count();
        $totalSales = $revenuePackageSaleNews + $revenuePackageChannel;

        $fiveTransactions = Transactions::with('user')
            ->orderBy('transaction_id', 'desc')
            ->limit(5)
            ->get();
        // dd($fiveTransactions);


        $totalOrders = DB::table('transactions')
            ->count();
        // Gộp tất cả vào mảng data
        $data = [
            'percentageDifference' => round($percentageDifference, 2),
            'infoStaff' => $infoStaff,
            'todayRevenue' =>  number_format($todayRevenue, 2),
            'yesterdayRevenue' => $yesterdayRevenue,
            'currentDate' => $currentDate,
            'previousDate' => $previousDate,
            'todayTransactionsCount' => $todayTransactionsCount, // Thêm số giao dịch vào data
            'totalSaleNewsVip' => $totalSaleNewsVip, // Tổng gói VIP cho Sale News (type 'user')
            'totalChannelVip' => $totalChannelVip,
            'revenuePackageSaleNews' => number_format($revenuePackageSaleNews, 2),
            'revenuePackageChannel' => number_format($revenuePackageChannel, 2),
            'totalSales' => number_format($totalSales, 2),
            'totalOrders' => number_format($totalOrders),
            'totalOrdersPackageSaleNews' => number_format($totalOrdersPackageSaleNews),
            'totalOrdersPackageChannel' => number_format($totalOrdersPackageChannel),
            'totalSaleNews' => number_format($totalSaleNews),
            'totalChannels' => number_format($totalChannels),
            'totalSaleNewsPending' => number_format($totalSaleNewsPending),
            'thisMonthRevenue' => number_format($thisMonthRevenue, 2),
            'fiveTransactions' => $fiveTransactions,
            'percentageSaleNews' => ceil($percentageSaleNews),
            'percentageChannels' => ceil($percentageChannels),
            // dd($percentageChannels, ceil($percentageChannels))



        ];

        // Trả về view với mảng data
        return view('admin.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Code to show a form for creating a new resource
        return view('dashboard.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Code to store a new resource

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Code to display a specific resource
        // $resource = Dashboard::findOrFail($id);

        return view('dashboard.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Code to show a form for editing a specific resource
        // $resource = Dashboard::findOrFail($id);

        return view('dashboard.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Code to update a specific resource

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Code to delete a specific resource

    }
}
