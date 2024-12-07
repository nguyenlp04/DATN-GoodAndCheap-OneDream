<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Facades\File;



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
            // ->leftJoin('blogs', 'categories.category_id', '=', 'blogs.category_id')  // Sửa ở đây, thay `category_id` cho đúng
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


        $validatedData = $request->validate([
            'name_category' => 'required|string|max:255|unique:categories,name_category',
            'description' => 'nullable|string|max:1000',
            'subcategories' => 'required|array',
            'subcategories.*' => 'string|max:255',
            'variants' => 'required|array',
            'variants.*' => 'required|string|max:255',
            'image' => 'required|nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $imageName = 'category_' . time() . '_' . uniqid() . '.' . $request->image->extension();
            $imagePath = 'storage/category/' . $imageName;
            Storage::disk('public')->putFileAs('category', $request->file('image'), $imageName);
        }
        try {
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
        $dataCategoryID = Category::with(['subcategories', 'subcategory_attributes'])->where('category_id', $id)->first();
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
            'subcategories' => 'required|array', // Ensure this is an array of subcategory names
            'variants' => 'required|array', // Ensure this is an array of variant names
        ]);

        // Update category name and description
        $category->name_category = $request->input('name_category');
        $category->description = $request->input('description');

        // Handle image upload if provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($category->image_category) {
                Storage::delete($category->image_category);
            }

            // Store the new image
            $imageName = 'category_' . time() . '_' . uniqid() . '.' . $request->image->extension();
            Storage::disk('public')->putFileAs('category', $request->file('image'), $imageName);
            $imagePath = 'storage/category/' . $imageName;
            $category->image_category = $imagePath;
        }

        try {
            // Update or add new subcategories
            $subcategories = $request->input('subcategories', []);

            // Lấy danh sách subcategories hiện tại của category
            $existingSubcategories = $category->subcategories()->get()->keyBy('sub_category_id');

            // dd($subcategories, $existingSubcategories);
            $subCategoryIdsInRequest = collect($subcategories)->pluck('sub_category_id')->filter();
            $category->subcategories()->whereNotIn('sub_category_id', $subCategoryIdsInRequest)->delete();
            foreach ($subcategories as $subcategoryData) {
                // dd($subcategoryData['sub_category_id']);

                if (is_array($subcategoryData)) {
                    if (!empty($subcategoryData['sub_category_id']) && $existingSubcategories->has($subcategoryData['sub_category_id'])) {
                        $subcategory = $existingSubcategories[$subcategoryData['sub_category_id']];
                        $subcategory->update([
                            'name_sub_category' => $subcategoryData['name_sub_category']
                        ]);
                    } else {
                        $category->subcategories()->create([
                            'name_sub_category' => $subcategoryData['name_sub_category']
                        ]);
                    }
                } else {
                    $dataSubCategory = [
                        'category_id' => $id,
                        'name_sub_category' => $subcategoryData,
                        'created_at' => now(),
                    ];
                    $query = DB::table('sub_categories')->insert($dataSubCategory);
                }
            }



            $variants = $request->input('variants', []);
            // Get the existing variants for the category
            $existingVariants = $category->subcategoryAttributes()->get()->keyBy('subcategory_attribute_id');
            // dd($variants);

            $variantIdsInRequest = collect($variants)->pluck('subcategory_attribute_id')->filter();
            $category->subcategoryAttributes()->whereNotIn('subcategory_attribute_id', $variantIdsInRequest)->delete();
            foreach ($variants as $variantData) {
                // dd($variantData['subcategory_attribute_id']);
                if (is_array($variantData)) {
                    // Check if the variant already exists using 'subcategory_attribute_id'
                    if (!empty($variantData['subcategory_attribute_id']) && $existingVariants->has($variantData['subcategory_attribute_id'])) {
                        // Update the existing variant
                        $variant = $existingVariants[$variantData['subcategory_attribute_id']];
                        $variant->where('subcategory_attribute_id', $variantData['subcategory_attribute_id'])->update([
                            'attributes_name' => $variantData['attributes_name']
                        ]);
                    } else {
                        // Create a new variant if it doesn't exist
                        $category->subcategoryAttributes()->create([
                            'category_id' => $category->id,
                            'attributes_name' => $variantData['attributes_name']
                        ]);
                    }
                } else {
                    $dataAttributes = [
                        'category_id' => $id,
                        'attributes_name' => $variantData,
                        'created_at' => now(),
                    ];
                    $query = DB::table('subcategory_attributes')->insert($dataAttributes);
                }
            }



            // Save the category (image and other details are updated here)
            $category->save();

            // Redirect back with success message
            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Category updated successfully!'
            ]);
        } catch (\Exception $e) {
            // Handle any exceptions (e.g., foreign key violations)
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Error updating category: ' . $e->getMessage()
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

    // public function blogs()
    // {
    //     return $this->hasMany(Blog::class, 'category_id');
    // }
    public function trash()
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
            // ->leftJoin('blogs', 'categories.category_id', '=', 'blogs.category_id')  // Sửa ở đây, thay `category_id` cho đúng
            ->where('categories.is_delete', '=', '1')
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
        return view('admin.trash.category', compact('data'));
    }
    public function restore($id)
    {
        try {
            $item = Category::findOrFail($id);

            // Thay đổi trạng thái giữa 0 và 2
            $item->is_delete = '0';
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
    public function destroyofadmin(string $id)
    {
        // Tìm bản ghi Category
        $check = Category::findOrFail($id);

        // Kiểm tra và xóa các bản ghi liên quan trước
        if ($check) {

            foreach ($check->blogs as $blog) {
                $blog->delete();
            }
            foreach ($check->subcategoryAttributes as $subcategoryAttribute) {
                $subcategoryAttribute->delete();
            }


            foreach ($check->subcategories as $subcategory) {

                foreach ($subcategory->salenews as $saleNews) {

                    foreach ($saleNews->images as $photo) {
                        // Xác định đường dẫn tệp ảnh
                        $filePath = public_path($photo->image_name);

                        // Kiểm tra và xóa tệp ảnh nếu tồn tại
                        if (File::exists($filePath)) {
                            File::delete($filePath);
                        }
                        $photo->delete();
                    }
                    $saleNews->likes()->delete();


                    $saleNews->delete();
                }


                $subcategory->delete();
            }

            // Sau đó xóa bản ghi Category
            $check->delete();

            return redirect()->back()->with('alert', [
                'type' => 'success',
                'message' => 'Delete successful!'
            ]);
        } else {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Not found!'
            ]);
        }
    }
}