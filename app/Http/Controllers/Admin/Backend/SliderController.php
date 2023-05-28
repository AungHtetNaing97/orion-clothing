<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        $image_path = $request->file('image')->store('public/admin/backend/sliders');
        $validatedData['image'] = $image_path;

        Slider::create($validatedData);
        return redirect('ecommerce/admin/sliders')->with('message', 'Slider is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        return view('admin.backend.sliders.show', compact('slider'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('admin.backend.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $validatedData = $request->validate([
            'top_title' => 'required|string',
            'title' => 'required|string',
            'sub_title' => 'nullable|string',
            'offer' => 'nullable|string',
            'link' => 'required|string',
            'image' => 'nullable|mimes:jpeg,png,jpg,webp|max:2048',
            'status' => 'required|integer'
        ]);
        $validatedData['image'] = $slider->image;

        if($request->hasFile('image')) {
            Storage::delete($slider->image);
            $image_path = $request->file('image')->store('public/admin/backend/sliders');
            $validatedData['image'] = $image_path;
        }

        $slider->update($validatedData);
        return redirect('ecommerce/admin/sliders')->with('message', 'Slider is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        Storage::delete($slider->image);
        $slider->delete();
        return response()->json(['message' => 'Slider is deleted successfully!']);
    }
}
