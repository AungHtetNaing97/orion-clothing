@extends('admin.backend.layouts.signUp')

@section('title', 'Register')

@section('content')
    <div class="border border-3 py-4 px-5 bg-white">
        {{-- Global Setting htrr pee website name pyin yan --}}
        <div class="row">
            <div class="col-md-12 text-center">
                <h2>{{ $appSetting->name }}</h2>
                <p>Create an account to manage the admin panel</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('ecommerce.admin.adminRegister') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                        @error('name')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" />

                        @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" class="form-control" name="password" />

                        @error('password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password2" class="form-label">Confirm Password</label>
                        <input type="password" id="password2" class="form-control" name="password_confirmation" />
                        @error('password_confirmation')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>

                    <div class="mt-3">
                        <p class="text-center">Already have an account?
                            <a href="{{ route('ecommerce.admin.adminLoginPage') }}" class="btn btn-primary btn-sm">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
