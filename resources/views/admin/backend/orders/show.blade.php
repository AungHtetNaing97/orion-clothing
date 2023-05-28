@extends('admin.backend.layouts.admin')

@section('title', 'Order Details')

@section('style')
    <style>
        h5 {
            padding: 0.2rem;
        }

        /* table */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        @media only screen and (max-width: 768px) {
            #user {
                margin-top: 1.5rem;
            }
        }

        .table-container {
            max-height: 100vh;
            overflow-x: auto;
            overflow-y: auto;
        }

        .table-container table {
            min-width: 800px;
        }
    </style>
@endsection

@section('content')
    <div class="table-container">
        <div class="row">
            <div class="shadow bg-white p-4">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-circle-check"></i> <strong>{{ session('message') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <h4 style="color: #F15412">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                        </div>
                        <div class="col-12 col-md-6">
                            <a href="{{ route('ecommerce.admin.orders.index') }}" style="font-size: 0.8rem; line-height:1.5"
                                class="btn btn-danger float-end m-1">
                                Back
                            </a>
                            <a href="{{ url('ecommerce/admin/orders/invoice/' . $order->id . '/generate') }}"
                                style="font-size: 0.8rem; line-height:1.5" class="btn btn-success float-end m-1">
                                <span class="fa fa-download"></span> Download Invoice
                            </a>
                            <a href="{{ url('ecommerce/admin/orders/invoice/' . $order->id) }}"
                                style="font-size: 0.8rem; line-height:1.5; color:black"
                                class="btn btn-warning float-end m-1" target="_blank">
                                <span class="fa fa-eye"></span> View Invoice
                            </a>
                            <a href="{{ url('ecommerce/admin/orders/invoice/' . $order->id . '/mail') }}"
                                style="font-size: 0.8rem; line-height:1.5; color:white" class="btn btn-dark float-end ms-1 me-1 mt-1">
                                <i class="fa-solid fa-envelope"></i> Send Invoice Via Mail
                            </a>
                        </div>
                    </div>
                </h4>
                <hr>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <h5>Order Details</h5>
                        <hr>
                        <h5>Tracking Number: {{ $order->tracking_no }}</h5>
                        <h5>Order Date: {{ $order->created_at->format('d-m-Y h:i A') }}</h5>
                        <h5>Payment Mode: {{ $order->payment_mode }}</h5>
                        @if ($order->note)
                            <h5>Additional Information: {{ $order->note }}</h5>
                        @else
                            <h5>Additional Information: _ _ _ _ _ </h5>
                        @endif
                        <h5 class="border p-2 text-primary">
                            Order Status Message: <span class="text-uppercase">{{ $order->status_message }}</span>
                        </h5>
                    </div>

                    <div class="col-12 col-md-6">
                        <h5 id="user">User Details</h5>
                        <hr>
                        <h5>Full Name: {{ $order->fullname }}</h5>
                        <h5>Email: {{ $order->email }}</h5>
                        <h5>Phone: {{ $order->phone }}</h5>
                        <h5>Address: {{ $order->address }}</h5>
                        <h5>Postal / Zip Code: {{ $order->postal_code }}</h5>
                    </div>

                    <br>
                    <h5 class="mt-3 mb-2">Order Items</h5>
                    <div class="table-responsive col-12">
                        <table style="border:1px solid black">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Image</th>
                                    <th>Item</th>
                                    <th>SKU</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $totalPrice = 0;
                                    $i = 0;
                                @endphp
                                @foreach ($order->orderItems as $orderItem)
                                    <tr>
                                        <td width="10%">{{ ++$i }}</td>
                                        <td width="10%">
                                            @if ($orderItem->variant->product->productImages)
                                                <img src="{{ Storage::url($orderItem->variant->product->productImages[0]->image) }}"
                                                    style="width: 50px; height: 50px"
                                                    alt="{{ $orderItem->variant->product->name }}">
                                            @else
                                                <img src="" style="width: 50px; height: 50px"
                                                    alt="{{ $orderItem->variant->product->name }}">
                                            @endif
                                        </td>
                                        <td>
                                            {{ $orderItem->variant->product->name }}
                                            @if ($orderItem->variant->color)
                                                <span> - Color:
                                                    {{ $orderItem->variant->color->code }}
                                                </span>
                                            @else
                                                <span> - Color:
                                                    mixed color
                                                </span>
                                            @endif
                                            @if ($orderItem->variant->size)
                                                <span> - Size:
                                                    {{ $orderItem->variant->size->code }}
                                                </span>
                                            @else
                                                <span> - Size:
                                                    free size
                                                </span>
                                            @endif
                                        </td>
                                        <td width="10%">{{ $orderItem->variant->SKU }}</td>
                                        <td width="10%">${{ $orderItem->price }}</td>
                                        <td width="10%">{{ $orderItem->quantity }}</td>
                                        <td width="10%" class="fw-bold">
                                            ${{ $orderItem->quantity * $orderItem->price }}</td>
                                        @php
                                            $totalPrice += $orderItem->quantity * $orderItem->price;
                                        @endphp
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="6" class="fw-bold">Total Amount: </td>
                                    <td colspan="1" class="fw-bold">${{ $totalPrice }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
