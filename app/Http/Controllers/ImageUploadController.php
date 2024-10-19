<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request, ensuring an image is uploaded
        // $request->validate([
        //     'image' => 'required|image|mimes:jpg,png,jpeg,gif|max:5120', // Max 5MB
        // ]);

        // // Get the uploaded file
        // $image = $request->file('image');

        // // Generate a unique file name
        // $imageName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Store the image on the disk ('blackblaze' or another disk)
        try {
            // $file = file_get_contents('https://canhdonghoatuoi.com/wp-content/uploads/2023/08/z4633100612854_9088e35315c74876ea66b5f447cab126.jpg');
            $file = 'https://canhdonghoatuoi.com/wp-content/uploads/2023/08/z4633100612854_9088e35315c74876ea66b5f447cab126.jpg';
            //dd($file);
            //$path = Storage::disk('blackblaze')->putFileAs('/image',  , 'hhhhh.jpg', 'public');
            $path = Storage::disk('blackblaze')->put('/image/' . basename($file), file_get_contents($file), 'private');
            // $url = Storage::disk('blackblaze')->temporaryUrl(
            //     'filename.txt', now()->addMinutes(5)
            // );
            dd($path);
        } catch (\Exception $ex) {
           dd($ex);
        }
        dd($path);
        if ($path) {
            return back()->with('success', 'Image uploaded successfully!')->with('path', $path);
        } else {
            return back()->with('error', 'Failed to upload image.');
        }
    }
}
