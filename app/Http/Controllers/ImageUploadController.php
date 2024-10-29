<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadController extends Controller
{
    public function store(Request $request)
    {
        try {
            $fileName = 'https://canhdonghoatuoi.com/wp-content/uploads/2023/08/z4633100612854_9088e35315c74876ea66b5f447cab126.jpg';
            // $fileName = time() . '.' . $request->image->extension(); 
            $filePath = '/image/category/' . $fileName; 

            $path = Storage::disk('blackblaze')->put(basename($filePath), file_get_contents($fileName), 'private');
            $url = Storage::disk('blackblaze')->url(basename($filePath));
            dd($url,2);
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
