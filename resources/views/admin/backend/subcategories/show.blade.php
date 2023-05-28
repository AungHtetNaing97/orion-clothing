@extends('admin.backend.layouts.admin')

@section('title', 'Subcategory Details')

@section('style')
    <style>
        .table-container {
            max-height: 100vh; /* Set the desired height for the table container */
            overflow-y: auto; /* Enable vertical scrollbar */
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

@section('page-title', 'Subcategory Details')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.subcategories.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $subcategory->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $subcategory->name }}</td>
                </tr>
                <tr>
                    <td>Slug</td>
                    <td>{{ $subcategory->slug }}</td>
                </tr>
                <tr>
                    <td class="align-middle">Image</td>
                    <td>
                        @if ($subcategory->image)
                            <img src="{{ Storage::url($subcategory->image) }}" width="100" height="100" class="custom-thumbnail">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="align-middle">Category</td>
                    <td>
                        <a href="{{ url('ecommerce/admin/categories/' . $subcategory->category->id) }}" class="btn btn-info">
                            {{ $subcategory->category->name }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $subcategory->description }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $subcategory->status == '0' ? 'Visible' : 'Hidden' }}</td>
                </tr>
                <tr>
                    <td>Popularity</td>
                    <td>{{ $subcategory->is_popular == '0' ? 'No' : 'Yes' }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $subcategory->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $subcategory->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
