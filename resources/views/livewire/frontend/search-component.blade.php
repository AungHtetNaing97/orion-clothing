@push('title')
    <title>Search Results</title>
@endpush

@push('style')
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
@endpush

<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> {{ Request::get('search') }}
                </div>
            </div>
        </div>
        <section class="pt-25 pb-10">
            <div class="container">
                @if (session('message'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <i class="fa-solid fa-circle-check"></i> <strong>{{ session('message') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="row product-grid-4">
                            @forelse ($searchProducts as $product)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                @if ($product->productImages->count() > 0)
                                                    <a
                                                        href="{{ url('collections/' . $product->category->slug . '/' . $product->subcategory->slug . '/' . $product->slug) }}">
                                                        <img class="default-img"
                                                            src="{{ Storage::url($product->productImages[0]->image) }}"
                                                            alt="{{ $product->name }}">
                                                        @if (isset($product->productImages[1]))
                                                            <img class="hover-img"
                                                                src="{{ Storage::url($product->productImages[1]->image) }}"
                                                                alt="{{ $product->name }}">
                                                        @endif
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick View" class="action-btn hover-up"
                                                    href="{{ url('collections/' . $product->category->slug . '/' . $product->subcategory->slug . '/' . $product->slug) }}">
                                                    <i class="fi-rs-search"></i>
                                                </a>
                                                <button style="color: #F15412" type="button"
                                                    wire:click="addToWishlist({{ $product->id }})"
                                                    aria-label="Add to Wishlist" class="action-btn hover-up">
                                                    <i class="fi-rs-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a
                                                    href="{{ url('brands/' . $product->brand->slug) }}">{{ $product->brand->name }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ url('collections/' . $product->category->slug . '/' . $product->subcategory->slug . '/' . $product->slug) }}">{{ $product->name }}</a>
                                            </h2>
                                            <div class="product-price">
                                                @if ($product->sale_price)
                                                    <span>${{ $product->sale_price }} </span>
                                                    <span class="old-price">${{ $product->regular_price }}</span>
                                                @else
                                                    <span>${{ $product->regular_price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No Search Results Available for {{ Request::get('search') }}
                            @endforelse
                        </div>
                        @if (!$searchProducts->isEmpty())
                            <div class="pagination-area mb-5 mb-lg-0" wire:ignore>
                                <div class="pagination">
                                    <div class="pagination-links">
                                        {{ $searchProducts->appends(request()->input())->links() }}
                                    </div>
                                    <div class="pagination-info">
                                        <p>Showing {{ $searchProducts->firstItem() }} to
                                            {{ $searchProducts->lastItem() }} of {{ $searchProducts->total() }} items
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
