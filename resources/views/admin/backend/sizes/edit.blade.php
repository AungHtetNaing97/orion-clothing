@extends('admin.backend.layouts.admin')

@section('title', 'Edit Size')

@section('page-title', 'Edit Size')

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
    <div class="shadow table-container py-3 px-4 mb-5 bg-white" style="border: 2px solid #ccc;">
        <form action="{{ url("ecommerce/admin/sizes/$size->id") }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input autofocus type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $size->name) }}">

                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="code" class="form-label">Code</label>
                    <input type="text" class="form-control" id="code" name="code"
                        value="{{ old('code', $size->code) }}">

                    @error('code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-md-4 mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="0" @selected(old('status', $size->status) == 0)>Visible</option>
                        <option value="1" @selected(old('status', $size->status) == 1)>Hidden</option>
                    </select>
                    @error('status')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        // Make every case to be upper
        document.getElementById('code').addEventListener('input', function() {
            var inputValue = this.value;
            var words = inputValue.split(' ');
            var capitalizedWords = words.map(function(word) {
                return word.toUpperCase();
            });
            var capitalizedValue = capitalizedWords.join(' ');
            this.value = capitalizedValue;
        });
    </script>
@endsection
