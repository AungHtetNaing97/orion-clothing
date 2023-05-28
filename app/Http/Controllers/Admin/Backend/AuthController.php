<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Register Page
    public function adminRegisterPage() {
        return view('admin.backend.register');
    }

    // Register Form
    public function adminRegister(Request $request) {
        $adminRegister = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $adminRegister['password'] = bcrypt($adminRegister['password']);

        // Create Admin
        $admin = User::create([
            'name' => $adminRegister['name'],
            'email' => $adminRegister['email'],
            'password' => $adminRegister['password'],
            'role_as' => 1 //admin = 1
        ]);

        // Login
        auth()->login($admin);

        return redirect('/ecommerce/admin/login')
                ->with('message', 'Admin account is created and please login to access the admin panel.');
    }

    // Login Page
    public function adminLoginPage() {
        return view('admin.backend.login');
    }

    // Login Form
    public function adminLogin(Request $request) {
        $adminLogin = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // user table mhr shi tae user phit lr
        if(auth()->attempt($adminLogin)) {
            // user table mhr pr pee admin yw phit lr
            if(auth()->user()->role_as == '1') {
                $request->session()->regenerate();
                return redirect('/ecommerce/admin/dashboard')->with('message', 'Welcome to Dashboard!');
            } else {
                return redirect('/ecommerce/admin/login')->with('noAccess', "You don't have admin access!");
            }
        } else {
            return redirect()->back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
        }
    }

    // Logout Form
    public function adminLogout() {
        auth()->logout();
        return redirect('/ecommerce/admin/login')->with('message', 'You have been logged out!');
    }
}
