<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index() {
        if(Auth::user()->userDetail && Auth::user()->userDetail->phone && Auth::user()->userDetail->address && Auth::user()->userDetail->postal_code) {
            return view('frontend.checkout.index');
        } else {
            return redirect('profile')->with('info', 'Please fill user information first!');
        }
    }
}
