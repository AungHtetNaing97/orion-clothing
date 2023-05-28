<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/admin/backend/categories');
            $validatedData['image'] = $image_path;
        }
        Category::create($validatedData);
        return redirect('ecommerce/admin/categories')->with('message', 'Category is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.backend.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:categories,name,' . $category->id,
            'slug' => 'required|string|unique:categories,slug,' . $category->id,
            'description' => ['nullable', 'string'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|integer',
            'is_popular' => 'required|integer',
        ]);

        if($category->image) {
            $image_path = $category->image;
        }

        if($request->hasFile('image')) {
            if($category->image) {
                Storage::delete($category->image);
            }
            $image_path = $request->file('image')->store('public/admin/backend/categories');
            $validatedData['image'] = $image_path;
        }

        $category->update($validatedData);
        return redirect('ecommerce/admin/categories')->with('message', 'Category is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($category->image) {
            Storage::delete($category->image);
        }

        // Products of category
        $products = $category->products;
        foreach ($products as $product) {
            // Delete product images
            foreach ($product->productImages as $productImage) {
                if ($productImage->image) {
                    Storage::delete($productImage->image);
                }
            }

            // Delete product
            // $product->delete(); migration table has onDelete('cascade')
        }

        // Subcategories of category
        $subcategories = $category->subcategories;
        foreach($subcategories as $subcategory) {
            if($subcategory->image) {
                Storage::delete($subcategory->image);
            }
        }
        //$subcategory->delete(); migration table has onDelete('cascade')

        $category->delete();
        return response()->json(['message' => 'Category and, its related subcategories, products and variants are deleted successfully!']);
    }
}
