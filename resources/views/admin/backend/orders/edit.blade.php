@extends('admin.backend.layouts.admin')

@section('title', 'Edit Order')

@section('style')
    <style>
        .table-container {
            max-height: 100vh;
            /* Set the desired height for the table container */
            overflow-y: auto;
            /* Enable vertical scrollbar */
        }
    </style>
@endsection

@section('page-title', 'Edit Order')

@section('button')
    <div class="ms-auto">
        <a href="{{ route('ecommerce.admin.orders.index') }}" class="btn btn-danger">Back</a>
    </div>
@endsection

@section('content')
    <div class="table-container shadow py-3 px-4 mb-5 bg-white" style="border: 2px solid #ccc;">
        <form action="{{ url("ecommerce/admin/orders/$order->id") }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">User Id</label>
                    <input type="text" class="form-control" value="{{ $order->user_id }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tracking Number</label>
                    <input type="text" class="form-control" value="{{ $order->tracking_no }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" value="{{ $order->fullname }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" value="{{ $order->email }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tel" class="form-control" value="{{ $order->phone }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Postal / Zip Code</label>
                    <input type="number" class="form-control" value="{{ $order->postal_code }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Address</label>
                    <textarea style="resize: none" class="form-control" readonly>{{ $order->address }}</textarea>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Payment Mode</label>
                    <input type="text" class="form-control" value="{{ $order->payment_mode }}" readonly>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label">Payment Id</label>
                    <input type="text" class="form-control" value="{{ $order->payment_id ?? '_ _ _ _ _' }}" readonly>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Additional Information</label>
                    <textarea style="resize: none" class="form-control" readonly>{{ $order->note }}</textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label" for="status_message">Status Message</label>
                    <select name="status_message" id="status_message" class="form-select">
                        <option value="in progress" @selected($order->status_message == 'in progress')>In Progress</option>
                        <option value="completed" @selected($order->status_message == 'completed')>Completed</option>
                        <option value="cancelled" @selected($order->status_message == 'cancelled')>Cancelled</option>
                        <option value="out for delivery" @selected($order->status_message == 'out for delivery')>
                            Out for Delivery
                        </option>
                    </select>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Update</button>
        </form>
    </div>
@endsection
