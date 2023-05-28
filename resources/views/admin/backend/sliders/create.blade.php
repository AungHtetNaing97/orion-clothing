@extends('admin.backend.layouts.admin')

@section('title', 'Add Slider')

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

@section('page-title', 'Add Slider')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.sliders.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container shadow py-3 px-4 mb-5 bg-white" style="border: 2px solid #ccc;">
        <form action="{{ route('ecommerce.admin.sliders.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="top_title" class="form-label">Top Title</label>
                    <input autofocus type="text" class="form-control" id="top_title" name="top_title"
                        value="{{ old('top_title') }}">
                    @error('top_title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="sub_title" class="form-label">Sub Title</label>
                    <input type="text" class="form-control" id="sub_title" name="sub_title"
                        value="{{ old('sub_title') }}">
                    @error('sub_title')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="offer" class="form-label">Offer</label>
                    <input type="text" class="form-control" id="offer" name="offer" value="{{ old('offer') }}">
                    @error('offer')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="link" class="form-label">Link</label>
                    <input type="text" class="form-control" id="link" name="link" value="{{ old('link') }}"
                    placeholder="Please add https:// or http:// at the beginning">
                    @error('link')
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
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="imageInput" class="form-label">Image</label>
                    <input type="file" name="image" id="imageInput" onchange="previewImage(event)"
                        class="form-control">
                    {{-- Show Image immediately --}}
                    <img class="m-1 custom-thumbnail" id="preview" src="#" alt="Image Preview" style="display: none;"
                        width="100" height="100">

                    @error('image')
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
        // Show Image in Form
        function previewImage(event) {
            var input = event.target;
            var preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.setAttribute('src', e.target.result);
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                preview.setAttribute('src', '#');
                preview.style.display = 'none';
            }
        }
    </script>
@endsection
