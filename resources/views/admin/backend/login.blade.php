@extends('admin.backend.layouts.signUp')

@section('title', 'Login')

@section('content')
    <div class="border border-3 pb-2 px-5 bg-white">
        <div class="row mt-1 text-center">
            @if (session('noAccess'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fa-sharp fa-solid fa-bolt"></i> {{ session('noAccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fa-solid fa-circle-check"></i> {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
        {{-- Global Setting htrr pee website name pyin yan --}}
        <div class="row mt-1">
            <div class="col-md-12 text-center mb-2">
                <h2>{{ $appSetting->name }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <form method="POST" action="{{ route('ecommerce.admin.adminLogin') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" autofocus />

                        @error('email')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" required id="password" class="form-control" name="password" />
                        @error('password')
                            <p class="text-danger mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>

                    <div class="mt-3">
                        <p class="text-center">Don't have an account?
                            <a href="{{ route('ecommerce.admin.adminRegisterPage') }}" class="btn btn-primary btn-sm">Register</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
