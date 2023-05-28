@extends('admin.backend.layouts.admin')

@section('title', 'Edit User')

@section('page-title', 'Edit User')

@section('style')
    <style>
        .table-container {
            max-height: 100vh; /* Set the desired height for the table container */
            overflow-y: auto; /* Enable vertical scrollbar */
        }
    </style>
@endsection

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.users.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="shadow table-container py-3 px-4 mb-5 bg-white" style="border: 2px solid #ccc;">
        <form action="{{ url("ecommerce/admin/users/$user->id") }}" method="post">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input autofocus type="text" class="form-control" id="name" name="name"
                        value="{{ old('name', $user->name) }}">
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $user->email }}" readonly>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="text" class="form-control" id="password" name="password">
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                    placeholder="+1234567891 (10 to 15 digits)" pattern="^\+?\d{10,15}$"
                    value="{{ old('phone', $user->userDetail->phone ?? '') }}" title="Please enter a valid phone (+95)">

                    @error('phone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-4 mb-3">
                    <label for="postal_code" class="form-label">Postal / Zip Code</label>
                    <input type="number" class="form-control" id="postal_code" name="postal_code"
                        value="{{ old('postal_code', $user->userDetail->postal_code ?? '') }}">
                    @error('postal_code')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="col-md-9 mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="3">
                        {{ old('address', $user->userDetail->address ?? '') }}</textarea>
                    @error('address')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-md-3 mb-3">
                    <label for="role_as" class="form-label">Role</label>
                    <select name="role_as" class="form-select" id="role_as">
                        <option value="0" @selected(old('role_as', $user->role_as) == 0)>User</option>
                        <option value="1" @selected(old('role_as', $user->role_as) == 1)>Admin</option>
                    </select>
                    @error('role_as')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
