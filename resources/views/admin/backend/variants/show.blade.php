@extends('admin.backend.layouts.admin')

@section('title', 'Variant Details')

@section('style')
    <style>
        .table-container {
            max-height: 100vh;
            /* Set the desired height for the table container */
            overflow-y: auto;
            /* Enable vertical scrollbar */
        }
    </style>
@endsection

@section('page-title', 'Variant Details')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.variants.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $variant->id }}</td>
                </tr>
                <tr>
                    <td class="align-middle">Product</td>
                    <td>
                        <a href="{{ url('ecommerce/admin/products/' . $variant->product->id) }}" class="btn btn-success">
                            {{ $variant->product->name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">Color</td>
                    <td>
                        @if ($variant->color)
                            <a href="{{ url('ecommerce/admin/colors/' . $variant->color->id) }}" class="btn btn-warning">
                                {{ $variant->color->code }}
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">Size</td>
                    <td>
                        @if ($variant->size)
                            <a href="{{ url('ecommerce/admin/sizes/' . $variant->size->id) }}" class="btn btn-secondary">
                                {{ $variant->size->code }}
                            </a>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Quantity</td>
                    <td>{{ $variant->quantity }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $variant->status == '0' ? 'Visible' : 'Hidden' }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $variant->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $variant->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
