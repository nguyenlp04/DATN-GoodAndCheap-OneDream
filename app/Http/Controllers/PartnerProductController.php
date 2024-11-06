<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PartnerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('partner.products.list_products');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('partner.products.create_products');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('partner.products.edit_products');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
