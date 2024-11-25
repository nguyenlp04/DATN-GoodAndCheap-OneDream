<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ManageProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.profile.edit');
    }
    public function showChangePasswordForm()
    {
        return view('admin.profile.change-password');
    }
    public function update(Request $request)
    {
        $staff = Auth::guard('staff')->user();

        $emailRules = ['required', 'email', 'max:255'];

        if ($request->input('email') !== $staff->email) {
            $emailRules[] = Rule::unique('users')->ignore($staff->staff_id);
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => $emailRules,
            'address' => 'required|string|max:255',
            'avata' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $updateData = [
            'full_name' => $request->input('full_name'),
            'email' => $request->input('email'),
            'address' => $request->input('address'),
        ];
        if ($request->hasFile('avata')) {
            if ($staff->avata) {
                $oldImagePath = public_path($staff->avata);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Xóa tệp cũ
                }
            }

            $avataName = 'avata_' . time() . '.' . $request->file('avata')->extension();
            $imageAvataPath = $request->file('avata')->storeAs('avatas', $avataName, 'public');
            $updateData['avata'] = 'storage/' . $imageAvataPath;
        }
        // dd($updateData);
        DB::table('staffs')->where('staff_id', $staff->staff_id)->update($updateData);
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Information has been updated successfully!',
        ]);
    }
    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required|min:8',
            'new_password' => 'required|string|min:8|confirmed',
        ]);
        if (!Hash::check($request->input('current_password'), Auth::guard('staff')->user()->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }
        $staff = Auth::guard('staff')->user();
        $data = [
            'password' => Hash::make($validatedData['new_password']),
        ];
        DB::table('staffs')->where('staff_id', $staff->staff_id)->update($data);

        return redirect()->route('manage-profile.index')->with('alert', [
            'type' => 'success',
            'message' => 'Password updated successfully!',
        ]);
    }
}
