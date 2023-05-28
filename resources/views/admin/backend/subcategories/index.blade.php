@extends('admin.backend.layouts.admin')

@section('title', 'Subcategories')

@section('style')
    <style>
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

@section('page-title', 'Subcategories List')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.subcategories.create') }}" class="btn btn-primary">Add Subcategory</a>
    </div>
@endsection

@section('content')
    <table id="table" class="display bg-white" style="width:100%; border: 1px solid #ccc;">
        <thead>
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Slug</th>
                <th>Image</th>
                <th>Category</th>
                <th>Description</th>
                <th>Status</th>
                <th>Popularity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($subcategories as $subcategory)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $subcategory->name }}</td>
                    <td>{{ $subcategory->slug }}</td>
                    <td>
                        @if ($subcategory->image)
                            <img src="{{ Storage::url($subcategory->image) }}" width="100" height="100" class="custom-thumbnail"
                                alt="{{ $subcategory->name }}">
                        @endif
                    </td>
                    <td>{{ $subcategory->category->name }}</td>
                    <td>
                        @if ($subcategory->description)
                            {{ $subcategory->description }}
                        @endif
                    </td>
                    <td>{{ $subcategory->status == '0' ? 'Visible' : 'Hidden' }}</td>
                    <td>{{ $subcategory->is_popular == '0' ? 'No' : 'Yes' }}</td>
                    <td>
                        <a href="{{ url("ecommerce/admin/subcategories/$subcategory->id/edit") }}" class="btn btn-info mb-1">Edit</a><br>
                        <a href="{{ url("ecommerce/admin/subcategories/$subcategory->id") }}" class="btn btn-secondary mb-1">Details</a><br>
                        <button class="btn btn-danger delete-button" data-id="{{ $subcategory->id }}"
                            data-bs-toggle="modal" data-bs-target="#deleteModal">Delete
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
                                    Are you sure to delete this subcategory {{ $subcategory->name }}?<br>
                                    <strong>If you delete this, every product and variant of this subcategory will also be deleted!</strong>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Yes, Delete</button>
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
                "lengthMenu": [[5, 10, 15, 20, -1], [5, 10, 15, 20, "All"]],
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
                    url: "/ecommerce/admin/subcategories/" + id,
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
