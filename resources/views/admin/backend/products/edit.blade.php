@extends('admin.backend.layouts.admin')

@section('title', 'Edit Product')

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

@section('page-title', 'Edit Product')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.products.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('alert')
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fa-solid fa-circle-check"></i> <strong>{{ session('message') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
@endsection

@section('content')
    <div class="table-container shadow py-3 px-4 bg-white mt-2" style="border: 2px solid #ccc;">
        <form action="{{ url('ecommerce/admin/products/' . $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item mb-2 mx-1" role="presentation">
                    <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details-tab-pane"
                        type="button" role="tab" aria-controls="details-tab-pane" aria-selected="true">
                        Details
                    </button>
                </li>
                <li class="nav-item mb-2 mx-1" role="presentation">
                    <button class="nav-link" id="images-tab" data-bs-toggle="tab" data-bs-target="#images-tab-pane"
                        type="button" role="tab" aria-controls="images-tab-pane" aria-selected="false">
                        Images
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="details-tab-pane" role="tabpanel" aria-labelledby="details-tab"
                    tabindex="0">
                    <div class="row mb-3 mt-2">
                        <div class="col-md-3 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input autofocus type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $product->name) }}">
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="slug" class="form-label">Slug</label>
                            <input type="text" class="form-control border-secondary" id="slug" name="slug"
                                value="{{ old('slug', $product->slug) }}" readonly>
                            @error('slug')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select name="category_id" class="form-select" id="category_id">
                                <option value="" disabled selected>Select a category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $selectedCategoryID == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="subcategory_id" class="form-label">Subcategory</label>
                            <select name="subcategory_id" class="form-select" id="subcategory_id">
                                <option value="" disabled selected>Select a subcategory</option>
                                @if ($selectedCategoryID)
                                    @foreach ($subcategoriesByCategory[$selectedCategoryID] as $subcategory)
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            @error('subcategory_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-3 mb-3">
                            <label for="brand_id" class="form-label">Brand</label>
                            <select name="brand_id" class="form-select" id="brand_id">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @selected(old('brand_id', $product->brand_id) == $brand->id)>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('brand_id')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" class="form-select" id="status">
                                <option value="0" @selected(old('status', $product->status) == 0)>Visible</option>
                                <option value="1" @selected(old('status', $product->status) == 1)>Hidden</option>
                            </select>
                            @error('status')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="trending" class="form-label">Trending</label>
                            <select name="trending" class="form-select" id="trending">
                                <option value="0" @selected(old('trending', $product->trending) == 0)>No</option>
                                <option value="1" @selected(old('trending', $product->trending) == 1)>Yes</option>
                            </select>
                            @error('trending')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="featured" class="form-label">Featured</label>
                            <select name="featured" class="form-select" id="featured">
                                <option value="0" @selected(old('featured', $product->featured) == 0)>No</option>
                                <option value="1" @selected(old('featured', $product->featured) == 1)>Yes</option>
                            </select>
                            @error('featured')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 mb-3">
                            <label for="regular_price" class="form-label">Regular Price ($)</label>
                            <input type="text" name="regular_price" id="regular_price" class="form-control"
                                pattern="\d+(\.\d{2})?" title="Please enter a valid price (e.g., 20.33 or 30)"
                                value="{{ old('regular_price', $product->regular_price) }}">
                            @error('regular_price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="sale_price" class="form-label">Sale Price ($)</label>
                            <input type="text" name="sale_price" id="sale_price" class="form-control"
                                pattern="\d+(\.\d{2})?" title="Please enter a valid price (e.g., 20.33 or 30)"
                                value="{{ old('sale_price', $product->sale_price) }}" placeholder="2 or 20 or 20.20">
                            @error('sale_price')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="code" class="form-label">Code</label>
                            <input type="text" name="code" id="code" class="form-control border-secondary"
                                value="{{ old('code', $product->code) }}" readonly>
                            @error('code')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="short_description" class="form-label">Short Description</label>
                            <textarea name="short_description" id="short_description" class="form-control" rows="3">
                                {{ old('short_description', $product->short_description) }}
                            </textarea>
                            @error('short_description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" rows="3">
                                {{ old('description', $product->description) }}
                            </textarea>
                            @error('description')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="images-tab-pane" role="tabpanel" aria-labelledby="images-tab"
                    tabindex="0">
                    <div class="row mt-2">
                        <!-- Current Images -->
                        <div class="col-md-12 mb-3">
                            <label for="current_images" class="form-label">Current Images:</label><br>
                            @foreach ($product->productImages as $productImage)
                                <div class="col-md-2 d-inline-block text-center mb-2">
                                    <img src="{{ Storage::url($productImage->image) }}" alt="{{ $product->name }}"
                                        class="custom-thumbnail m-1" width="100" height="100"><br>
                                    @if ($product->productImages->count() > 1)
                                        <a href="{{ url('ecommerce/admin/products/productImage/' . $productImage->id) }}"
                                            class="btn btn-sm btn-warning text-dark">
                                            Remove
                                        </a>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        <div class="col-sm-12 mb-3 mt-2">
                            <label for="image" class="form-label">Images (Use Ctrl+click to select muliple images)</label>
                            <input type="file" id="image" name="image[]" class="form-control" multiple>
                            @error('image.*')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror

                            <div id="selected-images-container" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shadow d-inline-block">
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script>
        // Show selected images
        function previewImages(event) {
            var input = event.target;
            var selectedImagesContainer = document.getElementById('selected-images-container');
            selectedImagesContainer.innerHTML = ''; // Clear previous images

            if (input.files && input.files.length > 0) {
                for (var i = 0; i < input.files.length; i++) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var image = document.createElement('img');
                        image.setAttribute('src', e.target.result);
                        image.setAttribute('class', 'm-1 custom-thumbnail'); // Add margin-right class
                        image.setAttribute('width', '100'); // Set the desired width
                        image.setAttribute('height', '100'); // Set the desired height
                        selectedImagesContainer.appendChild(image);
                    };

                    reader.readAsDataURL(input.files[i]);
                }
            }
        }
        // Trigger image preview on file selection
        $('#image').on('change', function(event) {
            previewImages(event);
        });

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

                // call the generateProductCode function and set the value of the code input
                var productCode = generateProductCode(nameValue);
                $('#code').val(productCode);
            });

            // Generate product code based on name
            function generateProductCode(name) {
                // Remove any leading/trailing whitespace and convert the name to uppercase
                name = name.trim().toUpperCase();

                // Split the name into individual words
                var words = name.split(' ');

                // Initialize an empty code variable
                var code = '';

                // Iterate over each word and extract the first letter
                for (var i = 0; i < words.length; i++) {
                    code += words[i].charAt(0);
                }

                // Generate a random alphanumeric sequence of length 3
                var randomSequence = Math.random().toString(36).substring(2, 5).toUpperCase();

                // Combine the extracted letters and the random sequence to form the final code
                var productCode = code + '-' + randomSequence;

                return productCode;
            }
        });

        // Function to update the subcategory select element based on the selected category
        var subcategoriesByCategory = {!! json_encode($subcategoriesByCategory) !!};

        function updateSubcategories(categoryId) {
            var subcategorySelect = document.getElementById('subcategory_id');
            subcategorySelect.innerHTML = '<option value="" disabled selected>Select a subcategory</option>';

            if (subcategoriesByCategory.hasOwnProperty(categoryId)) {
                var subcategories = subcategoriesByCategory[categoryId];
                subcategories.forEach(function(subcategory) {
                    var option = document.createElement('option');
                    option.value = subcategory.id;
                    option.textContent = subcategory.name;
                    subcategorySelect.appendChild(option);
                });
            }
        }

        // Event listener to update subcategories when the category select element changes
        var categorySelect = document.getElementById('category_id');
        categorySelect.addEventListener('change', function() {
            var selectedCategoryId = categorySelect.value;
            updateSubcategories(selectedCategoryId);
        });

        // Set the initially selected category and update subcategories
        var selectedCategoryID = {!! json_encode($selectedCategoryID) !!};
        if (selectedCategoryID) {
            categorySelect.value = selectedCategoryID;
            updateSubcategories(selectedCategoryID);
        }

        // Set the initially selected subcategory
        var selectedSubcategoryID = {!! json_encode($selectedSubcategoryID) !!};
        if (selectedSubcategoryID) {
            var subcategorySelect = document.getElementById('subcategory_id');
            subcategorySelect.value = selectedSubcategoryID;
        }
    </script>
@endsection
