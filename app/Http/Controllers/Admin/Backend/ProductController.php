<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Subcategory;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brandIds = Brand::where('status', 0)->pluck('id');
        $categoryIds = Category::where('status', 0)->pluck('id');
        $subcategoryIds = Subcategory::where('status', 0)->pluck('id');

        $products = Product::whereIn('brand_id', $brandIds)
            ->whereIn('category_id', $categoryIds)
            ->whereIn('subcategory_id', $subcategoryIds)
            ->orderBy('updated_at', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.backend.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $subcategories = Subcategory::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $brands = Brand::where('status', 0)->orderBy('created_at', 'DESC')->get();

        // Get the previously selected category ID (if available)
        $selectedCategoryID = old('category_id');

        // Get the previously selected subcategory ID (if available)
        $selectedSubcategoryID = old('subcategory_id');

        // Group subcategories by category
        $subcategoriesByCategory = $subcategories->groupBy('category_id');

        return view('admin.backend.products.create', compact('categories', 'subcategories', 'brands', 'selectedCategoryID', 'selectedSubcategoryID', 'subcategoriesByCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => [
                'required', 'string',
                Rule::unique('products')->where(function ($query) use ($request) {
                    return $query->where('name', $request->name)
                        ->where('brand_id', $request->brand_id)
                        ->where('category_id', $request->category_id)
                        ->where('subcategory_id', $request->subcategory_id);
                }),
            ],
            'slug' => [
                'required', 'string'
            ],
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'regular_price' => 'required|string',
            'sale_price' => 'nullable|string',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'code' => 'required|string',
            'status' => 'required|integer',
            'trending' => 'required|integer',
            'featured' => 'required|integer',

            'image.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            // 'image' => 'required' comment this for custom check
        ], [
            'category_id.required' => 'The category name is required.',
            'subcategory_id.required' => 'The subcategory name is required.',
            'brand_id.required' => 'The brand name is required.'
        ]);

        // Check if the product has any images
        if (!$request->hasFile('image')) {
            session()->flash('message', 'Please add at least one image.');
            return redirect()->back()->withInput();
        }

        // Create Product
        $product = Product::create([
            'category_id' => $validatedData['category_id'],
            'subcategory_id' => $validatedData['subcategory_id'],
            'brand_id' => $validatedData['brand_id'],

            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'short_description' => $validatedData['short_description'],
            'description' => $validatedData['description'],
            'regular_price' => $validatedData['regular_price'],
            'sale_price' => $validatedData['sale_price'],
            'code' => $validatedData['code'],
            'status' => $validatedData['status'],
            'trending' => $validatedData['trending'],
            'featured' => $validatedData['featured']
        ]);

        // Create ProductImages with ProductId
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $image_path = $image->store('public/admin/backend/products');
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $image_path
                ]);
            }
        }

        return redirect('ecommerce/admin/products')->with('message', 'Product is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.backend.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $subcategories = Subcategory::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $brands = Brand::where('status', 0)->orderBy('created_at', 'DESC')->get();

        // Get the previously selected category ID (if available)
        $selectedCategoryID = old('category_id', $product->category_id);

        // Get the previously selected subcategory ID (if available)
        $selectedSubcategoryID = old('subcategory_id', $product->subcategory_id);

        // Group subcategories by category
        $subcategoriesByCategory = $subcategories->groupBy('category_id');

        return view('admin.backend.products.edit', compact('product', 'categories', 'subcategories', 'brands', 'selectedCategoryID', 'selectedSubcategoryID', 'subcategoriesByCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => [
                'required', 'string',
                Rule::unique('products')->where(function ($query) use ($request, $product) {
                    return $query->where('name', $request->name)
                        ->where('brand_id', $request->brand_id)
                        ->where('category_id', $request->category_id)
                        ->where('subcategory_id', $request->subcategory_id)
                        ->where('id', '!=', $product->id);
                }),
            ],
            'slug' => [
                'required', 'string'
            ],
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'regular_price' => 'required|string',
            'sale_price' => 'nullable|string',
            'category_id' => 'required|integer',
            'subcategory_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'code' => 'required|string',
            'status' => 'required|integer',
            'trending' => 'required|integer',
            'featured' => 'required|integer',

            'image.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            // 'image' => 'required'
        ], [
            'category_id.required' => 'The category name is required.',
            'subcategory_id.required' => 'The subcategory name is required.',
            'brand_id.required' => 'The brand name is required.'
        ]);

        // Update Product
        $product->update([
            'category_id' => $validatedData['category_id'],
            'subcategory_id' => $validatedData['subcategory_id'],
            'brand_id' => $validatedData['brand_id'],

            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'short_description' => $validatedData['short_description'],
            'description' => $validatedData['description'],
            'regular_price' => $validatedData['regular_price'],
            'sale_price' => $validatedData['sale_price'],
            'code' => $validatedData['code'],
            'status' => $validatedData['status'],
            'trending' => $validatedData['trending'],
            'featured' => $validatedData['featured']
        ]);

        // Create ProductImages with ProductId
        if ($request->hasFile('image')) {
            foreach ($request->file('image') as $image) {
                $image_path = $image->store('public/admin/backend/products');
                $product->productImages()->create([
                    'product_id' => $product->id,
                    'image' => $image_path
                ]);
            }
        }

        return redirect('ecommerce/admin/products')->with('message', 'Product is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->productImages) {
            foreach ($product->productImages as $productImage) {
                if ($productImage->image) {
                    Storage::delete($productImage->image);
                }
            }
        }
        $product->delete();
        return response()->json(['message' => 'Product and its images are deleted successfully!']);
    }

    public function destroyImage($productImage_id)
    {
        $productImage = ProductImage::findOrFail($productImage_id);
        if ($productImage->image) {
            Storage::delete($productImage->image);
        }
        $productImage->delete();
        return redirect()->back()->with('message', 'Product image is deleted successfully!');
    }
}
