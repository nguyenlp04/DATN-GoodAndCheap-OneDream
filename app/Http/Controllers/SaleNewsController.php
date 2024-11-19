<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

use App\Models\Subcategory;
use App\Models\SubcategoryAttribute;
use App\Models\SaleNews;

class SaleNewsController extends Controller




{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        //

        $data = SaleNews::with(['user', 'subcategory', 'firstImage', 'categoryToSubcategory'])->get();
        return view('admin.products.index', ['data' => $data]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('sale-news.add-sale-news', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        try {
            $validatedData = $request->validate([
                'productTitle' => 'required|string',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'subcategory_id' => 'required|integer',
                'variant' => 'required',
                // 'images.*' => 'required|max:2048',
            ]);
            // dd($errors->all());
            // dd($validatedData, auth()->user()->user_id);

            $jsonData = json_encode($validatedData['variant']);

            $productData = [
                'user_id' => auth()->user()->user_id,
                'title' => $validatedData['productTitle'],
                'price' => $validatedData['price'],
                'description' => $validatedData['description'],
                'sub_category_id' => $validatedData['subcategory_id'],
                'data' => $jsonData,
                'status' => 1,
                'created_at' => now(),
            ];

            // dd($productData);
            // $query=DB::table('sale_news')->insert($productData);


            $insertSaleNews = DB::table('sale_news')->insertGetId($productData);

            $imageRecords = [];
            foreach ($request->file('images') as $image) {
                $imageName = 'sale-news_' . time() . '_' . uniqid() . '.' . $image->extension();
                $imagePath = 'storage/sale-news/' . $imageName;
                Storage::disk('public')->putFileAs('sale-news', $image, $imageName);
                $imageRecords[] = [
                    'sale_new_id' => $insertSaleNews,
                    'image_name' => $imagePath,
                    'created_at' => now(),
                ];
            }
            if (!empty($imageRecords)) {
                DB::table('photo_gallery')->insert($imageRecords);
            }
            if ($insertSaleNews) {
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Added Successfully !'
                ]);
            } else {
                return redirect()->back()->with('alert', [
                    'type' => 'error',
                    'message' => 'Không thành công !'
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Lỗi: ' . $e->getMessage() . ' in file ' . $e->getFile() . ' on line ' . $e->getLine()
            ]);
        }
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

        // $dataProductID= DB::table('products')->where('product_id',$id)->first();ß
        // $dataProductID = Product::with(['subcategory', 'images',])->where('product_id', $id)->first();
        $dataCategory = Category::with(['subcategories'])->get();
        // dd($dataCategory);
        return view('admin.products.update-product', [
            // 'dataProductID' => $dataProductID,
            'dataCategory' => $dataCategory
        ]);

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

    public function destroy(string $product_id)
    {
        try {
            $product = Product::find($product_id);
            if ($product) {
                $product->is_delete = '1';
                $product->save();
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Product deleted successfully!'
                ]);
            }
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Product not found!'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => ' Error : ' . $th->getMessage()
            ]);
        }
    }
    public function renderProductDetails(string $id)
    {


        $product = Product::with(['channel', 'images', 'firstImage', 'category', 'subcategory'])->where('product_id', $id)->first();
        $data = $product->data;
        //    die($product);
        $data_json = json_decode($data);
        $variants = json_decode($data_json->variants);
        $variant_data_details = json_decode($data_json->variant_data_details);
        return view('product.product-detail', [
            'product' => $product,
            'variants' => $variants,
            'variant_data_details' => $variant_data_details


        ]);
    }

}
