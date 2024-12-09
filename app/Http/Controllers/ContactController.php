<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;


class ContactController extends Controller
{

public function index(){
    return view('contact.contact');
}

public function store(Request $request)
{
    //
}

}