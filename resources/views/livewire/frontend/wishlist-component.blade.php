@push('title')
    <title>Wishlist</title>
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

        /* wishlist */
        .removefromwishlist {
            background-color: #f15412 !important;
            border: 1px solid transparent !important;
            color: #fff;
        }

        .removefromwishlist:hover {
            background-color: #e8f6ea !important;
            border: 1px solid transparent !important;
            color: #f15412 !important
        }

        .removefromwishlist:hover i {
            color: #f15412 !important;
        }
    </style>
@endpush
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Wishlist
                </div>
            </div>
        </div>
        <section class="pt-25 pb-10">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="row product-grid-4">
                            @forelse ($wishlists as $wishlist)
                                @if ($wishlist->product)
                                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                        <div class="product-cart-wrap mb-30">
                                            <div class="product-img-action-wrap">
                                                <div class="product-img product-img-zoom">
                                                    @if ($wishlist->product->productImages->count() > 0)
                                                        <a
                                                            href="{{ url('collections/' . $wishlist->product->category->slug . '/' . $wishlist->product->subcategory->slug . '/' . $wishlist->product->slug) }}">
                                                            <img class="default-img"
                                                                src="{{ Storage::url($wishlist->product->productImages[0]->image) }}"
                                                                alt="{{ $wishlist->product->name }}">
                                                            @if (isset($wishlist->product->productImages[1]))
                                                                <img class="hover-img"
                                                                    src="{{ Storage::url($wishlist->product->productImages[1]->image) }}"
                                                                    alt="{{ $wishlist->product->name }}">
                                                            @endif
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="product-action-1">
                                                    <a aria-label="Quick View" class="action-btn hover-up"
                                                        href="{{ url('collections/' . $wishlist->product->category->slug . '/' . $wishlist->product->subcategory->slug . '/' . $wishlist->product->slug) }}">
                                                        <i class="fi-rs-search"></i>
                                                    </a>
                                                    <button type="button" class="removefromwishlist"
                                                        wire:click="removeFromWishlist({{ $wishlist->id }})"
                                                        aria-label="Remove from Wishlist" class="action-btn hover-up">
                                                        <i class="fi-rs-heart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="product-content-wrap">
                                                <div class="product-category">
                                                    <a
                                                        href="{{ url('brands/' . $wishlist->product->brand->slug) }}">{{ $wishlist->product->brand->name }}</a>
                                                </div>
                                                <h2><a
                                                        href="{{ url('collections/' . $wishlist->product->category->slug . '/' . $wishlist->product->subcategory->slug . '/' . $wishlist->product->slug) }}">{{ $wishlist->product->name }}</a>
                                                </h2>
                                                <div class="product-price">
                                                    @if ($wishlist->product->sale_price)
                                                        <span>${{ $wishlist->product->sale_price }} </span>
                                                        <span
                                                            class="old-price">${{ $wishlist->product->regular_price }}</span>
                                                    @else
                                                        <span>${{ $wishlist->product->regular_price }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @empty
                                No Items Added in Wishlist
                            @endforelse
                        </div>
                        @if (!$wishlists->isEmpty())
                            <div class="pagination-area mb-5 mb-lg-0" wire:ignore>
                                <div class="pagination">
                                    <div class="pagination-links">
                                        @if ($wishlists->onFirstPage())
                                            <span class="disabled" aria-disabled="true">&laquo; Previous</span>
                                        @else
                                            <a href="{{ $wishlists->previousPageUrl() }}" rel="prev">&laquo;
                                                Previous</a>
                                        @endif

                                        @foreach ($wishlists->getUrlRange(1, $wishlists->lastPage()) as $page => $url)
                                            @if ($page == $wishlists->currentPage())
                                                <span class="current">{{ $page }}</span>
                                            @else
                                                <a href="{{ $url }}">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        @if ($wishlists->hasMorePages())
                                            <a href="{{ $wishlists->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                        @else
                                            <span class="disabled" aria-disabled="true">Next &raquo;</span>
                                        @endif
                                    </div>
                                    <div class="pagination-info">
                                        <p>Showing {{ $wishlists->firstItem() }} to {{ $wishlists->lastItem() }} of
                                            {{ $wishlists->total() }} items</p>
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
