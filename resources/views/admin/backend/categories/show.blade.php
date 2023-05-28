@extends('admin.backend.layouts.admin')

@section('title', 'Category Details')

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

@section('page-title', 'Category Details')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.categories.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>Slug</td>
                    <td>{{ $category->slug }}</td>
                </tr>
                <tr>
                    <td class="align-middle">Image</td>
                    <td>
                        @if ($category->image)
                            <img src="{{ Storage::url($category->image) }}" width="100" height="100" class="custom-thumbnail">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $category->status == '0' ? 'Visible' : 'Hidden' }}</td>
                </tr>
                <tr>
                    <td>Popularity</td>
                    <td>{{ $category->is_popular == '0' ? 'No' : 'Yes' }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $category->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $category->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
