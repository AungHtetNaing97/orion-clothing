<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class LoginComponent extends Component
{
    public $email;
    public $password;

    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            return redirect('/');
            // if (auth()->user()->role_as == '0') {
            //     return redirect('/');
            // } else {
            //     Auth::logout();
            //     session()->flash('noAccess', "Your account is only for Admin!");
            //     return redirect('login');
            // }
        } else {
            session()->flash('loginError', 'Invalid Credentials');
            $this->reset('password'); // Reset the password field
            $this->addError('password', 'Invalid password'); // Add this line to display the error message
            return redirect()->back();
        }
    }

    public function render()
    {
        return view('livewire.frontend.login-component');
    }
}
