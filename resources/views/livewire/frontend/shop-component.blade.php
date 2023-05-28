@push('title')
    <title>Shop</title>
@endpush

@push('style')
    <style>
        .product-sidebar .single-post .image {
            height: 80px;
            width: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            overflow: hidden;
        }

        .regular_price {
            text-decoration: line-through;
            color: #888;
            margin-left: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .sale_price {
            font-size: 18px;
            font-weight: bold;
            color: #F15412;
        }

        .product-cart-wrap .product-action-1 button:last-child,
        .product-cart-wrap .product-action-1 a.action-btn:last-child {
            margin-right: 0.625rem;
        }

        #nproduct_brand {
            color: #90908e !important;
        }

        #nproduct_name {
            color: #1a1a1a;
        }

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

        #nproduct_widget {
            padding-bottom: 1rem !important;
        }
    </style>
@endpush

<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Shop
                </div>
            </div>
        </div>
        <section class="mt-25 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="shop-product-fillter">
                            <div class="totall-product">
                                <p> We have <strong class="text-brand">{{ $allproducts->count() }}</strong> items!
                                </p>
                            </div>
                            <div class="sort-by-product-area">
                                <div class="sort-by-cover">
                                    <div class="sort-by-product-wrap">
                                        <div class="sort-by">
                                            <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                        </div>
                                        <div class="sort-by-dropdown-wrap">
                                            <span> {{ $orderBy }} <i class="fi-rs-angle-small-down"></i></span>
                                        </div>
                                    </div>
                                    <div class="sort-by-dropdown">
                                        <ul>
                                            <li>
                                                <a class="{{ $orderBy == 'Latest' ? 'active' : '' }}" wire:click="changeOrderBy('Latest')">
                                                    Latest
                                                </a>
                                            </li>
                                            <li>
                                                <a class="{{ $orderBy == 'Price: Low to High' ? 'active' : '' }}" wire:click="changeOrderBy('Price: Low to High')">
                                                    Price: Low to High
                                                </a>
                                            </li>
                                            <li>
                                                <a class="{{ $orderBy == 'Price: High to Low' ? 'active' : '' }}" wire:click="changeOrderBy('Price: High to Low')">
                                                    Price: High to Low
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row product-grid-3">
                            @forelse ($products as $product)
                                <div class="col-lg-4 col-md-4 col-6 col-sm-6">
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
                                No Items Available
                            @endforelse
                        </div>
                        @if (!$products->isEmpty())
                            <div class="pagination-area mb-5 mb-lg-0" wire:ignore>
                                <div class="pagination">
                                    <div class="pagination-links">
                                        @if ($products->onFirstPage())
                                            <span class="disabled" aria-disabled="true">&laquo; Previous</span>
                                        @else
                                            <a href="{{ $products->previousPageUrl() }}" rel="prev">&laquo; Previous</a>
                                        @endif

                                        @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                            @if ($page == $products->currentPage())
                                                <span class="current">{{ $page }}</span>
                                            @else
                                                <a href="{{ $url }}">{{ $page }}</a>
                                            @endif
                                        @endforeach

                                        @if ($products->hasMorePages())
                                            <a href="{{ $products->nextPageUrl() }}" rel="next">Next &raquo;</a>
                                        @else
                                            <span class="disabled" aria-disabled="true">Next &raquo;</span>
                                        @endif
                                    </div>
                                    <div class="pagination-info">
                                        <p>Showing {{ $products->firstItem() }} to {{ $products->lastItem() }} of
                                            {{ $products->total() }} items</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar" wire:ignore>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-15 wow fadeIn animated">Category</h5>
                            <ul class="categories">
                                @forelse ($categories as $category)
                                    <li>
                                        <a href="{{ url('collections/' . $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li>No Categories Available</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="widget-category mb-30">
                            <h5 class="section-title style-1 mb-15 wow fadeIn animated">Subcategory</h5>
                            <ul class="categories">
                                @forelse ($subcategories as $subcategory)
                                    <li>
                                        <a
                                            href="{{ url('collections/' . $subcategory->category->slug . '/' . $subcategory->slug) }}">
                                            {{ $subcategory->name }}
                                        </a>
                                    </li>
                                @empty
                                    <li>No Subcategories Available</li>
                                @endforelse
                            </ul>
                        </div>
                        <!-- Product sidebar Widget -->
                        <div class="sidebar-widget product-sidebar p-30 bg-grey border-radius-10"
                            id="nproduct_widget">
                            <div class="widget-header position-relative mb-20 pb-10">
                                <h5 class="widget-title mb-10">New Items</h5>
                                <div class="bt-1 border-color-1"></div>
                            </div>
                            @forelse ($nproducts as $nproduct)
                                <div class="single-post clearfix">
                                    @if ($nproduct->productImages->count() > 0)
                                        <div class="image">
                                            <a
                                                href="{{ url('collections/' . $nproduct->category->slug . '/' . $nproduct->subcategory->slug . '/' . $nproduct->slug) }}">
                                                <img src="{{ Storage::url($nproduct->productImages[0]->image) }}">
                                            </a>
                                        </div>
                                    @else
                                        <div class="image">No Image Available</div>
                                    @endif
                                    <div class="content pt-10">
                                        <h5 class="mb-10">
                                            <a id="nproduct_brand"
                                                href="{{ url('brands/' . $nproduct->brand->slug) }}">
                                                {{ $nproduct->brand->name }}
                                            </a>
                                        </h5>
                                        <h5 class="mb-5">
                                            <a id="nproduct_name"
                                                href="{{ url('collections/' . $nproduct->category->slug . '/' . $nproduct->subcategory->slug . '/' . $nproduct->slug) }}">
                                                {{ $nproduct->name }}
                                            </a>
                                        </h5>
                                        @if ($nproduct->sale_price)
                                            <span class="sale_price">${{ $nproduct->sale_price }} </span>
                                            <span class="regular_price">${{ $nproduct->regular_price }}</span>
                                        @else
                                            <p class="price mb-0 mt-5">${{ $nproduct->regular_price }}</p>
                                        @endif
                                    </div>
                                </div>
                            @empty
                                <div class="single-post clearfix">
                                    No New Items
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
