<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = Category::select('categories.*')
            ->selectRaw('COUNT(DISTINCT sub_categories.sub_category_id) AS sub_category_count')
            ->selectRaw('COUNT(DISTINCT subcategory_attributes.subcategory_attribute_id) AS attribute_count')
            ->selectRaw('GROUP_CONCAT(DISTINCT sub_categories.name_sub_category ORDER BY sub_categories.name_sub_category) AS sub_category_names')
            ->selectRaw('GROUP_CONCAT(DISTINCT sub_categories.status ORDER BY sub_categories.name_sub_category) AS sub_category_statuses')
            ->selectRaw('GROUP_CONCAT(DISTINCT subcategory_attributes.attributes_name ORDER BY sub_categories.sub_category_id) AS attribute_names')
            ->selectRaw('staffs.full_name AS staff_full_name')
            ->leftJoin('sub_categories', 'categories.category_id', '=', 'sub_categories.category_id')
            ->leftJoin('subcategory_attributes', 'categories.category_id', '=', 'subcategory_attributes.category_id')
            ->leftJoin('staffs', 'categories.staff_id', '=', 'staffs.staff_id')
            ->where('categories.is_delete', '=', '0')
            ->groupBy('categories.category_id')
            ->get();
        return view('admin.categories.index', ['data' => $data]);
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

            if ($request->hasFile('image')) {
                $imageName = 'category_' . time() . '_' . uniqid() . '.' . $request->image->extension();
                $imagePath = 'storage/category/' . $imageName;
                Storage::disk('public')->putFileAs('category', $request->file('image'), $imageName);
            }

            $dataCategory = [
                'staff_id' => Auth::id(),
                'name_category' => $validatedData['name_category'],
                'description' => $validatedData['description'],
                // 'subcategories' => $validatedData['subcategories'],
                // 'variants' => $validatedData['variants'],
                'image_category' => $imagePath ? $imagePath : null,
                'status' => 1,
                'created_at' => now(),
            ];
            // $query=DB::table('categories')->insert($dataCategory);

            $categoryId = DB::table('categories')->insertGetId($dataCategory);

            if (!empty($validatedData['subcategories'])) {
                foreach ($validatedData['subcategories'] as $subcategory) {
                    $dataSubCategory = [
                        'category_id' => $categoryId,
                        'name_sub_category' => $subcategory,
                        'status' => 1,
                        'created_at' => now(),
                    ];

                    $querySubCategory = DB::table('sub_categories')->insert($dataSubCategory);
                }
            }


            if (!empty($validatedData['variants'])) {
                foreach ($validatedData['variants'] as $variant) {
                    $dataVariantCategory = [
                        'category_id' => $categoryId,
                        'attributes_name' => $variant,

                    ];

                    $queryVariantCategory = DB::table('subcategory_attributes')->insert($dataVariantCategory);
                }
            }

            if ($categoryId && $querySubCategory && $queryVariantCategory) {
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
    public function destroy(string $category_id)
    {
        // dd($category);
        try {
            $category = Category::find($category_id);
            if ($category) {
                $category->is_delete = '1';
                $category->save();
                return redirect()->back()->with('alert', [
                    'type' => 'success',
                    'message' => 'Category deleted successfully!'
                ]);
            }
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Category not found!'
            ]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => ' Error : ' . $th->getMessage()
            ]);
        }
    }
}
