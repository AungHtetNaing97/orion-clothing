<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Invoice #{{ $order->id }}</title>

    <style>
        html,
        body {
            margin: 10px;
            padding: 10px;
            font-family: sans-serif;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        span,
        label {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 0px !important;
        }

        table thead th {
            height: 28px;
            text-align: left;
            font-size: 16px;
            font-family: sans-serif;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 14px;
        }

        .heading {
            font-size: 24px;
            margin-top: 12px;
            margin-bottom: 12px;
            font-family: sans-serif;
        }

        .small-heading {
            font-size: 18px;
            font-family: sans-serif;
        }

        .total-heading {
            font-size: 18px;
            font-weight: 700;
            font-family: sans-serif;
        }

        .order-details tbody tr td:nth-child(1) {
            width: 20%;
        }

        .order-details tbody tr td:nth-child(3) {
            width: 20%;
        }

        .text-start {
            text-align: left;
        }

        .text-end {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .company-data span {
            margin-bottom: 4px;
            display: inline-block;
            font-family: sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .no-border {
            border: 1px solid #fff !important;
        }

        .bg-blue {
            background-color: #F15412;
            color: #fff;
        }

        .container {
            max-height: 90vh;
            /* Set the desired height for the table container */
            overflow-y: auto;
            /* Enable vertical scrollbar */
        }
    </style>
</head>

<body>
    <div class="container">
        <table class="order-details">
            <thead>
                <tr>
                    <th width="50%" colspan="2">
                        {{-- Need to use absolute path --}}
                        {{-- <img src="data:image/jpeg;base64,{{ base64_encode(file_get_contents(public_path('storage/admin/backend/settings/' . basename($appSetting->image)))) }}"
                        width="180" height="50" alt="{{ $appSetting->name ?? 'website name' }}"> --}}
                        <h2 class="text-start">{{ $appSetting->name }}</h2>
                    </th>
                    <th width="50%" colspan="2" class="text-end company-data">
                        <span>Invoice: #{{ $order->id }}</span> <br>
                        <span>Date: {{ date('d / m / Y') }}</span> <br>
                        <span>Email: {{ $appSetting->email ?? 'website email' }}</span> <br>
                        <span>Address: {{ $appSetting->address ?? 'website address' }}</span> <br>
                    </th>
                </tr>
                <tr class="bg-blue">
                    <th width="50%" colspan="2">Order Details</th>
                    <th width="50%" colspan="2">User Details</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i=0;
                @endphp
                <tr>
                    <td>Tracking Number:</td>
                    <td>{{ $order->tracking_no }}</td>

                    <td>Full Name:</td>
                    <td>{{ $order->fullname }}</td>
                </tr>
                <tr>
                    <td>Order Date:</td>
                    <td>{{ $order->created_at->format('d-m-Y h:i A') }}</td>

                    <td>Email:</td>
                    <td>{{ $order->email }}</td>
                </tr>
                <tr>
                    <td>Payment Mode:</td>
                    <td>{{ $order->payment_mode }}</td>

                    <td>Phone:</td>
                    <td>{{ $order->phone }}</td>
                </tr>
                <tr>
                    <td>Order Status:</td>
                    <td>{{ $order->status_message }}</td>

                    <td>Address:</td>
                    <td>{{ $order->address }}</td>
                </tr>
                <tr>
                    <td>Additional Information:</td>
                    <td>
                        @if ($order->note)
                            {{ $order->note }}
                        @else
                            _ _ _ _ _
                        @endif
                    </td>

                    <td>Postal / Zip Code:</td>
                    <td>{{ $order->postal_code }}</td>
                </tr>
            </tbody>
        </table>

        <table style="margin-top: 10px">
            <thead>
                <tr>
                    <th class="no-border text-start heading" colspan="6">
                        Order Items
                    </th>
                </tr>
                <tr class="bg-blue">
                    <th>No.</th>
                    <th>Item</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalPrice = 0;$j=0;
                @endphp
                @foreach ($order->orderItems as $orderItem)
                    <tr>
                        <td width="10%">{{ ++$j }}</td>
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
                        <td width="15%" class="fw-bold">
                            ${{ $orderItem->quantity * $orderItem->price }}
                        </td>
                        @php
                            $totalPrice += $orderItem->quantity * $orderItem->price;
                        @endphp
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="total-heading">Total Amount - <small>Inc. all vat/tax</small> :</td>
                    <td colspan="1" class="total-heading">${{ $totalPrice }}</td>
                </tr>
            </tbody>
        </table>

        <br>
        <p class="text-center">
            Thank you for shopping with {{ $appSetting->name ?? 'website name' }}!
        </p>
    </div>

</body>

</html>
