<?php

namespace App\Http\Controllers;

use App\Models\VipPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VipPackageController extends Controller
{
    public function index()
    {
        $vipPackages = VipPackage::all();
        return view('admin.vippackages.list-vip', compact('vipPackages'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'duration' => 'required|integer',
            'status' => 'required|integer',
            'type' => 'required|string',
        ]);

        $VipPackage = VipPackage::create($request->all());
        if ($VipPackage) {
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'New VIP package created successfully !'
            ]);
        }
    }

    public function updateUnlock(Request $request, string $id)
    {
        try {

            $check = DB::table('vip_packages')->where('vip_package_id', $id)->first();
            if ($check) {
                DB::table('vip_packages')->where('vip_package_id', $id)->update(['status' => '1']);
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

            $check = DB::table('vip_packages')->where('vip_package_id', $id)->first();
            if ($check) {
                DB::table('vip_packages')->where('vip_package_id', $id)->update(['status' => '0']);
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
}
