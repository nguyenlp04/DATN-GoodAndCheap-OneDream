<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; 



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.categories.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('admin.categories.add-category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.categories.add-category');
        }
        try {
            
            $validatedData = $request->validate([
                'name_category' => 'required|string|max:255',
                'description' => 'nullable|string|max:1000',
                'subcategories' => 'required|array',
                'subcategories.*' => 'string|max:255',
                'variants' => 'required|array',
                'variants.*' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
    

            // $fileName = time() . '.' . $request->image->extension(); 
            // $filePath = '/image/category/' . $fileName; 
            // Storage::disk('blackblaze')->put(basename($filePath), file_get_contents($fileName), 'private');

            if ($request->hasFile('image')) {
                $originalFileName = basename($request->file('image')->getClientOriginalName());
                $fileName = time() . '_' . $originalFileName;
                $filePath = '/image/category/' . $fileName; 
                Storage::disk('blackblaze')->put($filePath, file_get_contents($request->file('image')), 'private');
            }

            $dataCategory = [
                'staff_id' => Auth::id(),
                'name_category' => $validatedData['name_category'],
                'description' => $validatedData['description'],
                // 'subcategories' => $validatedData['subcategories'],
                // 'variants' => $validatedData['variants'],
                'image_category' => $filePath ? $filePath : null,
                'status'=> 1,
                'created_at' => now(),
            ];
            // $query=DB::table('categories')->insert($dataCategory);

            $categoryId = DB::table('categories')->insertGetId($dataCategory);

            if (!empty($validatedData['subcategories'])) {
                foreach ($validatedData['subcategories'] as $subcategory) {
                    $dataSubCategory = [
                        'category_id' => $categoryId, 
                        'name_sub_category' => $subcategory,
                        'status'=> 1,
                        'created_at' => now(),
                    ];
        
                    $querySubCategory = DB::table('sub_categories')->insert($dataSubCategory);
                }
            }


            if (!empty($validatedData['variants'])) {
                foreach ($validatedData['variants'] as $variant) {
                    $dataVariantCategory = [
                        'sub_category_id' => $categoryId,
                        'attributes_name' => $variant, 
                        
                    ];
        
                    $queryVariantCategory = DB::table('subcategory_attributes')->insert($dataVariantCategory);
                }
            }

            if($categoryId && $querySubCategory && $queryVariantCategory){
                return redirect()->back()->with('alert',[
                    'type'=>'success',
                    'message'=>'Added Successfully !'
            ]);
            }else{
                return redirect()->back()->with('alert',[
                    'type'=>'error',
                    'message'=>'Không thành công !'
            ]);
    
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Lỗi: ' . $e->getMessage()
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
