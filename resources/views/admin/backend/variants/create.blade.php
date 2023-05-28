@extends('admin.backend.layouts.admin')

@section('title', 'Add Variant')

@section('style')
    <style>
        .table-container {
            max-height: 100vh; /* Set the desired height for the table container */
            overflow-y: auto; /* Enable vertical scrollbar */
        }
    </style>
@endsection

@section('page-title', 'Add Variant')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.variants.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('alert')
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check"></i> <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection

@section('content')
    <div class="shadow table-container py-3 px-4 mb-5 bg-white" style="border: 2px solid #ccc;">
        <form action="{{ route('ecommerce.admin.variants.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="product_id" class="form-label">Product</label>
                    <select name="product_id" class="form-select" id="product_id">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}" data-code="{{ $product->code }}"
                                @selected(old('product_id') == $product->id)>
                                {{ $product->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="color_id" class="form-label">Color</label>
                    <select name="color_id" class="form-select" id="color_id">
                        <option value="">Mixed Color</option>
                        @foreach ($colors as $color)
                            <option value="{{ $color->id }}" @selected(old('color_id') == $color->id)>
                                {{ $color->code }}
                            </option>
                        @endforeach
                    </select>
                    @error('color_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="size_id" class="form-label">Size</label>
                    <select name="size_id" class="form-select" id="size_id">
                        <option value="">Free Size</option>
                        @foreach ($sizes as $size)
                            <option value="{{ $size->id }}" @selected(old('size_id') == $size->id)>
                                {{ $size->code }}
                            </option>
                        @endforeach
                    </select>
                    @error('size_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="SKU" class="form-label">SKU</label>
                    <input type="text" name="SKU" id="SKU" class="form-control border-secondary"
                        value="{{ old('SKU') }}" readonly>
                    @error('SKU')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="quantity" class="form-label">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity') }}"
                        min="0">
                    @error('quantity')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select" id="status">
                        <option value="0" @selected(old('status') == 0)>Visible</option>
                        <option value="1" @selected(old('status') == 1)>Hidden</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        // Generate SKU based on productcode, colorcode, sizecode
        function generateSKU() {
            var productCode = $('#product_id option:selected').data('code');

            // Get the selected color and size values
            var colorValue = $('#color_id').val();
            var sizeValue = $('#size_id').val();

            // Check if color or size is not selected
            var colorCode = colorValue ? $('#color_id option:selected').text().trim().toUpperCase() : 'mixed-color';
            var sizeCode = sizeValue ? $('#size_id option:selected').text().trim() : 'free-size';

            var SKU = productCode + '-' + colorCode + '-' + sizeCode;
            $('#SKU').val(SKU);
        }

        $(document).ready(function() {
            // Generate SKU initially
            generateSKU();

            // Generate SKU when product, color, or size is changed
            $('#product_id, #color_id, #size_id').change(function() {
                generateSKU();
            });
        });
    </script>
@endsection
