<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Subcategory;

use Illuminate\Support\Facades\Auth;
use App\Models\Like;
abstract class Controller
{
    public function home(){
        $data = Product::with(['subcategory','firstImage'])->get(); // Tải thêm subcategory và category liên quan
        
      
        $likedProducts = Like::where('user_id', Auth::id())->pluck('product_id')->toArray();

        // return view('admin.products.index', ['data' => $data, 'likedProducts' => $likedProducts]);
    
        return view('home',['data'=>$data,'likedProducts' => $likedProducts]);
    }

    
}
