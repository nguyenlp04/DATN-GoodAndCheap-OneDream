<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transactions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Font;



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

        $startOfWeek = Carbon::now()->startOfWeek(); // Lấy ngày đầu tuần (Thứ 2)
        $endOfWeek = Carbon::now()->endOfWeek(); // Lấy ngày cuối tuần (Chủ nhật)

        // Truy vấn doanh thu từng ngày trong tuần
        $WeeklyRevenue = DB::table('transactions')
            ->select(
                DB::raw('DATE_FORMAT(transaction_date, "%W") as weekday'),
                DB::raw('SUM(amount) as total_revenue')
            )
            ->whereBetween('transaction_date', [$startOfWeek, $endOfWeek])
            ->groupBy(DB::raw('DATE_FORMAT(transaction_date, "%W")'))
            ->get();

        // Tạo một mảng chứa các ngày trong tuần
        $daysOfWeek = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        // Tạo một mảng chứa tổng doanh thu cho mỗi ngày
        $weeklyRevenueData = array_fill(0, 7, 0); // Khởi tạo mảng với 7 phần tử, tất cả là 0

        // Duyệt qua dữ liệu trả về và điền vào mảng doanh thu tương ứng với từng ngày
        foreach ($WeeklyRevenue as $item) {
            $dayIndex = array_search($item->weekday, $daysOfWeek); // Tìm vị trí của ngày trong mảng $daysOfWeek
            if ($dayIndex !== false) {
                $weeklyRevenueData[$dayIndex] = $item->total_revenue; // Gán tổng doanh thu vào đúng vị trí
            }
        }

        $totalWeeklyRevenue = array_sum($weeklyRevenueData);

        $dataWeeklyRevenue = [
            'daysOfWeek' => $daysOfWeek, // Mảng các ngày trong tuần
            'weeklyRevenueData' => $weeklyRevenueData, // Mảng tổng doanh thu cho từng ngày
            'totalWeeklyRevenue' => number_format($totalWeeklyRevenue, 2),
        ];



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
            'dataWeeklyRevenue' => $dataWeeklyRevenue,

            // dd($percentageChannels, ceil($percentageChannels))

        ];

        // Trả về view với mảng data
        return view('admin.index', compact('data'));
    }


    public function exportData(Request $request)
    {
        $selectedDateOption = $request->input('date');
        $siteName = DB::table('settings')->value('site_name');

        switch ($selectedDateOption) {
            case 1: // This Month
                $monthTitle = 'Report ' . $siteName . ' This Month';
                $dateMonth = Carbon::now()->month;
                $dateYear = Carbon::now()->year;
                break;
            case 2: // Last Month
                $monthTitle = 'Report ' . $siteName . ' Last Month';
                $dateMonth = Carbon::now()->subMonth()->month;
                $dateYear = Carbon::now()->subMonth()->year;
                break;
            case 3: // All Time
                $monthTitle = 'Report ' . $siteName . ' All Time';
                $dateMonth = null; // No month for all time
                $dateYear = null;  // No year for all time
                break;
            default:
                $monthTitle = 'Report ' . $siteName . ''; // Default title
                break;
        }

        // Query for various data (handling "All Time" case where month and year are null)
        $totalSaleNewsVip = DB::table('vip_packages')
            ->where('type', 'user')
            ->when($dateMonth, function ($query) use ($dateMonth) {
                return $query->whereMonth('created_at', $dateMonth);
            })
            ->when($dateYear, function ($query) use ($dateYear) {
                return $query->whereYear('created_at', $dateYear);
            })
            ->count();

        $totalChannelVip = DB::table('vip_packages')
            ->where('type', 'channel')
            ->when($dateMonth, function ($query) use ($dateMonth) {
                return $query->whereMonth('created_at', $dateMonth);
            })
            ->when($dateYear, function ($query) use ($dateYear) {
                return $query->whereYear('created_at', $dateYear);
            })
            ->count();

        $totalTransactionsCount = DB::table('transactions')
            ->when($dateMonth, function ($query) use ($dateMonth) {
                return $query->whereMonth('created_at', $dateMonth);
            })
            ->when($dateYear, function ($query) use ($dateYear) {
                return $query->whereYear('created_at', $dateYear);
            })
            ->count();

        $revenue = DB::table('transactions')
            ->when($dateMonth, function ($query) use ($dateMonth) {
                return $query->whereMonth('created_at', $dateMonth);
            })
            ->when($dateYear, function ($query) use ($dateYear) {
                return $query->whereYear('created_at', $dateYear);
            })
            ->sum('amount');

        $totalSaleNews = DB::table('sale_news')
            ->when($dateMonth, function ($query) use ($dateMonth) {
                return $query->whereMonth('created_at', $dateMonth);
            })
            ->when($dateYear, function ($query) use ($dateYear) {
                return $query->whereYear('created_at', $dateYear);
            })
            ->count();

        $totalChannels = DB::table('channels')
            ->when($dateMonth, function ($query) use ($dateMonth) {
                return $query->whereMonth('created_at', $dateMonth);
            })
            ->when($dateYear, function ($query) use ($dateYear) {
                return $query->whereYear('created_at', $dateYear);
            })
            ->count();

        $totalSaleNewsPending = DB::table('sale_news')
            ->where('approved', 0)
            ->when($dateMonth, function ($query) use ($dateMonth) {
                return $query->whereMonth('created_at', $dateMonth);
            })
            ->when($dateYear, function ($query) use ($dateYear) {
                return $query->whereYear('created_at', $dateYear);
            })
            ->count();

        $fileName = $monthTitle . '.xlsx';


        // Data to be exported to the Excel file
        $data = [
            ['Description', 'Value'], // Column headers
            ['Vip Package Sale News', $totalSaleNewsVip ?: '0'],
            ['Vip Package Channels', $totalChannelVip ?: '0'],
            ['Transactions', $totalTransactionsCount ?: '0'],
            ['Revenue', '$' . number_format($revenue ?: 0, 2)],
            ['Total Sale News', $totalSaleNews ?: '0'],
            ['Total Channel', $totalChannels ?: '0'],
            ['Sale News Pending', $totalSaleNewsPending ?: '0'],
        ];

        // Create the Excel file
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set title and style for the header
        $sheet->mergeCells('A1:B1');
        $sheet->setCellValue('A1', $monthTitle); // Title
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Style the header row
        $sheet->getStyle('A1:B1')->getFill()->setFillType(Fill::FILL_SOLID);
        $sheet->getStyle('A1:B1')->getFill()->getStartColor()->setARGB('01FF00');

        // Add the data
        $rowIndex = 2;
        foreach ($data as $key => $row) {
            if ($key == 0) continue; // Skip the header row
            $sheet->fromArray($row, null, "A$rowIndex");
            $rowIndex++;
        }

        // Export the Excel file
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
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
