<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Variant;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DetailsController extends Controller
{
    public function index($category_slug, $subcategory_slug, $product_slug) {
        $category = Category::where('status', 0)->where('slug', $category_slug)->first();

        $subcategory = Subcategory::where('status', 0)->where('slug', $subcategory_slug)
                                    ->where('category_id', $category->id)->first();

        $product = Product::where('status', 0)->where('slug', $product_slug)
                            ->where('category_id', $subcategory->category->id)
                            ->where('subcategory_id', $subcategory->id)
                            ->first();

        $variants = Variant::where('status', 0)->where('product_id', $product->id)->orderBy('created_at', 'DESC')->get();

        $rproducts = Product::where('status', 0)
                            ->where('category_id', $product->category_id)
                            ->where('subcategory_id', $product->subcategory_id)
                            ->where('id', '!=', $product->id)
                            ->inRandomOrder()->limit(4)->get();

        $subcategories = Subcategory::where('status', 0)->orderBy('created_at', 'DESC')->get();

        $nproducts = Product::where('status', 0)
                            ->where('category_id', $product->category->id)
                            ->where('subcategory_id', '!=', $product->subcategory->id)
                            ->orderBy('created_at', 'DESC')->take(3)->get();

        return view('frontend.details.index', compact('product', 'variants', 'rproducts', 'subcategories', 'nproducts'));
    }
}
