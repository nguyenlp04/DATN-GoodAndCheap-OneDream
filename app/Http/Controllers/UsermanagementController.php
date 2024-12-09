<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsermanagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('users')->get();
        return view('admin.account.user-account-management', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateUnlock(Request $request, string $id)
    {
        try {

            $check = DB::table('users')->where('user_id', $id)->first();
            if ($check) {
                DB::table('users')->where('user_id', $id)->update(['status' => '1']);
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Success !'
                ]);
            } else {
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => 'Failure !'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }
    public function updateLock(Request $request, string $id)
    {
        try {

            $check = DB::table('users')->where('user_id', $id)->first();

            if ($check) {

                DB::table('users')->where('user_id', $id)->update(['status' => '0']);
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Success !'
                ]);
            } else {
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => 'Failure !'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Lỗi: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
