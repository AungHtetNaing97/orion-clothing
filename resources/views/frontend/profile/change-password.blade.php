@extends('frontend.layouts.app')

@section('titles', 'Change Password')

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> <a href="{{ url('profile') }}" rel="nofollow">Profile</a>
                    <span></span> Change Password
                </div>
            </div>
        </div>
        <section class="pt-25 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="contact-from-area padding-20-row-col wow FadeInUp">
                            <form action="{{ url('change-password') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label>Current Password</label>
                                    <input autofocus type="password" name="current_password" class="form-control" />
                                    @error('current_password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>New Password</label>
                                    <input type="password" name="password" class="form-control" />
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control" />
                                    {{-- @error('password_confirmation')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror --}}
                                </div>
                                <div class="mb-3 text-end">
                                    <button type="submit" class="btn btn-primary">Update Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
