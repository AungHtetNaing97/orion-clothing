<?php

namespace App\Http\Controllers\Website;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function searchProducts(Request $request)
    {
        if ($request->search) {
            $search = $request->search;
            return view('frontend.search.index', compact('search'));
        } else {
            return redirect()->back()->with('info', 'Empty Search!');
        }
    }
}
