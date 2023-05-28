<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexRegister() {
        return view('frontend.auth.register.index');
    }

    public function indexLogin() {
        return view('frontend.auth.login.index');
    }

    public function logout() {
        Auth::logout();
        return redirect('/'); // Redirect the user to the desired page after logout
    }
}
