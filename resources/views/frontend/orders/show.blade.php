@extends('frontend.layouts.app')

@section('titles', 'Order Details')

@section('styles')
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
    </style>
@endsection

@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-4">
                        <h4 style="color: #F15412">
                            <i class="fa fa-shopping-cart text-dark"></i> My Order Details
                            <a href="{{ url('orders') }}" style="font-size: 0.8rem; line-height:1.5"
                                class="btn btn-sm float-end">Back</a>
                        </h4>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
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

                            <div class="col-md-6">
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
                            <div class="table-responsive">
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
        </div>
    </div>
@endsection
