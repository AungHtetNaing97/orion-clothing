@extends('frontend.layouts.app')

@section('titles', 'Orders List')

@section('styles')
    <style>
        /* Pagination */
        .pagination {
            display: flex;
            flex-direction: column;
        }

        .pagination-info {
            text-align: left;
            margin-top: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .pagination-links {
            display: flex;
            justify-content: left;
        }

        .pagination-links a,
        .pagination-links span {
            padding: 5px 10px;
            margin-right: 5px;
            color: #000;
            border: 1px solid #ccc;
            text-decoration: none;
        }

        .pagination-links a:hover {
            background-color: #f5f5f5;
        }

        .pagination-links .current {
            padding: 5px 10px;
            margin-right: 5px;
            color: #fff;
            background-color: #000;
            border: 1px solid #000;
        }

        .pagination-links .disabled {
            padding: 5px 10px;
            margin-right: 5px;
            color: #ccc;
            border: 1px solid #ccc;
            cursor: not-allowed;
        }

        @media only screen and (max-width: 576px) {
            .pagination-info {
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="shadow bg-white p-3">
                        <div class="row mb-3 text-center">
                            @if (session('message'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <i class="fa-solid fa-triangle-exclamation"></i> {{ session('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                        </div>
                        @if ($orders->count() > 0)
                            <h4 class="mb-4">Orders List</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" style="border: 1px solid black">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Tracking Number</th>
                                            <th>Username</th>
                                            <th>Payment Mode</th>
                                            <th>Order Date</th>
                                            <th>Status Message</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = ($orders->currentPage() - 1) * $orders->perPage();
                                        @endphp
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $order->tracking_no }}</td>
                                                <td>{{ $order->fullname }}</td>
                                                <td>{{ $order->payment_mode }}</td>
                                                <td>{{ $order->created_at->format('d-m-Y h:i A') }}</td>
                                                <td>{{ $order->status_message }}</td>
                                                <td>
                                                    <a href="{{ url('orders/' . $order->id) }}"
                                                        class="btn btn-primary btn-sm" style="font-size: 0.8rem">View</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @if (!$orders->isEmpty())
                                    <div class="pagination-area mb-5 mb-lg-0" wire:ignore>
                                        <div class="pagination">
                                            <div class="pagination-links">
                                                @if ($orders->onFirstPage())
                                                    <span class="disabled" aria-disabled="true">&laquo; Previous</span>
                                                @else
                                                    <a href="{{ $orders->previousPageUrl() }}" rel="prev">&laquo;
                                                        Previous</a>
                                                @endif

                                                @foreach ($orders->getUrlRange(1, $orders->lastPage()) as $page => $url)
                                                    @if ($page == $orders->currentPage())
                                                        <span class="current">{{ $page }}</span>
                                                    @else
                                                        <a href="{{ $url }}">{{ $page }}</a>
                                                    @endif
                                                @endforeach

                                                @if ($orders->hasMorePages())
                                                    <a href="{{ $orders->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                                @else
                                                    <span class="disabled" aria-disabled="true">Next &raquo;</span>
                                                @endif
                                            </div>
                                            <div class="pagination-info">
                                                <p>Showing {{ $orders->firstItem() }} to {{ $orders->lastItem() }} of
                                                    {{ $orders->total() }} items</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @else
                            No Orders Available
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
