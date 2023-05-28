@extends('admin.backend.layouts.admin')

@section('title', 'Size Details')

@section('page-title', 'Size Details')

@section('style')
    <style>
        .table-container {
            max-height: 100vh; /* Set the desired height for the table container */
            overflow-y: auto; /* Enable vertical scrollbar */
        }
    </style>
@endsection

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.sizes.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $size->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $size->name }}</td>
                </tr>
                <tr>
                    <td>Code</td>
                    <td>{{ $size->code }}</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $size->status == '0' ? 'Visible' : 'Hidden' }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $size->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $size->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
