<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; 

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $categories = Category::all();
    //     $subcategories = Subcategory::all(); 

    //     return view('admin.products.add-product', compact('categories', 'subcategories'));
    // }

    public function create()
    {
        // Lấy tất cả danh mục
        $categories = Category::all();
        return view('admin.products.add-product', compact('categories'));
    }

    public function getSubcategories($categoryId)
    {
        // Lấy danh mục con theo category_id
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return view('admin.products.add-product');
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
        //
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
