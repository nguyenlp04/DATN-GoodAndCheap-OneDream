<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;

use Illuminate\Support\Facades\Auth;
use App\Models\Like;


abstract class Controller
{
    public function home()
    {

      

        return view('home', ['data' => $data, 'likedProducts' => $likedProducts]);
    }
   
}
