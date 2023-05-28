<?php

namespace App\Http\Controllers\Admin\Backend;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Contact;
use App\Models\Size;
use App\Models\Slider;
use App\Models\Subcategory;
use App\Models\Variant;

class DashboardController extends Controller
{
    public function index () {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalSubcategories = Subcategory::count();
        $totalBrands = Brand::count();

        $totalVariants = Variant::count();
        $totalColors = Color::count();
        $totalSizes = Size::count();
        $totalSliders = Slider::count();

        $totalAllUsers = User::count();
        $totalUser = User::where('role_as', '0')->count();
        $totalAdmin = User::where('role_as', '1')->count();
        $totalContacts = Contact::count();

        $todayDate = Carbon::now()->format('d-m-Y');
        $thisMonth = Carbon::now()->format('m');
        $thisYear = Carbon::now()->format('Y');

        $totalOrder = Order::count();
        $todayOrder = Order::whereDate('created_at', $todayDate)->count();
        $thisMonthOrder = Order::whereMonth('created_at', $thisMonth)->count();
        $thisYearOrder = Order::whereYear('created_at', $thisYear)->count();

        return view('admin.backend.dashboard', compact('totalProducts', 'totalCategories', 'totalSubcategories',
        'totalBrands', 'totalVariants', 'totalColors', 'totalSizes', 'totalSliders', 'totalAllUsers', 'totalUser',
        'totalAdmin', 'totalContacts', 'todayDate', 'thisMonth', 'thisYear', 'totalOrder', 'todayOrder', 'thisMonthOrder',
        'thisYearOrder'))->with('message', 'Welcome to Dashboard');
    }
}
