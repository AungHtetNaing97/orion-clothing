@extends('admin.backend.layouts.admin')

@section('title', 'Dashboard')

@section('style')
    <style>
        @media (max-width: 320px) {
            .col-sm-12 {
                flex: 0 0 auto;
                width: 100%;
            }
        }

        .table-container {
            max-height: 100vh;
            /* Set the desired height for the table container */
            overflow-y: auto;
            /* Enable vertical scrollbar */
        }

        @media (max-width: 768px) and (min-width: 576px) {
            .custom-3 {
                flex: 0 0 auto;
                width: calc(100% / 3);
            }
        }
    </style>
@endsection

@section('content')
    <div class="row table-container">
        <div class="col-md-12 grid-margin">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check"></i> <strong>{{ session('message') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="me-md-3 me-xl-5">
                <h2>Dashboard,</h2>
                <p class="mb-md-0">Your analytics dashboard template.</p>
                <hr>
            </div>

            <div class="row">
                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-primary text-white mb-3 text-center">
                        <label>Total Orders</label>
                        <h1>{{ $totalOrder }}</h1>
                        <a href="{{ url('ecommerce/admin/orders') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-success text-white mb-3 text-center">
                        <label>Today Orders</label>
                        <h1>{{ $todayOrder }}</h1>
                        <a href="{{ url('ecommerce/admin/orders') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-warning text-white mb-3 text-center">
                        <label>This Month Orders</label>
                        <h1>{{ $thisMonthOrder }}</h1>
                        <a href="{{ url('ecommerce/admin/orders') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-danger text-white mb-3 text-center">
                        <label>This Year Orders</label>
                        <h1>{{ $thisYearOrder }}</h1>
                        <a href="{{ url('ecommerce/admin/orders') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-primary text-white mb-3 text-center">
                        <label>Total Products</label>
                        <h1>{{ $totalProducts }}</h1>
                        <a href="{{ url('ecommerce/admin/products') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-success text-white mb-3 text-center">
                        <label>Total Categories</label>
                        <h1>{{ $totalCategories }}</h1>
                        <a href="{{ url('ecommerce/admin/categories') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-warning text-white mb-3 text-center">
                        <label>Total Subcategories</label>
                        <h1>{{ $totalSubcategories }}</h1>
                        <a href="{{ url('ecommerce/admin/subcategories') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-danger text-white mb-3 text-center">
                        <label>Total Brands</label>
                        <h1>{{ $totalBrands }}</h1>
                        <a href="{{ url('ecommerce/admin/brands') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-primary text-white mb-3 text-center">
                        <label>Total Variants</label>
                        <h1>{{ $totalVariants }}</h1>
                        <a href="{{ url('ecommerce/admin/variants') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-success text-white mb-3 text-center">
                        <label>Total Colors</label>
                        <h1>{{ $totalColors }}</h1>
                        <a href="{{ url('ecommerce/admin/colors') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-warning text-white mb-3 text-center">
                        <label>Total Sizes</label>
                        <h1>{{ $totalSizes }}</h1>
                        <a href="{{ url('ecommerce/admin/sizes') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-danger text-white mb-3 text-center">
                        <label>Total Sliders</label>
                        <h1>{{ $totalSliders }}</h1>
                        <a href="{{ url('ecommerce/admin/sliders') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-primary text-white mb-3 text-center">
                        <label>All Users</label>
                        <h1>{{ $totalAllUsers }}</h1>
                        <a href="{{ url('ecommerce/admin/users') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-success text-white mb-3 text-center">
                        <label>Total Users</label>
                        <h1>{{ $totalUser }}</h1>
                        <a href="{{ url('ecommerce/admin/users') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-warning text-white mb-3 text-center">
                        <label>Total Admins</label>
                        <h1>{{ $totalAdmin }}</h1>
                        <a href="{{ url('ecommerce/admin/users') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>

                <div class="col-md-3 custom-3 col-6 col-sm-12">
                    <div class="card card-body bg-danger text-white mb-3 text-center">
                        <label>Total Contacts</label>
                        <h1>{{ $totalContacts }}</h1>
                        <a href="{{ url('ecommerce/admin/contacts') }}" class="btn btn-dark text-white">View</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
