<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::first();
        return view('admin.backend.settings.index', compact('setting'));
    }

    public function storeupdate(Request $request)
    {
        $setting = Setting::first();
        if ($setting) {
            // Update Data
            $validatedData = $request->validate([
                'name' => 'nullable|string',
                'url' => 'nullable|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
                'address' => 'nullable|string',
                'address_href' => 'nullable|string',
                'phone' => 'nullable|string',
                'phone_href' => 'nullable|string',
                'email' => 'nullable|email',
                'email_href' => 'nullable|email',
                'facebook' => 'nullable|string',
                'twitter' => 'nullable|string',
                'instagram' => 'nullable|string',
                'youtube' => 'nullable|string'
            ]);

            $image = $request->image;
            if ($image) {
                Storage::delete('public/admin/backend/settings/' . $setting->image);
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $request->image->move('storage/admin/backend/settings', $imagename);
                $validatedData['image'] = $imagename;
            }

            // $image_path = $setting->image;
            // if ($request->hasFile('image')) {
            //     Storage::delete($setting->image);
            //     $image_path = $request->file('image')->store('public/admin/backend/settings');
            //     $validatedData['image'] = $image_path;
            // }
            $setting->update($validatedData);
            return redirect()->back()->with('message', 'Settings are updated successfully!');
        } else {
            // Create Data
            $validatedData = $request->validate([
                'name' => 'required|string',
                'url' => 'required|string',
                'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'address' => 'required|string',
                'address_href' => 'required|string',
                'phone' => 'required|string',
                'phone_href' => 'required|string',
                'email' => 'required|email',
                'email_href' => 'required|email',
                'facebook' => 'nullable|string',
                'twitter' => 'nullable|string',
                'instagram' => 'nullable|string',
                'youtube' => 'nullable|string'
            ]);

            $image = $request->image;
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('storage/admin/backend/settings', $imagename);
            $validatedData['image'] = $imagename;

            Setting::create($validatedData);
            return redirect()->back()->with('message', 'Settings are created succcessfully!');
        }
    }
}
