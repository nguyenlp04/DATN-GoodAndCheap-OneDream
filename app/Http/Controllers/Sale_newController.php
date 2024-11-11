<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class Sale_newController extends Controller
{
    public function list_salenew(){
        return view('admin.sale_new.sale_new_list');
    }
}
