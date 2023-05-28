<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index() {
        $allproducts = Product::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $categories = Category::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $subcategories = Subcategory::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $nproducts = Product::where('status', 0)->orderBy('created_at', 'DESC')->take(3)->get();

        return view('frontend.shop.index', compact('allproducts', 'categories', 'subcategories', 'nproducts'));
    }
}
