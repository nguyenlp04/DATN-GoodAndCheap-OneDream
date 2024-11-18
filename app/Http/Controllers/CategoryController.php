<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;



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
            ->groupBy(
                'categories.category_id',
                'categories.name_category',
                'categories.image_category',
                'categories.delete_at',
                'categories.staff_id',
                'categories.description',
                'categories.status',
                'categories.is_delete',
                'categories.created_at',
                'categories.updated_at',
                'staffs.full_name'
            )
            ->get();




        // dd($data);/
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
                'staff_id' => Auth::guard('staff')->user()->staff_id,
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
        $dataCategoryID = Category::with(['subcategories', 'subcategory_attributes',])->where('category_id', $id)->first();
        return view('admin.categories.update-category', [
            'dataCategoryID' => $dataCategoryID,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the category by ID
        $category = Category::findOrFail($id);

        // Validate incoming data
        $request->validate([
            'name_category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'subcategories' => 'array',
            'variants' => 'array',
        ]);

        // Update category name and description
        $category->name_category = $request->input('name_category');
        $category->description = $request->input('description');

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image_category) {
                Storage::delete($category->image_category);
            }

            // Store the new image
            $imagePath = $request->file('image')->store('category_images');
            $category->image_category = $imagePath;
        }

        // Save the category
        $query = $category->save();

        // Delete old subcategories and handle potential foreign key constraints
        try {
            $category->subcategories()->delete();
            $subcategories = $request->input('subcategories', []);
            foreach ($subcategories as $subcategoryName) {
                if (!empty($subcategoryName)) {
                    $category->subcategories()->create([
                        'name_sub_category' => $subcategoryName
                    ]);
                }
            }

            // Delete old variants and add new ones
            $category->subcategory_attributes()->delete();
            $variants = $request->input('variants', []);
            foreach ($variants as $variantName) {
                if (!empty($variantName)) {
                    $category->subcategory_attributes()->create([
                        'attributes_name' => $variantName
                    ]);
                }
            }
        } catch (\Exception $e) {
            // Handle any exceptions (e.g., foreign key violations)
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error updating category: ' . $e->getMessage()
            ]);
        }

        // Redirect back with success message
        if ($query) {
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Category updated successfully!'
            ]);
        } else {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Failed to update category!'
            ]);
        }
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
