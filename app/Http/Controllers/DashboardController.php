<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = Carbon::today();
        $previousDate = Carbon::yesterday();

        // Total revenue for today and yesterday
        $todayRevenue = DB::table('transactions')
            ->whereDate('created_at', $currentDate)
            ->sum('amount');

        $yesterdayRevenue = DB::table('transactions')
            ->whereDate('created_at', $previousDate)
            ->sum('amount');

        // Calculate percentage difference
        $percentageDifference = $yesterdayRevenue > 0
            ? (($todayRevenue - $yesterdayRevenue) / $yesterdayRevenue) * 100
            : ($todayRevenue > 0 ? 100 : 0); // Avoid division by zero

        return view('admin.index', [
            'percentageDifference' => round($percentageDifference, 2)
        ]);
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
