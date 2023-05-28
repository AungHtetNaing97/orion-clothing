<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SizeFormRequest;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sizes = Size::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.backend.sizes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SizeFormRequest $request)
    {
        $validatedData = $request->validated();
        Size::create($validatedData);
        return redirect('ecommerce/admin/sizes')->with('message', 'Size is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Size $size)
    {
        return view('admin.backend.sizes.show')->with('size', $size);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Size $size)
    {
        return view('admin.backend.sizes.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Size $size)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'unique:sizes,name,' . $size->id . ',id'],
            'code' => ['required', 'string', 'unique:sizes,code,' . $size->id . ',id'],
            'status' => 'required|integer'
        ]);
        $size->update($validatedData);

        return redirect('ecommerce/admin/sizes')->with('message', 'Size is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return response()->json(['message' => 'Size and its related variants are deleted successfully!']);
    }
}
