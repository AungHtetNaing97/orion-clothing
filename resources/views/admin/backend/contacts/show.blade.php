@extends('admin.backend.layouts.admin')

@section('title', 'Contact Details')

@section('page-title', 'Contact Details')

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
        <a href="{{ route('ecommerce.admin.contacts.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container">
        <table class="table table-striped table-bordered bg-white shadow" style="border: 2px solid #ccc;">
            <tbody>
                <tr>
                    <td>id</td>
                    <td>{{ $contact->id }}</td>
                </tr>
                <tr>
                    <td>User Name</td>
                    <td>{{ $contact->user->name }}</td>
                </tr>
                <tr>
                    <td class="align-middle">Email</td>
                    <td>
                        <a href="{{ url('ecommerce/admin/users/' . $contact->user->id) }}" class="btn btn-info">
                            {{ $contact->user->email }}
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>Subject</td>
                    <td>{{ $contact->subject }}</td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td>{{ $contact->message }}</td>
                </tr>
                <tr>
                    <td>Created At</td>
                    <td>{{ $contact->created_at->format('d-m-Y h:i A') }}</td>
                </tr>
                <tr>
                    <td>Updated At</td>
                    <td>{{ $contact->updated_at->format('d-m-Y h:i A') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
