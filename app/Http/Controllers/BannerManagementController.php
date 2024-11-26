<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class BannerManagementController extends Controller
{
    // Hiển thị danh sách banner
    public function index()
    {
        $data = Banner::where('is_delete', '!=', 0)->get();
        return view('admin.banner.banner-management', compact('data'));
    }
    // Lưu banner mới
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4048',
                'is_active' => 'required',
                'sort_order' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('alert', [
                    'type' => 'error',
                    'message' => 'Please check your input and try again.',
                ]);
            }
            $validated = $validator->validated();
            if ($request->hasFile('image')) {
                $imageName = 'banner' . time() . '.' . $request->file('image')->extension();
                $image_bannerPath = $request->file('image')->storeAs('banners', $imageName, 'public');
                $validated['image'] = 'storage/' . $image_bannerPath;
            }
            Banner::create($validated);
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Banner has been added successfully!',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ]);
        }
    }
    public function edit($id)
    {
        $dataBannerID = Banner::findOrFail($id);
        $data = Banner::where('is_delete', '!=', 0)->get();
        return view('admin.banner.banner-management', compact('dataBannerID', 'data'));
    }


    public function update(Request $request, $id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4048',
                'is_active' => 'required',
                'sort_order' => 'required|integer',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput()->with('alert', [
                    'type' => 'error',
                    'message' => 'Please check your input and try again.',
                ]);
            }
            $validated = $validator->validated();
            if ($request->hasFile('image')) {
                if ($banner->image) {
                    $oldImagePath = public_path($banner->image);
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }
                $imageName = 'banner' . time() . '.' . $request->file('image')->extension();
                $image_bannerPath = $request->file('image')->storeAs('banners', $imageName, 'public');
                $validated['image'] = 'storage/' . $image_bannerPath;
            }
            $banner->update($validated);
            return redirect()->route('banner.index')->with('alert', [
                'type' => 'success',
                'message' => 'Banner has been updated successfully!',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'An unexpected error occurred: ' . $e->getMessage(),
            ]);
        }
    }
    public function toggleStatus($id)
    {
        try {
            $banner = Banner::findOrFail($id);


            $banner->is_active = $banner->is_active == 1 ? 0 : 1;
            $banner->save();


            return response()->json([
                'status' => $banner->is_active,
                'alert' => $banner->is_active == 1 ? 'Active' : 'Inactive',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'alert' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }

    // Xóa banner
    public function destroy($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $banner->delete();
            return redirect()->route('banner.index')->with('alert', [
                'type' => 'success',
                'message' => 'Banner deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }
}
