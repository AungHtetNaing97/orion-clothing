@extends('admin.backend.layouts.admin')

@section('title', 'Edit Category')

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

@section('page-title', 'Edit Category')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.categories.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container shadow py-3 px-4 mb-5 bg-white" style="border: 2px solid #ccc;">
        <form action="{{ url('ecommerce/admin/categories/' . $category->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-sm-6 mb-3">
                    <div class="col-sm-12 mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input autofocus type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $category->name) }}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-sm-12 mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control border-secondary" id="slug" name="slug"
                            value="{{ old('slug', $category->slug) }}" readonly>
                        @error('slug')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-sm-6 mb-3">
                    <label for="imageInput" class="form-label">Image</label>
                    <input type="file" name="image" id="imageInput" onchange="previewImage(event)"
                        class="form-control">
                    {{-- Show Image from Database or Show Edited Image --}}
                    @if ($category->image)
                        <img class="m-1 custom-thumbnail" src="{{ Storage::url($category->image) }}" width="100" height="100"
                            id="imagePreview">
                    @else
                        {{-- Show Image immediately --}}
                        <img class="m-1 custom-thumbnail" id="preview" src="#" alt="Image Preview" style="display: none;"
                            width="100" height="100">
                    @endif

                    @error('image')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" class="form-select" id="status">
                            <option value="0" @selected(old('status', $category->status) == 0)>Visible</option>
                            <option value="1" @selected(old('status', $category->status) == 1)>Hidden</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-sm-3 mb-3">
                        <label for="is_popular" class="form-label">Popularity</label>
                        <select name="is_popular" class="form-select" id="is_popular">
                            <option value="0" @selected(old('is_popular', $category->is_popular) == 0)>No</option>
                            <option value="1" @selected(old('is_popular', $category->is_popular) == 1)>Yes</option>
                        </select>
                        @error('is_popular')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
@endsection

@section('script')
    <script>
        // Auto generate Slug
        $(document).ready(function() {
            // listen for keyup event on name input
            $('#name').on('keyup', function() {
                // get the value of the name input
                var nameValue = $(this).val();

                // convert name value to lowercase and remove spaces
                var codeValue = nameValue.toLowerCase().replace(/\s+/g, '-');

                // set the value of the slug input
                $('#slug').val(codeValue);
            });
        });

        // Show Image in Form if there is already image
        var imageInput = document.getElementById('imageInput');
        var imagePreview = document.getElementById('imagePreview');
        imageInput.addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
            } else {
                imagePreview.src = "{{ Storage::url($category->image) }}";
            }
        });

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
