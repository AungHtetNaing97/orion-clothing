<?php

namespace App\Http\Controllers\Website;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index() {
        return view('frontend.profile.index');
    }

    public function updateUserDetails(Request $request) {
        $request->validate([
            'name' => ['required', 'string'],
            'phone' => ['required', 'string', 'regex:/^\+?\d{10,15}$/'],
            'postal_code' => ['required', 'integer', 'digits:6'],
            'address' => ['required', 'string', 'max:499']
        ]);
        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name
        ]);

        $user->userDetail()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'phone' => $request->phone,
                'postal_code' => $request->postal_code,
                'address' => $request->address
            ]
        );

        $redirect = $request->input('redirect');
        if ($redirect === 'profile') {
            return redirect()->back()->with('info', 'Profile Updated!');
        } elseif ($redirect === 'checkout') {
            return redirect('checkout')->with('info', 'You can proceed checkout now!');
        }
    }

    public function passwordCreate() {
        return view('frontend.profile.change-password');
    }

    public function changePassword(Request $request) {
        $request->validate([
            'current_password' => ['required','string','min:6'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        $currentPasswordStatus = Hash::check($request->current_password, auth()->user()->password);
        if($currentPasswordStatus){
            User::findOrFail(Auth::user()->id)->update([
                'password' => Hash::make($request->password)
            ]);
            return redirect()->back()->with('info','Password Updated Successfully');
        }else{
            return redirect()->back()->with('info','Current Password is Wrong');
        }
    }
}
