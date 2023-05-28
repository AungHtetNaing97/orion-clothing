<?php

namespace App\Http\Controllers\Admin\Backend;

use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Variant;
use App\Models\ColorSize;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = Variant::where(function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('status', 0);
                })
                ->orWhereNull('product_id');
            })
            ->where(function ($query) {
                $query->whereHas('color', function ($query) {
                    $query->where('status', 0);
                })
                ->orWhereNull('color_id');
            })
            ->where(function ($query) {
                $query->whereHas('size', function ($query) {
                    $query->where('status', 0);
                })
                ->orWhereNull('size_id');
            })
            ->orderBy('updated_at', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('admin.backend.variants.index', compact('variants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $productIds = Product::where('status', 0)->pluck('id');

        if ($productIds->isEmpty()) {
            // No products available, handle the error or redirect as needed
            $variants = Variant::where(function ($query) {
                $query->whereHas('product', function ($query) {
                    $query->where('status', 0);
                })
                ->orWhereNull('product_id');
            })
            ->where(function ($query) {
                $query->whereHas('color', function ($query) {
                    $query->where('status', 0);
                })
                ->orWhereNull('color_id');
            })
            ->where(function ($query) {
                $query->whereHas('size', function ($query) {
                    $query->where('status', 0);
                })
                ->orWhereNull('size_id');
            })
            ->orderBy('created_at', 'DESC')
            ->get();

            return redirect('ecommerce/admin/variants')
                    ->with('variants', $variants)
                    ->with('message', 'No products are available to create variants.');
        }

        $products = Product::whereIn('id', $productIds)->orderBy('created_at', 'DESC')->get();
        $colors = Color::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $sizes = Size::where('status', 0)->orderBy('created_at', 'DESC')->get();

        return view('admin.backend.variants.create', compact('products', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => [
                'required', 'integer',
                Rule::unique('variants')->where(function ($query) use ($request) {
                    return $query->where('product_id', $request->product_id)
                        ->where('color_id', $request->color_id)
                        ->where('size_id', $request->size_id);
                }),
            ],
            'color_id' => 'nullable|integer',
            'size_id' => 'nullable|integer',
            'status' => 'required|integer',
            'SKU' => 'required|string',
            'quantity' => 'required|integer'
        ], [
            'product_id.unique' => 'The product name is already taken.'
        ]);
        Variant::create($validatedData);
        return redirect('ecommerce/admin/variants')->with('message', 'Variant is added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Variant $variant)
    {
        return view('admin.backend.variants.show')->with('variant', $variant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Variant $variant)
    {
        $products = Product::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $colors = Color::where('status', 0)->orderBy('created_at', 'DESC')->get();
        $sizes = Size::where('status', 0)->orderBy('created_at', 'DESC')->get();

        return view('admin.backend.variants.edit', compact('variant', 'products', 'sizes', 'colors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Variant $variant)
    {
        $validatedData = $request->validate([
            'product_id' => [
                'required', 'integer',
                Rule::unique('variants')->where(function ($query) use ($request, $variant) {
                    return $query->where('product_id', $request->product_id)
                        ->where('color_id', $request->color_id)
                        ->where('size_id', $request->size_id)
                        ->whereNot('id', $variant->id);
                }),
            ],
            'color_id' => 'nullable|integer',
            'size_id' => 'nullable|integer',
            'status' => 'required|integer',
            'SKU' => 'required|string',
            'quantity' => 'required|integer'
        ], [
            'product_id.unique' => 'The product name is already taken.'
        ]);

        $variant->update($validatedData);
        return redirect('ecommerce/admin/variants')->with('message', 'Variant is updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variant $variant)
    {
        $variant->delete();
        return response()->json(['message' => 'Variant is deleted successfully!']);
    }
}
