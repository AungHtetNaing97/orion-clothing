@extends('frontend.layouts.app')

@section('titles', 'Profile')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Profile
                </div>
            </div>
        </div>
        {{-- @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i> <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif --}}
        <section class="pt-25 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="contact-from-area padding-20-row-col wow FadeInUp">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <a href="{{ url('change-password') }}" class="btn btn-secondary float-end">Change Password ?</a>
                                </div>
                            </div>
                            <form action="{{ url('profile') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="name">Name</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ Auth::user()->name }}" class="form-control">
                                            @error('name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Email Address</label>
                                            <input type="text" readonly value="{{ Auth::user()->email }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="phone">Phone Number</label>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="+1234567891 (10 to 15 digits)" pattern="^\+?\d{10,15}$"
                                                value="{{ old('phone', Auth::user()->userDetail->phone ?? '') }}"
                                                title="Please enter a valid phone (+95)">

                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="postal_code">Postal / Zip Code</label>
                                            <input type="number" class="form-control" id="postal_code" name="postal_code"
                                                value="{{ old('postal_code', Auth::user()->userDetail->postal_code ?? '') }}">
                                            @error('postal_code')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control" rows="3">
                                                {{ old('address', Auth::user()->userDetail->address ?? '') }}</textarea>
                                            @error('address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-between">
                                        <button type="submit" name="redirect" value="profile" class="btn btn-primary">Save</button>
                                        <button type="submit" name="redirect" value="checkout" class="btn btn-info">Save & Checkout</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function checkScreenWidth() {
                if ($(window).width() < 300) {
                    $('.btn').addClass('btn-sm');
                } else {
                    $('.btn').removeClass('btn-sm');
                }
            }
            // Check screen width on page load
            checkScreenWidth();
            // Check screen width on window resize
            $(window).resize(function() {
                checkScreenWidth();
            });
        });
    </script>
@endsection
