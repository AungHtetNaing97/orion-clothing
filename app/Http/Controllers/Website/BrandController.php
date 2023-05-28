<?php

namespace App\Http\Controllers\Website;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index() {
        $brands = Brand::where('status', 0)->orderBy('created_at', 'DESC')->paginate(6);
        return view('frontend.brands.index', compact('brands'));
    }

    public function brand($brand_slug) {
        $brand = Brand::where('status', 0)->where('slug', $brand_slug)->first();
        return view('frontend.brands.brand', compact('brand'));
    }
}
