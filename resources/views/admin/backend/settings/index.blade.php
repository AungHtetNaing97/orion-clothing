@extends('admin.backend.layouts.admin')

@section('title', 'App Settings')

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

@section('alert')
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check"></i> <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection

@section('page-title', 'App Settings')

@section('content')
    <div class="row table-container">
        <div class="col-md-12 grid-margin">
            <form action="{{ url('ecommerce/admin/settings') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0 p-2">Website - Basic Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" autofocus
                                    value="{{ old('name', $setting->name) }}" class="form-control">
                                @error('name')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="url">URL</label>
                                <input type="text" name="url" id="url" value="{{ old('url', $setting->url) }}"
                                    class="form-control">
                                @error('url')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="imageInput" class="form-label">Image</label>
                                <input type="file" name="image" id="imageInput" onchange="previewImage(event)"
                                    class="form-control">
                                {{-- Show Image from Database or Show Edited Image --}}
                                @if ($setting->image)
                                    <img class="m-1 custom-thumbnail" src="{{ asset('storage/admin/backend/settings/' . $appSetting->image) }}"
                                        width="100" height="100" id="imagePreview" alt="{{ $appSetting->name ?? 'website name' }}">
                                @else
                                    {{-- Show Image immediately --}}
                                    <img class="m-1 custom-thumbnail" id="preview" src="#" alt="Image Preview"
                                        style="display: none;" width="100" height="100">
                                @endif

                                @error('image')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="address">Address</label>
                                <textarea name="address" rows="3" class="form-control" id="address">
                                    {{ old('address', $setting->address) }}</textarea>
                                @error('address')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="address_href">Address's href</label>
                                <input type="text" name="address_href" id="address_href"
                                    value="{{ old('address_href', $setting->address_href) }}" class="form-control">
                                @error('address_href')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    value="{{ old('phone', $setting->phone) }}">
                                @error('phone')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="phone_href">Phone's href</label>
                                <input type="text" name="phone_href" id="phone_href"
                                    value="{{ old('phone_href', $setting->phone_href) }}" class="form-control">
                                @error('phone_href')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ old('email', $setting->email) }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email_href">Email's href</label>
                                <input type="email" name="email_href" class="form-control" id="email_href"
                                    value="{{ old('email_href', $setting->email_href) }}">
                                @error('email_href')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-header bg-primary">
                        <h3 class="text-white mb-0 p-2">Website - Social Media</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="facebook">Facebook (Optional)</label>
                                <input type="text" name="facebook" class="form-control" id="facebook"
                                    value="{{ old('facebook', $setting->facebook) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="twitter">Twitter (Optional)</label>
                                <input type="text" name="twitter" class="form-control" id="twitter"
                                    value="{{ old('twitter', $setting->twitter) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="instagram">Instagram (Optional)</label>
                                <input type="text" name="instagram" class="form-control" id="instagram"
                                    value="{{ old('instagram', $setting->instagram) }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="youtube">YouTube (Optional)</label>
                                <input type="text" name="youtube" class="form-control" id="youtube"
                                    value="{{ old('youtube', $setting->youtube) }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary text-white">Save Settings</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Show Image in Form if there is already image
        var imageInput = document.getElementById('imageInput');
        var imagePreview = document.getElementById('imagePreview');
        imageInput.addEventListener('change', function() {
            var file = this.files[0];
            if (file) {
                imagePreview.src = URL.createObjectURL(file);
            } else {
                imagePreview.src = "{{ asset('storage/admin/backend/settings/' . $appSetting->image) }}";
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
