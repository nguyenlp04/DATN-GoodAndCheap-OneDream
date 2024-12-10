<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = DB::table('staffs')
            ->where('staff_id', '!=', Auth::guard('staff')->user()->staff_id)
            ->where('role', '!=', 'admin')->get();
        return view('admin.account.employee-management', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = DB::table('staffs')->get();
        return view('admin.account.employee-management', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staffs,email',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'avata' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);


        if ($request->hasFile('avata')) {
            $imageName = 'avata_staff' . time() . '.' . $request->avata->extension();
            Storage::disk('public')->putFileAs('avatas', $request->file('avata'), $imageName);
        } else {

            $imageName = null;
        }

        try {

            $data = [
                'full_name' => $validatedData['full_name'],
                'email' => $validatedData['email'],
                'address' => $validatedData['address'],
                'password' => Hash::make($validatedData['password']),
                'avata' => $imageName ? 'storage/avatas/' . $imageName : null,
                'role' => 'staff',
                'status' => 1,
                'created_at' => now(),
            ];
            $query = DB::table('staffs')->insert($data);
            if ($query) {
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'More Success !'
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
                'message' => 'error: ' . $e->getMessage()
            ]);
        }
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
        $data = DB::table('staffs')->where('role', '!=', 'admin')->where('staff_id', '!=', Auth::guard('staff')->user()->staff_id)->get();
        $dataStaffID = DB::table('staffs')->where('staff_id', $id)->first();
        return view('admin.account.employee-management', [
            'data' => $data,
            'dataStaffID' => $dataStaffID,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $check = DB::table('staffs')->where('staff_id', $id)->first();
            $validatedData = $request->validate([
                'full_name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'status' => 'required|integer',
                'avata' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            $data = [
                'full_name' => $validatedData['full_name'],
                'address' => $validatedData['address'],
                'role' => 'staff',
                'status' => $validatedData['status'],
                'updated_at' => now(),
            ];
            if ($request->hasFile('avata')) {
                if (! $check->avata == null) {
                    if (file_exists(public_path($check->avata))) {
                        unlink(public_path($check->avata));
                    }
                }

                $imageName = 'avata_staff' . time() . '.' . $request->avata->extension();
                Storage::disk('public')->putFileAs('avatas', $request->file('avata'), $imageName);
                $data['avata'] = 'storage/avatas/' . $imageName;
            } else {
                $data['avata'] = $check ? $check->avata : null;
            }

            $query = DB::table('staffs')->where('staff_id', $id)->update($data);

            if ($query) {
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
                'message' => 'error: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $check =  DB::table('staffs')->where('staff_id', $id)->first();
        if ($check) {
            DB::table('staffs')->where('staff_id', $id)->delete();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Delete successful !'
            ]);
        } else {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Not found !'
            ]);
        }
    }
}