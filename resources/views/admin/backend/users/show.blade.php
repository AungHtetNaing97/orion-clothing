@extends('admin.backend.layouts.admin')

@section('title', 'User Details')

@section('style')
    <style>
        .table-container {
            max-height: 100vh; /* Set the desired height for the table container */
            overflow-y: auto; /* Enable vertical scrollbar */
        }
    </style>
@endsection

@section('page-title', 'User Details')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.users.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <td>Name</td>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>
                        @if (optional($user->userDetail)->phone)
                            {{ $user->userDetail->phone }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>
                        @if (optional($user->userDetail)->address)
                            {{ $user->userDetail->address }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Postal / Zip Code</td>
                    <td>
                        @if (optional($user->userDetail)->postal_code)
                            {{ $user->userDetail->postal_code }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Role</td>
                    <td>
                        @if ($user->role_as == '0')
                            User
                        @else
                            <p style="padding:0; margin:0; color:#f15421">Admin</p>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Orders</td>
                    <td>
                        @if ($user->orders)
                            {{ $user->orders->count() }}
                        @else
                            0
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $user->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $user->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
