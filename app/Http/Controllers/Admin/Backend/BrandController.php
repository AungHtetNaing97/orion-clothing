<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandFormRequest $request)
    {
        $validatedData = $request->validated();

        if($request->hasFile('image')) {
            $image_path = $request->file('image')->store('public/admin/backend/brands');
            $validatedData['image'] = $image_path;
        }

        Brand::create($validatedData);
        return redirect('ecommerce/admin/brands')->with('message', 'Brand is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        return view('admin.backend.brands.show', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.backend.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|unique:brands,name,' . $brand->id,
            'slug' => 'required|string|unique:brands,slug,' . $brand->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'status' => 'required|integer'
        ]);

        if($brand->image) {
            $image_path = $brand->image;
        }

        if($request->hasFile('image')) {
            if($brand->image) {
                Storage::delete($brand->image);
            }
            $image_path = $request->file('image')->store('public/admin/backend/brands');
            $validatedData['image'] = $image_path;
        }

        $brand->update($validatedData);
        return redirect('ecommerce/admin/brands')->with('message', 'Brand is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if($brand->image) {
            Storage::delete($brand->image);
        }

        // Products of brand
        $products = $brand->products;
        foreach ($products as $product) {
            // Delete product images
            foreach ($product->productImages as $productImage) {
                if ($productImage->image) {
                    Storage::delete($productImage->image);
                }
            }

            // Delete product
            // $product->delete(); migration table has cascade
        }

        $brand->delete();
        return response()->json(['message' => 'Brand and, its related products and variants are deleted successfully!']);
    }
}
