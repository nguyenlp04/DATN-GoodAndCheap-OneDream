<?php

namespace App\Http\Controllers;

use App\Models\SaleNews;
use App\Models\VipPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Console\Migrations\StatusCommand;

class SaleNewController extends Controller
{
    //

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
