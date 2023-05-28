@extends('admin.backend.layouts.admin')

@section('title', 'Slider Details')

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

@section('page-title', 'Slider Details')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.sliders.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $slider->id }}</td>
                </tr>
                <tr>
                    <td>Top Title</td>
                    <td>{{ $slider->top_title }}</td>
                </tr>
                <tr>
                    <td>Title</td>
                    <td>{{ $slider->title }}</td>
                </tr>
                <tr>
                    <td>Sub Title</td>
                    <td>
                        @if ($slider->sub_title)
                            {{ $slider->sub_title }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Offer</td>
                    <td>
                        @if ($slider->offer)
                            {{ $slider->offer }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Link</td>
                    <td>{{ $slider->link }}</td>
                </tr>
                <tr>
                    <td class="align-middle">Image</td>
                    <td>
                        <img src="{{ Storage::url($slider->image) }}" width="100" height="100" class="custom-thumbnail">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>{{ $slider->status == '0' ? 'Visible' : 'Hidden' }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $slider->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $slider->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
