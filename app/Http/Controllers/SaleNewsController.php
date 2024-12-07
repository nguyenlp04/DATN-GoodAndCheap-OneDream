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
use App\Models\Channel;
use App\Models\Subcategory;
use App\Models\SubcategoryAttribute;
use App\Models\Transactions;

class SaleNewsController extends Controller




{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = SaleNews::with(['user', 'subcategory', 'firstImage', 'categoryToSubcategory'])->get();
        return view('admin.products.index', ['data' => $data]);
    }

    public function indexSaleNewsPartner()
    {

        $channelId = Channel::where('user_id', auth()->user()->user_id)->value('channel_id');

        $data = SaleNews::with(['user', 'sub_category', 'firstImage', 'categoryToSubcategory'])->where('channel_id', $channelId)->get();
        return view('partner.sale_news.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('salenews.add-sale-news', compact('categories'));
    }

    public function createSaleNewsPartner()
    {
        $categories = Category::all();

        $channels = Channel::where('user_id', auth()->user()->user_id)->first();

        // Trả về view và truyền các dữ liệu cần thiết
        return view('partner.sale_news.add', compact('categories', 'channels'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request['variant']);
        $validatedData = $request->validate([
            'productTitle' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'subcategory_id' => 'required|integer',
            'name_category' => 'required|integer',
            'variant' => 'required',
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            'hiddenAddress' => 'required',
            'addressDetail' => 'required',
            'images.*' => 'required|max:2048',

        ]);
        // dd($validatedData, auth()->user()->user_id);
        try {


            $jsonData = json_encode($validatedData['variant']);
            // dd($jsonData);

            $productData = [
                'user_id' => auth()->user()->user_id,
                'title' => $validatedData['productTitle'],
                'price' => $validatedData['price'],
                'description' => $validatedData['description'],
                'sub_category_id' => $validatedData['subcategory_id'],
                'data' => $jsonData,
                'phone' => $validatedData['phone'],
                'address' => $validatedData['hiddenAddress'],
                'approved' => 0,
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


    public function storeSaleNewsPartner(Request $request)
    {
        $address = !empty($request->hiddenAddress) ? $request->hiddenAddress : $request->hiddenAddressChannel;
        // dd($address);
        // dd($request['variant']);

        $validatedData = $request->validate([
            'productTitle' => 'required|string',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'variant' => 'required',
            'phone' => ['required', 'regex:/^\+?[0-9]{10,15}$/'],
            // 'hiddenAddress' => 'required',
            'images.*' => 'required|max:2048',
        ]);
        // dd($validatedData['variant']);

        // dd($errors->all());
        // dd($validatedData, auth()->user()->user_id);
        try {


            // Kiểm tra và giải mã JSON nếu cần
            $variant = $validatedData['variant'];
            if (is_string($variant)) {
                $variant = json_decode($variant, true); // Giải mã JSON thành mảng
            }

            // Kiểm tra nếu biến $variant không phải là mảng sau khi giải mã
            if (!is_array($variant)) {
                die('Dữ liệu không hợp lệ: variant không phải là mảng.');
            }

            // Chuyển đổi cấu trúc
            $formattedVariant = array_map(function ($item) {
                return [
                    'name' => $item['name'],
                    'option' => $item['options'][0] ?? null // Lấy giá trị đầu tiên trong 'options', nếu không có thì trả về null
                ];
            }, $variant);

            // Chuyển đổi thành JSON
            $jsonData = json_encode($formattedVariant, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

            // Hiển thị hoặc lưu lại JSON

            // dd($jsonData);


            // $jsonData = json_encode($validatedData['variant']);
            $channel = Channel::where('user_id', auth()->user()->user_id)->first(['vip_package_id', 'vip_start_at', 'vip_end_at']);
            // dd($jsonData);

            // dd($channel);

            $productData = [
                'user_id' => auth()->user()->user_id,
                'channel_id' => $request->idChannel,
                'title' => $validatedData['productTitle'],
                'price' => $validatedData['price'],
                'description' => $validatedData['description'],
                'sub_category_id' => $validatedData['subcategory_id'],
                'data' => $jsonData,
                'address' => $address,
                'phone' => $validatedData['phone'],
                'approved' => 1,
                'status' => 1,
                'vip_package_id' => $channel->vip_package_id,
                'vip_start_at' => $channel->vip_start_at,
                'vip_end_at' => $channel->vip_end_at,
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



    public function getAllSaleStatus()
    {
        $data = SaleNews::with('vipPackage', 'firstImage', 'sub_category')
            ->where('status', 1)->where('user_id', auth()->user()->user_id);

        $count_now_showing = $data->where('approved', 1)->count();
        $list_now_showing = $data->where('approved', 1)->get();

        $list_pending_approval = SaleNews::with('vipPackage', 'firstImage', 'sub_category')
            ->where('approved', 0)->where('user_id', auth()->user()->user_id)
            ->get();
        $count_pending_approval = SaleNews::with('vipPackage')
            ->where('approved', 0)->where('user_id', auth()->user()->user_id)->count();


        $count_not_accepted = SaleNews::with('vipPackage')
            ->where('approved', 2)->where('user_id', auth()->user()->user_id)
            ->count();
        $list_not_accepted = SaleNews::with('vipPackage', 'firstImage', 'sub_category')
            ->where('approved', 2)->where('user_id', auth()->user()->user_id)
            ->get();

        $count_hidden = SaleNews::with('vipPackage')
            ->where('status', 0)
            ->where('approved', 1)->where('user_id', auth()->user()->user_id)
            ->count();
        $list_hidden = SaleNews::with('vipPackage', 'firstImage', 'sub_category')
            ->where('status', 0)
            ->where('approved', 1)->where('user_id', auth()->user()->user_id)
            ->get();
        // dd($list_pending_approval);
        $transactionCount = Transactions::where('user_id', auth()->user()->user_id)->count();

        return view('salenews.index', compact('count_now_showing', 'list_now_showing', 'list_pending_approval', 'count_pending_approval', 'list_not_accepted', 'count_not_accepted', 'count_hidden', 'list_hidden', 'transactionCount'));
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
        $vipPackages = VipPackage::where('type', 'user')->get();
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

    public function getNextSaleNewId($currentId)
    {
        return SaleNews::where('sale_new_id', '>', $currentId)
            ->where('approved', 1)
            ->orderBy('sale_new_id')
            ->first();
    }

    public function getPreviousSaleNewId($currentId)
    {
        return SaleNews::where('sale_new_id', '<', $currentId)
            ->where('approved', 1)
            ->orderBy('sale_new_id', 'desc')
            ->first();
    }

    public function renderSaleNewDetail(string $id)
    {
        // dd($get_data_7subcategory);
        try {
            $update_views = DB::table('sale_news')->where('sale_new_id', $id)->increment('views', 1);

            $news = SaleNews::with(['channel', 'images', 'firstImage', 'category', 'sub_category'])
                ->where('sale_new_id', $id)
                ->where('approved', 1)->first();
            // dd($news);

            if (!is_null($news->channel_id)) {
                $data_count_news = DB::table('sale_news')->where('channel_id', $news->channel_id)->where('approved', 1)->where('status', 1)->count();
                $data_count_news_sold = DB::table('sale_news')->where('channel_id', $news->channel_id)->where('approved', 1)->where('status', 0)->count();
            }



            $get_user_phone = DB::table('users')->where('user_id', $news->user_id)->first();
            $get_data_7subcategory = SaleNews::with(['channel', 'images', 'firstImage', 'sub_category'])
                ->where('sub_category_id', $news->sub_category_id)
                ->whereNotNull('vip_package_id')
                ->latest()
                ->take(7)
                ->get();
            // dd($news);



            if ($news) {
                $data = $news->data;
                $data_json = json_decode($data);
                $nextNews = $this->getNextSaleNewId($id);
                $prevNews = $this->getPreviousSaleNewId($id);
                $nextNewsId = $nextNews ? $nextNews->sale_new_id : null;
                $prevNewsId = $prevNews ? $prevNews->sale_new_id : null;

                //  dd($data_json);
                if (!is_null($news->channel_id)) {
                    return view('salenews.detail', [
                        'new' => $news,
                        'get_user' => $get_user_phone,
                        'data_count_news' => $data_count_news,
                        'data_count_news_sold' => $data_count_news_sold,
                        'data_json' => $data_json,
                        // 'variant_data_details' =>$variant_data_details,
                        'get_data_7subcategory' => $get_data_7subcategory,
                        'nextNewsId' => $nextNewsId,
                        'prevNewsId' => $prevNewsId
                    ]);
                }

                return view('salenews.detail', [
                    'new' => $news,
                    'get_user' => $get_user_phone,
                    'data_json' => $data_json,
                    // 'variant_data_details' =>$variant_data_details,
                    'get_data_7subcategory' => $get_data_7subcategory,
                    'nextNewsId' => $nextNewsId,
                    'prevNewsId' => $prevNewsId
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

    public function list_salenew()
    {
        $data = SaleNews::with('user', 'sub_category.category', 'images')
            ->where('is_delete', NULL)
            ->get();


        // Sử dụng withCount để đếm số lượng tin có trạng thái = 0
        $count = SaleNews::where('approved', 0)->count();

        return view('admin.sale_new.sale_new_list', compact('data', 'count'));
    }

    public function reject($id)
    {
        try {
            $item = SaleNews::findOrFail($id);

            // Thay đổi trạng thái giữa 0 và 2
            $item->approved = $item->approved == 2 ? 0 : 2;
            $item->save();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => ' Reject  successfully!'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error: ' . $th->getMessage()
            ]);
        }
    }

    public function approve($id)
    {
        try {
            $item = SaleNews::findOrFail($id);

            // Thay đổi trạng thái giữa 0 và 1
            $item->approved = $item->approved == 1 ? 0 : 1;
            $item->save();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => ' Approve successfully!'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error: ' . $th->getMessage()
            ]);
        }
    }
    public function destroy($id)
    {
        try {
            $item = SaleNews::findOrFail($id);

            // Nếu is_delete là NULL, gán giá trị là 1
            if (is_null($item->is_delete)) {
                $item->is_delete = 1;
            }

            // Chuyển trạng thái approved thành 1
            $item->approved = 2;

            $item->save();

            // Thông báo
            $message = 'Delete successfully!';

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => $message
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Lỗi: ' . $th->getMessage()
            ]);
        }
    }



    public function navbar_sale()
    {
        $count = SaleNews::where('approved', 0)->get();

        return view('layouts.admin', compact('count'));
    }
    public function confirmedSale($id)
    {


        $sale = SaleNews::find($id);
        if ($sale) {
            // $sale->status = 'sold';
            // $sale->save();
            $confirmed = DB::table('sale_news')->where('sale_new_id', $id)->update(['status' => 0]);
        }

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Operation successful'
        ]);
    }
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $categoryId = $request->get('category'); // Get category filter
        $address = $request->get('address');    // Get address filter
        $subcategoryID = $request->get('subcategory');    // Get address filter
        // dd($subcategoryID);
        $threeDaysAgo = Carbon::now()->subDays(3);

        // Recent VIP SaleNews (users created within the last 3 days)
        $recentVipSaleNews = SaleNews::where('title', 'like', "%$keyword%")
            ->with('categoryToSubcategory', 'user', 'sub_category.category')
            ->whereNotNull('vip_package_id')
            ->where('status', 1)
            ->where('approved', 1)
            ->whereHas('user', function ($query) use ($threeDaysAgo) {
                $query->where('created_at', '>=', $threeDaysAgo);
            });
        if (!empty($subcategoryID)) {
            $recentVipSaleNews->where('sub_category_id', $subcategoryID);
        }
        if ($categoryId) {
            $recentVipSaleNews->whereHas('sub_category.category', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            });
        }

        if ($address) {
            $recentVipSaleNews->where('address', 'like', "%$address%");
        }
        $recentVipSaleNews = $recentVipSaleNews->inRandomOrder()->get();

        // Older VIP SaleNews (users created more than 3 days ago)
        $olderVipSaleNews = SaleNews::where('title', 'like', "%$keyword%")
            ->with('categoryToSubcategory', 'user', 'sub_category.category')
            ->whereNotNull('vip_package_id')
            ->where('status', 1)
            ->where('approved', 1)
            ->whereHas('user', function ($query) use ($threeDaysAgo) {
                $query->where('created_at', '<', $threeDaysAgo);
            });
        if (!empty($subcategoryID)) {
            $olderVipSaleNews->where('sub_category_id', $subcategoryID);
        }
        if ($categoryId) {
            $olderVipSaleNews->whereHas('sub_category.category', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            });
        }

        if ($address) {
            $olderVipSaleNews->where('address', 'like', "%$address%");
        }
        $olderVipSaleNews = $olderVipSaleNews->inRandomOrder()->get();
        // Non-VIP SaleNews with pagination
        $perPage = $request->get('perPage', 8);
        $nonVipSaleNews = SaleNews::where('title', 'like', "%$keyword%")
            ->with('sub_category.category')
            ->whereNull('vip_package_id')
            ->where('status', 1)
            ->where('approved', 1)
            ->where('sub_category_id', $subcategoryID);
        if (!empty($subcategoryID)) {
            $nonVipSaleNews->where('sub_category_id', $subcategoryID);
        }
        if ($categoryId) {
            $nonVipSaleNews->whereHas('sub_category.category', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            });
        }

        if ($address) {
            $nonVipSaleNews->where('address', 'like', "%$address%");
        }

        $nonVipSaleNews = $nonVipSaleNews->paginate($perPage);

        $totalNonVipSaleNews = $nonVipSaleNews->total();

        $category = Category::all();

        return view('salenews.search', compact(
            'recentVipSaleNews',
            'olderVipSaleNews',
            'nonVipSaleNews',
            'keyword',
            'perPage',
            'totalNonVipSaleNews',
            'category',
            'address',
            'categoryId'
        ));
    }
    public function all_sale_news()
    {
        $data = SaleNews::with(['user', 'sub_category.category', 'images'])
            ->where('status', 1)
            ->where('approved', 1)
            ->paginate(8);

        $groupedData = $data->groupBy(function ($item) {
            return $item->sub_category->category_id;
        });

        $allItems = $data;
        $groupedData['all'] = $allItems;

        return view('salenews.all-sale-news', compact('groupedData'));
    }
}
