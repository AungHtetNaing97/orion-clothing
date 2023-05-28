<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ColorFormRequest;

class ColorController extends Controller
{

    public function index()
    {
        $colors = Color::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ColorFormRequest $request)
    {
        $validatedData = $request->validated();
        Color::create($validatedData);
        return redirect('ecommerce/admin/colors')->with('message', 'Color is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Color $color)
    {
        return view('admin.backend.colors.show')->with('color', $color);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view('admin.backend.colors.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'unique:colors,name,' . $color->id . ',id'],
            'code' => ['required', 'string', 'unique:colors,code,' . $color->id . ',id'],
            'status' => 'required|integer'
        ]);
        // Color::findOrFail($color->id)->update($validatedData);
        $color->update($validatedData);

        return redirect('ecommerce/admin/colors')->with('message', 'Color is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        // $color = Color::findOrFail($color_id);
        $color->delete();
        return response()->json(['message' => 'Color and its related variants are deleted successfully!']);
    }
}
