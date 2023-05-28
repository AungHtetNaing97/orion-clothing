@extends('admin.backend.layouts.admin')

@section('title', 'Product Details')

@section('style')
    <style>
        .table-container {
            max-height: 100vh;
            /* Set the desired height for the table container */
            overflow-y: auto;
            /* Enable vertical scrollbar */
        }
        .custom-thumbnail {
            padding: 0.25rem;
            background-color: #eeeeee;
            border: 1px solid #dee2e6;
            border-radius: 2px;
            max-width: 100%;
        }
    </style>
@endsection

@section('page-title', 'Product Details')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.products.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>Slug</td>
                    <td>{{ $product->slug }}</td>
                </tr>
                <tr>
                    <td class="align-middle">Images</td>
                    <td>
                        @if ($product->productImages->count() > 0)
                            @foreach ($product->productImages as $productImage)
                                <img class="custom-thumbnail mb-1" src="{{ Storage::url($productImage->image) }}"
                                    alt="{{ $product->name }}" width="100" height="100">
                            @endforeach
                        @else
                            <p class="text-center">No images Available</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Short Description</td>
                    <td>{{ $product->short_description }}</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <td>Regular Price</td>
                    <td>${{ $product->regular_price }}</td>
                </tr>
                <tr>
                    <td>Sale Price</td>
                    <td>
                        @if ($product->sale_price)
                            ${{ $product->sale_price }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">Category</td>
                    <td>
                        <a href="{{ url('ecommerce/admin/categories/' . $product->category->id) }}" class="btn btn-info">
                            {{ $product->category->name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">Subcategory</td>
                    <td>
                        <a href="{{ url('ecommerce/admin/subcategories/' . $product->subcategory->id) }}" class="btn btn-success">
                            {{ $product->subcategory->name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">Brand</td>
                    <td>
                        <a href="{{ url('ecommerce/admin/brands/' . $product->brand->id) }}" class="btn btn-dark">
                            {{ $product->brand->name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Variants</td>
                    <td>{{ $product->variants->count() }}</td>
                </tr>
                <tr>
                    <td>Code</td>
                    <td>{{ $product->code }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $product->status == '0' ? 'Visible' : 'Hidden' }}</td>
                </tr>
                <tr>
                    <td>Trending</td>
                    <td>{{ $product->trending == '0' ? 'No' : 'Yes' }}</td>
                </tr>
                <tr>
                    <td>Featured</td>
                    <td>{{ $product->featured == '0' ? 'No' : 'Yes' }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $product->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $product->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
