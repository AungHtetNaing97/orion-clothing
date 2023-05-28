@extends('admin.backend.layouts.admin')

@section('title', 'Brand Details')

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

@section('page-title', 'Brand Details')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.brands.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $brand->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $brand->name }}</td>
                </tr>
                <tr>
                    <td>Slug</td>
                    <td>{{ $brand->slug }}</td>
                </tr>
                <tr>
                    <td class="align-middle">Image</td>
                    <td>
                        @if ($brand->image)
                            <img src="{{ Storage::url($brand->image) }}" class="custom-thumbnail" width="100" height="100">
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td>{{ $brand->description }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $brand->status == '0' ? 'Visible' : 'Hidden' }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $brand->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $brand->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
