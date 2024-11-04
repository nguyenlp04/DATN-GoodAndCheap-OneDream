<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaleNewsController extends Controller
{
    public function index()
    {
        return view('sale_news.index');
    }
}
