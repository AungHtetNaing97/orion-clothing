@extends('admin.backend.layouts.admin')

@section('title', 'Products')

@section('style')
    <style>
        .custom-thumbnail {
            background-color: #eeeeee;
            border: 1px solid #dee2e6;
            border-radius: 2px;
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

@section('page-title', 'Products List')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
@endsection

@section('content')
    <table id="table" class="display bg-white" style="width:100%; border: 1px solid #ccc;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Images</th>
                <th>Short Description</th>
                <th>Description</th>
                <th>Regular Price</th>
                <th>Sale Price</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Brand</th>
                <th>Variants</th>
                <th>Code</th>
                <th>Status</th>
                <th>Trending</th>
                <th>Featured</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($products as $product)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->slug }}</td>
                    <td>
                        @if ($product->productImages->count() > 0)
                            @foreach ($product->productImages as $productImage)
                                <img class="custom-thumbnail mb-1" src="{{ Storage::url($productImage->image) }}" alt="{{ $product->name }}" width="50" height="50">
                            @endforeach
                        @endif
                    </td>
                    <td>
                        @if ($product->short_description)
                            {{ $product->short_description }}
                        @endif
                    </td>
                    <td>
                        @if ($product->description)
                            {{ $product->description }}
                        @endif
                    </td>
                    <td>${{ $product->regular_price }}</td>
                    <td>
                        @if ($product->sale_price)
                            ${{ $product->sale_price }}
                        @endif
                    </td>
                    <td>{{ $product->category->name }}</td>
                    <td>{{ $product->subcategory->name }}</td>
                    <td>{{ $product->brand->name }}</td>
                    <td>{{ $product->variants->count() }}</td>
                    <td>
                        @if ($product->code)
                            {{ $product->code }}
                        @endif
                    </td>
                    <td>{{ $product->status == '0' ? 'Visible' : 'Hidden' }}</td>
                    <td>{{ $product->trending == '0' ? 'No' : 'Yes' }}</td>
                    <td>{{ $product->featured == '0' ? 'No' : 'Yes' }}</td>
                    <td>
                        <a href="{{ url("ecommerce/admin/products/$product->id/edit") }}"
                            class="btn btn-info mb-1">Edit</a><br>
                        <a href="{{ url("ecommerce/admin/products/$product->id") }}"
                            class="btn btn-secondary mb-1">Details</a><br>
                        <button class="btn btn-danger delete-button" data-id="{{ $product->id }}" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">Delete
                        </button>
                    </td>

                    {{-- Modal --}}
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                        <strong>
                                            <i class="fa-solid fa-circle-exclamation"></i> Warning <i
                                                class="fa-solid fa-circle-exclamation"></i>
                                        </strong>
                                    </h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure to delete this product {{ $product->name }}?<br>
                                    <strong>If you delete this, product images will also be deleted!</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes,
                                        Delete</button>
                                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('script')
    <script>
        // Datatable
        $(document).ready(() => {
            $('#table').DataTable({
                "lengthMenu": [
                    [5, 10, 15, 20, -1],
                    [5, 10, 15, 20, "All"]
                ],
                "scrollY": "60vh",
                "scrollX": "100%"
            });
        });

        // Delete the record with modal box and ajax
        $(document).on('click', '.delete-button', (event) => {
            event.preventDefault(); // Prevent the default action of the button

            let deleteButton = $(event.currentTarget);
            let selectedRow = deleteButton.parent().parent();
            let id = deleteButton.data('id');
            // console.log(id);

            // Update the confirm button click event
            $('#confirmDeleteButton').on('click', () => {
                $.ajax({
                    type: "DELETE",
                    url: "/ecommerce/admin/products/" + id,
                    data: {
                        "_token": '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        selectedRow.remove();
                        $('#deleteModal').modal('hide');

                        // Show the success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: data.message,
                            showConfirmButton: false,
                            timer: 2000
                        });

                        // If you're using DataTables, remove the row from the table
                        $('#table').DataTable().row(selectedRow).remove().draw(false);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            });
        });
    </script>
@endsection
