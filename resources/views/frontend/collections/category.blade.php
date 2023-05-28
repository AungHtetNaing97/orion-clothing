@extends('frontend.layouts.app')

@section('titles', $category->name)

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

        @media only screen and (max-width: 400px) {
            #category {
                /* flex: 0 0 auto; */
                margin: auto;
                width: 80%;
            }
        }
    </style>
@endsection

@section('content')
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> <a href="{{ url('collections') }}" rel="nofollow">Collections</a>
                    <span></span> {{ $category->name }}
                </div>
            </div>
        </div>
        <section class="pt-25 pb-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="row product-grid-3">
                            @forelse ($subcategories as $subcategory)
                                <div id="category" class="col-lg-4 col-md-4 col-6 col-sm-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a
                                                    href="{{ url('collections/' . $subcategory->category->slug . '/' . $subcategory->slug) }}">
                                                    <img class="default-img" src="{{ Storage::url($subcategory->image) }}"
                                                        width="200" height="200" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a
                                                    href="{{ url('collections/' . $subcategory->category->slug . '/' . $subcategory->slug) }}">{{ $subcategory->name }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ url('collections/' . $subcategory->category->slug . '/' . $subcategory->slug) }}">{{ $subcategory->description }}</a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No Subcategories Available for {{ $category->name }}
                            @endforelse
                        </div>
                        @if (!$subcategories->isEmpty())
                            <div class="pagination-area mb-5 mb-lg-0" wire:ignore>
                                <div class="pagination">
                                    <div class="pagination-links">
                                        @if ($subcategories->onFirstPage())
                                            <span class="disabled" aria-disabled="true">&laquo; Previous</span>
                                        @else
                                            <a href="{{ $subcategories->previousPageUrl() }}" rel="prev">&laquo;
                                                Previous</a>
                                        @endif

                                        @foreach ($subcategories->getUrlRange(1, $subcategories->lastPage()) as $page => $url)
                                            @if ($page == $subcategories->currentPage())
                                                <span class="current">{{ $page }}</span>
                                            @else
                                                <a href="{{ $url }}">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        @if ($subcategories->hasMorePages())
                                            <a href="{{ $subcategories->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                        @else
                                            <span class="disabled" aria-disabled="true">Next &raquo;</span>
                                        @endif
                                    </div>
                                    <div class="pagination-info">
                                        <p>Showing {{ $subcategories->firstItem() }} to {{ $subcategories->lastItem() }} of
                                            {{ $subcategories->total() }} items</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
