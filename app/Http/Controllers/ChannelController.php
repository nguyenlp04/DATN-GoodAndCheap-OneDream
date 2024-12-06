<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Channel;
use App\Models\ChannelInfo;
use App\Models\Sale_news;
use App\Models\SaleNews;
use App\Models\Subcategory;
use App\Models\UserFollowed;
use App\Models\VipPackage;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Like;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list_channel()
    {
        $channels = Channel::all(); // Lấy danh sách kênh với phân trang
        return view('admin.channels.list_channel', compact('channels'));
    }
    public function index()
    {

        $user = Auth::user();
        $channels = Channel::where('user_id', $user->user_id)->firstOrFail(); // Lấy kênh của người dùng
        // dd($channels);
        if (!$channels || is_null($channels->status)) {
            return redirect()->route('channels.create') // Chuyển hướng đến trang tạo kênh
                ->with('error', 'You have not created a channel yet or the channel status is not set.');
        }
        $sale_news = $channels->saleNews()->with('sub_category', 'firstImage')
            ->where('approved', 1)
            ->paginate(5);

        foreach ($sale_news as $news) {
            $news->name_sub_category = $news->sub_category ? $news->sub_category->name_sub_category : null;
        }

        // Count records of sub_category based on name
        $subcategory_count = $sale_news->filter(function ($news) {
            return $news->sub_category !== null;
        })->countBy('name_sub_category');

        // Count the number of news items that the channel has posted
        $NewsCount = $channels->saleNews()->count();
        $category = Category::all();

        $isFollowed = UserFollowed::where('user_id', $user->user_id)
            ->where('channel_id', $channels->channel_id)
            ->exists();
        return view('partner.channels.show_channels', compact('channels', 'NewsCount', 'sale_news', 'subcategory_count', 'isFollowed', 'category'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();


        // Kiểm tra nếu người dùng đã tạo kênh
        $channelExists = Channel::where('user_id', $user->user_id)->whereNotNull('status')->exists();
        if ($channelExists) {
            return redirect()->route('channels.show', ['channel' => $user->channel->channel_id])
                ->with('success', 'You already have a channel.');
        }

        $vipPackages = VipPackage::where('type', 'channel')->get();
        $paymentOrCreat = Channel::where('user_id', $user->user_id)->first();

        return view('partner.channels.create_channels', compact('vipPackages', 'paymentOrCreat')); // Truyền gói VIP vào view
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Kiểm tra xem người dùng đã có kênh chưa
        $user = Auth::user();

        $existingChannel = Channel::where('user_id', $user->user_id)->first();
        if ($existingChannel) {
            return redirect()->route('channels.index')->with('success', 'You have already created a channel.');
        }

        // Validate form inputs
        $request->validate([
            'name_channel' => 'required|string|max:255|unique:channels,name_channel',
            'phone_number' => 'required|string|max:15|unique:channels,phone_number|regex:/^(\+?\d{1,4}[\s\-])?(\(?\d{1,3}\)?[\s\-]?)?[\d\s\-]{5,15}$/',
            'address' => 'required|string|max:255|unique:channels,address',
            'image_channel' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'vip_package_id' => 'nullable|exists:vip_packages,vip_package_id', // Kiểm tra ID gói VIP hợp lệ
            'status' => 'nullable|integer'
        ]);

        $channel = new Channel();
        $channel->user_id = $user->user_id;
        $channel->name_channel = $request->name_channel;
        $channel->phone_number = $request->phone_number;
        $channel->address = $request->address;
        $channel->status = NULL;
        $channel->vip_package_id = $request->vip_package_id; // Lưu gói VIP nếu có

        // Xử lý ảnh kênh
        if ($request->hasFile('image_channel')) {
            $path = $request->file('image_channel')->store('channels', 'public'); // Thêm tiền tố '/storage/' vào đường dẫn
            $channel->image_channel = 'storage/' . $path;
        }

        $channel->save();
        // return view('redirect_to_payment', [
        //     'channel_id' => $channel->channel_id,
        //     'vip_package_id' => $request->vip_package_id,
        //     'user_id' => $user->user_id,
        // ]);

        // dd($channel->channel_id, $request->vip_package_id, $user->user_id);
        return redirect()->route('redirect_to_payment', [
            'channel_id' => $channel->channel_id,
            'vip_package_id' => $request->vip_package_id,
            'user_id' => $user->user_id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = Auth::user(); // Lấy thông tin người dùng nếu đã đăng nhập
        $channel = Channel::where('user_id', $user->user_id ?? null)->first(); // Lấy kênh nếu người dùng đã đăng nhập

        // Lấy thông tin của kênh đang được xem
        $information = ChannelInfo::where('channel_id', $id)->first();
        $channels = Channel::findOrFail($id); // Lấy kênh theo ID

        // Lấy danh sách tin đã được duyệt thuộc kênh

        $sale_news = $channels->saleNews()->with('sub_category', 'firstImage')
            ->where('approved', 1)
            ->paginate(5);

        foreach ($sale_news as $news) {
            $news->name_sub_category = $news->sub_category ? $news->sub_category->name_sub_category : null;

            // Check if the sale_new is favorited
            $news->isFavorited = Like::where('sale_new_id', $news->sale_new_id)
                ->where('user_id', $user->user_id)
                ->exists();
        }


        // Đếm số lượng bản ghi theo sub_category
        $subcategory_count = $sale_news->filter(function ($news) {
            return $news->sub_category !== null;
        })->countBy('name_sub_category');
        // Đếm số lượng tin mà kênh đã đăng
        $NewsCount = $channels->saleNews()->count();
        $category = Category::all();
        // Kiểm tra nếu người dùng đã theo dõi kênh (nếu đã đăng nhập)
        $isFollowed = false;
        if ($user) {
            $isFollowed = UserFollowed::where('user_id', $user->user_id)
                ->where('channel_id', $channels->channel_id)
                ->exists();
        }

        // Trả về view
        return view('partner.channels.show_channels', compact(
            'channels',
            'NewsCount',
            'sale_news',
            'subcategory_count',
            'isFollowed',
            'information',
            'category'
        ));
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $channels = Channel::findOrFail($id); // Lấy kênh theo ID
        $vipPackages = VipPackage::all(); // Lấy tất cả các gói VIP
        return view('admin.channels.edit_channel', compact('channels', 'vipPackages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate form inputs
        $request->validate([
            'name_channel' => 'required|string|max:255|unique:channels,name_channel,' . $id . ',channel_id',
            'phone_number' => 'required|string|max:15|unique:channels,phone_number,' . $id . ',channel_id|regex:/^(\+?\d{1,4}[\s\-])?(\(?\d{1,3}\)?[\s\-]?)?[\d\s\-]{5,15}$/',
            'address' => 'required|string|max:255|unique:channels,address,' . $id . ',channel_id',
            'image_channel' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'vip_package_id' => 'nullable|', // Kiểm tra ID gói VIP hợp lệ
            'status' => 'nullable|integer'
        ]);

        // Cập nhật kênh
        $channel = Channel::findOrFail($id);
        $channel->name_channel = $request->name_channel;
        $channel->phone_number = $request->phone_number;
        $channel->address = $request->address;
        $channel->status = $request->status;
        $channel->vip_package_id = $request->vip_package_id; // Cập nhật gói VIP

        // Xử lý ảnh (nếu có)
        if ($request->hasFile('image_channel')) {
            if ($channel->image_channel) {
                Storage::delete('public/' . $channel->image_channel); // Xóa ảnh cũ nếu có
            }
            $channel->image_channel = $request->file('image_channel')->store('channels', 'public');
        }

        $channel->save();
        return redirect()->route('channels.show', ['channel' => $channel->channel_id])->with('alert', [
            'type' => 'success',
            'message' => 'Channel updated successfully.',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $channel = Channel::findOrFail($id);

        // Xóa ảnh nếu có
        if ($channel->image_channel) {
            Storage::delete('public/' . $channel->image_channel);
        }

        $channel->delete(); // Xóa kênh
        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Channel deleted successfully.',
        ]);
    }
    public function toggleStatus($id)
    {
        try {
            $channel = Channel::findOrFail($id);


            $channel->status = $channel->status == 1 ? 0 : 1;
            $channel->save();


            return response()->json([
                'status' => $channel->status,
                'alert' => $channel->status == 1 ? 'Active' : 'Inactive',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'alert' => 'Error: ' . $e->getMessage(),
            ]);
        }
    }


    public function followChannel($channel_id)
    {
        $user = Auth::user(); // Lấy người dùng đang đăng nhập
        $channel = Channel::find($channel_id); // Tìm kênh theo ID

        if (!$channel) {
            return response()->json(['message' => 'Channel does not exist.'], 404);
        }

        // Kiểm tra nếu người dùng đã theo dõi kênh này rồi
        $existingFollow = UserFollowed::where('user_id', $user->user_id)
            ->where('channel_id', $channel->channel_id)
            ->first();
        if ($existingFollow) {
            return response()->json(['message' => 'You are already following this channel.'], 400);
        }

        // Tạo bản ghi mới trong bảng user_followed
        $userFollowed = new UserFollowed();
        $userFollowed->user_id = $user->user_id;
        $userFollowed->channel_id = $channel->channel_id;
        $userFollowed->save();

        // Lưu thông báo vào session
        session()->flash('alert', [
            'type' => 'success',
            'message' => 'You have successfully followed the channel.'
        ]);

        return redirect()->back();  // Quay lại trang trước
    }


    public function unfollowChannel($channel_id)
    {
        $user = Auth::user();
        $channel = Channel::find($channel_id);

        if (!$channel) {
            return response()->json(['message' => 'Channel does not exist.'], 404);
        }

        $existingFollow = UserFollowed::where('user_id', $user->user_id)
            ->where('channel_id', $channel->channel_id)
            ->first();
        if ($existingFollow) {
            $existingFollow->delete();

            session()->flash('alert', [
                'type' => 'success',
                'message' => 'You have unfollowed the channel.'
            ]);

            return redirect()->back();
        }
        session()->flash('alert', [
            'type' => 'error',
            'message' => 'You have not followed this channel yet.'
        ]);
        return redirect()->back();
    }
    public function search_channel(Request $request)
    {
        $user = Auth::user();

        $channels = Channel::where('user_id', $user->user_id)->firstOrFail(); // Lấy channel của user

        $keyword = $request->input('keyword', '');
        $categoryId = $request->input('category');
        $perPage = $request->input('perPage', 2); // Mặc định 2 trang
        $threeDaysAgo = Carbon::now()->subDays(3);
        $NewsCount = $channels->saleNews()->count();
        $buildQuery = function ($isVip, $isRecent = null) use ($keyword, $categoryId, $threeDaysAgo) {
            $query = SaleNews::where('title', 'like', "%$keyword%")
                ->with('categoryToSubcategory', 'user', 'sub_category.category');

            $query->when($isVip, fn($q) => $q->whereNotNull('vip_package_id'));
            $query->when(!$isVip, fn($q) => $q->whereNull('vip_package_id'));

            if (!is_null($isRecent)) {
                $query->whereHas('user', function ($q) use ($threeDaysAgo, $isRecent) {
                    $isRecent
                        ? $q->where('created_at', '>=', $threeDaysAgo)
                        : $q->where('created_at', '<', $threeDaysAgo);
                });
            }

            $query->when($categoryId, fn($q) => $q->whereHas('sub_category.category', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            }));

            return $query;
        };

        $recentVipSaleNews = $buildQuery(true, true)->inRandomOrder()->limit(10)->get();
        $olderVipSaleNews = $buildQuery(true, false)->inRandomOrder()->limit(10)->get();
        $nonVipSaleNews = $buildQuery(false)->paginate($perPage);

        $category = Category::all();
        $sale_news = SaleNews::where('channel_id', $channels->channel_id)
            ->where('title', 'like', "%$keyword%")
            ->when($categoryId, fn($q) => $q->whereHas('sub_category.category', function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            }))
            ->with('categoryToSubcategory', 'user', 'sub_category.category')
            ->get();

        if ($sale_news->isEmpty()) {
            $sale_news = collect();
        }

        // Trả về view hoặc xử lý AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('partner.channels._sale_news', compact('sale_news'))->render()
            ]);
        }

        return view('partner.channels.show_channels', compact(
            'recentVipSaleNews',
            'olderVipSaleNews',
            'nonVipSaleNews',
            'keyword',
            'perPage',
            'category',
            'categoryId',
            'channels',
            'sale_news',
            'NewsCount'
        ));
    }
}
