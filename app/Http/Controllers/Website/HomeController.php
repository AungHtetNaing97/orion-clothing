<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class HomeController extends Controller
{
    public function index() {
        $sliders = Slider::where('status', 0)->orderBy('created_at', 'DESC')->get();

        $fproducts = Product::where('status', 0)->where('featured', 1)->orderBy('created_at', 'DESC')->take(8)->get();
        $tproducts = Product::where('status', 0)->where('trending', 1)->orderBy('created_at', 'DESC')->take(8)->get();
        $nproducts = Product::where('status', 0)->orderBy('created_at', 'DESC')->take(8)->get();

        $subcategories = Subcategory::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $brands = Brand::where('status', 0)->orderBy('created_at', 'DESC')->get();
        return view('frontend.home.index', compact('sliders', 'fproducts', 'tproducts', 'nproducts', 'subcategories', 'brands'));
    }

    public function thankyou() {
        return view('frontend.thank-you');
    }
}
