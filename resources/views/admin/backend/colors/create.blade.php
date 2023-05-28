@extends('admin.backend.layouts.admin')

@section('title', 'Add Color')

@section('page-title', 'Add Color')

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
        <a href="{{ route('ecommerce.admin.colors.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container shadow py-3 px-4 mb-5 bg-white" style="border: 2px solid #ccc;">
        <form action="{{ route('ecommerce.admin.colors.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input autofocus type="text" class="form-control" id="name" name="name"
                        value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control border-secondary" id="code" name="code"
                        value="{{ old('code') }}" readonly>
                    @error('code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
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
        // Auto generate Code
        $(document).ready(function() {
            // listen for keyup event on name input
            $('#name').on('keyup', function() {
                // get the value of the name input
                var nameValue = $(this).val();

                // convert name value to lowercase and remove spaces
                var codeValue = nameValue.toLowerCase().replace(/\s+/g, '-');

                // set the value of the code input
                $('#code').val(codeValue);
            });
        });
    </script>
@endsection
