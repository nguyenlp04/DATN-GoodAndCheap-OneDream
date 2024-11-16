<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Sale_news;
use App\Models\Category;

class Sale_newController extends Controller
{
    public function list_salenew()
    {
        $data = Sale_news::with('user', 'sub_category.category')->get();
       $count=db::table('sale_news')->where('status',0)->get()->count();
     
        return view('admin.sale_new.sale_new_list', ['data' => $data,'count'=>$count]);
    }
    public function reject($id){
        $item=Sale_news::findOrFail($id);
        $item->status=$item->status==2?0:2;
        $item->save();
        return redirect()->back()->with('message', 'Success');
        
    }
    public function approve($id){
        $item=Sale_news::findOrFail($id);
        $item->status=$item->status==1?0:1;
        $item->save();
        return redirect()->back()->with('message', 'Success');
        
    }
    public function destroy($id)
    {
        try {
            $item = Sale_news::find($id);
            if ($item) {
                $item->delete(); // Xóa bản ghi khỏi cơ sở dữ liệu
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Seleted successfully!'
                ]);
            }
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Sale news not found!'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error: ' . $th->getMessage()
            ]);
        }
    }
}
