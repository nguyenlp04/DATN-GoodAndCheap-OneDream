<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Sale_news;
use App\Models\Category;

class Sale_newController extends Controller
{
    public function list_salenew()
    {
        // Lấy tất cả các tin bán hàng với các quan hệ (user, sub_category.category)
        $data = Sale_news::with('user', 'sub_category.category')->get();
        
        // Sử dụng withCount để đếm số lượng tin có trạng thái = 0
        $count = Sale_news::where('status', 0)->count();

        return view('admin.sale_new.sale_new_list', compact('data', 'count'));
    }

    public function reject($id)
    {
        try{
            $item = Sale_news::findOrFail($id);
        
            // Thay đổi trạng thái giữa 0 và 2
            $item->status = $item->status == 2 ? 0 : 2;
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
        try{
         $item = Sale_news::findOrFail($id);

            // Thay đổi trạng thái giữa 0 và 1
         $item->status = $item->status == 1 ? 0 : 1;
         $item->save();
         
         return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => ' Approve successfully!'
        ]);
    }
        catch (\Throwable $th) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error: ' . $th->getMessage()
            ]);
        }
    
    }

    public function destroy($id)
    {
        try {
            $item = Sale_news::find($id);

            if ($item) {
                $item->delete(); // Xóa bản ghi khỏi cơ sở dữ liệu
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Sale news deleted successfully!'
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
