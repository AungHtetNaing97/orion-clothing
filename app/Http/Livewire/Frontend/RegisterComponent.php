<?php

namespace App\Http\Livewire\Frontend;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterComponent extends Component
{
    public $name;
    public $email;
    public $password;
    public $password_confirmation;

    public function register()
    {
        $validatedData = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Create User
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role_as' => 0 // User role = 0
        ]);

        // Login
        Auth::login($user);

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.frontend.register-component');
    }
}
