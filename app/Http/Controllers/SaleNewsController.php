<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\SaleNews;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\VipPackage;
use Illuminate\Support\Carbon;


use App\Models\Subcategory;
use App\Models\SubcategoryAttribute;


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
                'hiddenAddress' => 'required',
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
                'address' => $validatedData['hiddenAddress'],
                'approval' => 0,
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

    public function getAllSaleStatus(){
        $data = SaleNews::with('vipPackage','firstImage')
        ->where('status', 1)->where('user_id',auth()->user()->user_id);

        $count_now_showing=$data->where('approved',1)->count();
        $list_now_showing=$data->where('approved',1)->get();

        $list_pending_approval=SaleNews::with('vipPackage','firstImage')
        ->where('approved',0)->where('user_id',auth()->user()->user_id)
        ->get();
        $count_pending_approval=SaleNews::with('vipPackage')
        ->where('approved',0)->where('user_id',auth()->user()->user_id)->count();


        $count_not_accepted=SaleNews::with('vipPackage')
        ->where('approved',2)->where('user_id',auth()->user()->user_id)
        ->count();
        $list_not_accepted=SaleNews::with('vipPackage','firstImage')
        ->where('approved',2)->where('user_id',auth()->user()->user_id)
        ->get();

        $count_hidden=SaleNews::with('vipPackage')
        ->where('status', 1)
        ->where('approved',1)->where('user_id',auth()->user()->user_id)
        ->count();
        $list_hidden=SaleNews::with('vipPackage','firstImage')
        ->where('status', 1)
        ->where('approved',1)->where('user_id',auth()->user()->user_id)
        ->get();
        // dd($list_pending_approval);




        return view('salenews.index',compact('count_now_showing','list_now_showing','list_pending_approval','count_pending_approval','list_not_accepted','count_not_accepted','count_hidden','list_hidden'));
    }
    // public function tv2(){
    //     return view('salenews.promote');
    // }

    public function getSubcategories($categoryId)
    {
        $subcategoryAttributes = SubcategoryAttribute::where('category_id', $categoryId)->get();
        $subcategories = SubCategory::where('category_id', $categoryId)->get();
        return response()->json([
            'subcategories' => $subcategories,
            'subcategory_attributes' => $subcategoryAttributes
        ]);
    }


    public function promote($id)
    {
        $listing = SaleNews::with(['vipPackage', 'firstImage'])->findOrFail($id);
        $vipPackages = VipPackage::all();
        // dd($listing);
        return view('salenews.promote', compact('listing', 'vipPackages'));
    }

    public function upgrade(Request $request, $id)
    {
        $listing = SaleNews::findOrFail($id);
        $vipPackage = VipPackage::findOrFail($request->vip_package_id);

        $listing->vip_package_id = $vipPackage->id;
        $listing->vip_start_date = Carbon::now();
        $listing->vip_end_date = Carbon::now()->addDays($vipPackage->duration_days);
        $listing->save();

        return redirect()->route('listings.index')->with('success', 'Listing promoted successfully.');
    }

    public function renderSaleNewDetail(string $id){
        // dd($get_data_7subcategory);
        try {
            $news = SaleNews::with(['channel','images','firstImage', 'category','subcategory'])->where('sale_new_id', $id)->first();


            if($news->channel){
            $data_count_news = DB::table('sale_news')->where('channel_id',$news->channel_id)->where('approved',1)->where('status',1)->count();
            $data_count_news_sold = DB::table('sale_news')->where('channel_id',$news->channel_id)->where('approved',1)->where('status',0)->count();
            }



            $get_user_phone= DB::table('users')->where('user_id',$news->user_id)->first();
            $get_data_7subcategory = SaleNews::with(['channel','images','firstImage','subcategory'])
            ->where('sub_category_id', $news->sub_category_id)
            ->whereNotNull('vip_package_id')
            ->latest()
            ->take(7)
            ->get();
            // dd($news);



            if($news){
                if($news->channel){
            // $data = $news->data;
            // $data_json = json_decode($data);
            // $variants = json_decode($data_json->variants);
            // $variant_data_details = json_decode($data_json->variant_data_details);
            return view('salenews.detail', [
                'new' =>$news,
                'get_user' =>$get_user_phone,
                'data_count_news'=>$data_count_news,
                'data_count_news_sold'=>$data_count_news_sold,
                // 'variants' =>$variants,
                // 'variant_data_details' =>$variant_data_details,
                'get_data_7subcategory'=>$get_data_7subcategory
            ]);

        }

        return view('salenews.detail', [
            'new' =>$news,
            'get_user' =>$get_user_phone,
            // 'variants' =>$variants,
            // 'variant_data_details' =>$variant_data_details,
            'get_data_7subcategory'=>$get_data_7subcategory
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



}
