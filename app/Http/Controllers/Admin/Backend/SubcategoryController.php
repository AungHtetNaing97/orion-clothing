<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categoryIds = Category::where('status', 0)->pluck('id');

        $subcategories = Subcategory::whereIn('category_id', $categoryIds)
                            ->orderBy('updated_at', 'DESC')
                            ->orderBy('created_at', 'DESC')
                            ->get();
        return view('admin.backend.subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 0)->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.subcategories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subcategories')->where(function ($query) use ($request) {
                    return $query->where('category_id', $request->category_id);
                }),
            ],
            'slug' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => ['nullable', 'string'],
            'status' => 'required|integer',
            'is_popular' => 'required|integer',
        ]);

        if($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/admin/backend/subcategories');
            $validatedData['image'] = $image_path;
        }
        Subcategory::create($validatedData);
        return redirect('ecommerce/admin/subcategories')->with('message', 'Subcategory is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        return view('admin.backend.subcategories.show', compact('subcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::where('status', 0)->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.subcategories.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('subcategories')->where(function ($query) use ($request, $subcategory) {
                    return $query->where('category_id', $request->category_id)
                                 ->where('id', '<>', $subcategory->id);
                }),
            ],
            'slug' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => ['nullable', 'string'],
            'status' => 'required|integer',
            'is_popular' => 'required|integer',
        ]);

        if($subcategory->image) {
            $image_path = $subcategory->image;
        }

        if($request->hasFile('image')) {
            if($subcategory->image) {
                Storage::delete($subcategory->image);
            }
            $image_path = $request->file('image')->store('public/admin/backend/subcategories');
            $validatedData['image'] = $image_path;
        }

        $subcategory->update($validatedData);
        return redirect('ecommerce/admin/subcategories')->with('message', 'Subcategory is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        if($subcategory->image) {
            Storage::delete($subcategory->image);
        }

        // Products of subcategory
        $products = $subcategory->products;
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

        $subcategory->delete();
        return response()->json(['message' => 'Subcategory and, its related products and variants are deleted successfully!']);
    }

    public function getSubcategory($categoryId) {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }
}
