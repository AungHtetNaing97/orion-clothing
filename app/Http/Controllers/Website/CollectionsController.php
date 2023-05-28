<?php

namespace App\Http\Controllers\Website;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CollectionsController extends Controller
{
    public function index() {
        $categories = Category::where('status', 0)->orderBy('created_at', 'DESC')->paginate(6);
        return view('frontend.collections.index', compact('categories'));
    }

    public function category($category_slug) {
        $category = Category::where('status', 0)->where('slug', $category_slug)->first();
        $subcategories = Subcategory::where('status', 0)
                            ->where('category_id', $category->id)->orderBy('created_at', 'DESC')->paginate(6);

        return view('frontend.collections.category', compact('category', 'subcategories'));
    }

    public function subcategory($category_slug, $subcategory_slug) {
        $category = Category::where('status', 0)->where('slug', $category_slug)->first();
        $subcategory = Subcategory::where('status', 0)
                        ->where('slug', $subcategory_slug)
                        ->where('category_id', $category->id)
                        ->first();

        return view('frontend.collections.subcategory', compact('subcategory'));
    }
}
