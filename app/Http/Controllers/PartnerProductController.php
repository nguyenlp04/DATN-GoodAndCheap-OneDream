<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Channel;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\SubcategoryAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PartnerProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->withErrors(['error' => 'You need to log in to access this page.']);
        }
        $user = Auth::user()->user_id;
        $check = DB::table('channels')->where('user_id', $user)->first(); // Kiểm tra kênh của người dùng
        if (!$check) {
            return redirect()->back()->withErrors(['error' => 'Channel not found for this user.']); // Xử lý khi không tìm thấy kênh
        }
        $channel_id = $check->channel_id; // Lấy channel_id của người dùng

        // Lấy thông tin sản phẩm theo channel_id, cùng các liên kết chi tiết khác
        $data = DB::table('products')
            ->leftJoin('photo_gallery', 'products.product_id', '=', 'photo_gallery.product_id')
            ->leftJoin('sub_categories', 'products.sub_category_id', '=', 'sub_categories.sub_category_id')
            ->leftJoin('categories', 'sub_categories.category_id', '=', 'categories.category_id')
            ->leftJoin('staffs', 'products.staff_id', '=', 'staffs.staff_id')
            ->select(
                'products.*',
                DB::raw('MIN(photo_gallery.image_name) as image_name'),
                'categories.name_category as category_name',
                'sub_categories.name_sub_category as sub_category_name',
                'staffs.full_name as staff_full_name'
            )
            ->where('products.channel_id', '=', $channel_id) // Lọc theo channel_id
            ->where('products.is_delete', '=', '0') // Chỉ lấy sản phẩm chưa xóa
            ->whereNotNull('products.staff_id') // Chỉ lấy sản phẩm có staff_id hợp lệ
            ->groupBy('products.product_id')
            ->get();

        return view('partner.products.list_products', ['data' => $data]);
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();

        return view('partner.products.create_products', compact('categories'));
    }
    public function getSubcategories($categoryId)
    {
        $subcategoryAttributes = SubcategoryAttribute::where('category_id', $categoryId)->get();
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json([
            'subcategories' => $subcategories,
            'subcategory_attributes' => $subcategoryAttributes
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {


            $validatedData = $request->validate([
                'images.*' => 'required|max:2048',
                'productTitle' => 'required|string',
                'quantity' => 'required|numeric|min:0',
                'price' => 'required|numeric|min:0',
                'weight' => 'required|numeric|min:0',
                'description' => 'required|string',
                'category_id' => 'required|integer',
                'subcategory_id' => 'integer',
                'status' => 'integer',
                'dataVariantDetail' => 'required',  // Đảm bảo là mảng
                'variant' => 'required',  // Đảm bảo là mảng
            ]);

            // dd($request->input('variant'), $request->input('dataVariantDetail'));
            // Tạo mảng con dataVariant với cấu trúc đúng
            $dataVariant = [
                'variants' => $validatedData['variant'],  // Lấy giá trị từ 'Variant' trong validatedData
                'variant_data_details' => $validatedData['dataVariantDetail']  // Lấy giá trị từ 'dataVariantDetail'
            ];

            // Tạo mảng $data với các thông tin khác
            $data = [
                'productTitle' => $validatedData['productTitle'],
                'price' => $validatedData['price'],
                'quantity' => $validatedData['quantity'],
                'weight' => $validatedData['weight'],
                'category_id' => $validatedData['category_id'],
                'subcategory_id' => $validatedData['subcategory_id'],
                'description' => $validatedData['description'],
                'dataVariant' => $dataVariant,  // Gán mảng con vào dataVariant
            ];



            // Encode the data array to JSON
            $jsonData = json_encode($data);

            $productData = [
                'staff_id' => Auth::id(),
                'sub_category_id' => $validatedData['subcategory_id'],
                'channel_id' => NULL,
                'name_product' => $validatedData['productTitle'],
                'price' => $validatedData['price'],
                'quantity' => $validatedData['quantity'],
                'weight' => $validatedData['weight'],
                'data' => $jsonData,
                'description' => $validatedData['description'],
                'status' => $validatedData['status'],
                'created_at' => now(),
            ];

            $insertProduct = DB::table('products')->insertGetId($productData);

            $imageRecords = [];
            foreach ($request->file('images') as $image) {
                $imageName = 'product_' . time() . '_' . uniqid() . '.' . $image->extension();
                $imagePath = 'storage/product/' . $imageName;
                Storage::disk('public')->putFileAs('product', $image, $imageName);
                $imageRecords[] = [
                    'product_id' => $insertProduct,
                    'image_name' => $imagePath,
                    'created_at' => now(),
                ];
            }
            if (!empty($imageRecords)) {
                DB::table('photo_gallery')->insert($imageRecords);
            }
            if ($insertProduct) {
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
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */

    public function edit(string $id)
    {
        $dataProductID = DB::table('products')->where('product_id', $id)->first();
        return view('partner.products.update_product', [
            'dataProductID' => $dataProductID,
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
}
