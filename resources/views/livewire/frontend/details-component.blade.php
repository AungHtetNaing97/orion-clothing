@push('title')
    <title>{{ $product->name }}</title>
@endpush

@push('style')
    <style>
        .color-variant {
            width: 1rem;
            height: 1rem;
            border-radius: 1rem;
            border: 0.1rem solid rgb(188, 187, 187);
        }

        #nproduct_brand {
            color: #90908e !important;
        }

        #nproduct_name {
            color: #1a1a1a;
        }

        .sale_price {
            font-size: 18px;
            font-weight: bold;
            color: #F15412;
        }

        .regular_price {
            text-decoration: line-through;
            color: #888;
            margin-left: 10px;
            font-size: 14px;
            font-weight: 500;
        }

        .addtowishlist {
            background: #fff none repeat scroll 0 0;
            border: 1px solid #e5e5e5;
            color: #333;
            border-radius: 4px;
            display: inline-block;
            height: 40px;
            line-height: 40px;
            position: relative;
            text-align: center;
            vertical-align: top;
            width: 40px;
            margin: 0 3px;
            -webkit-transition: all 0.5s ease-out 0s;
        }

        .addtowishlist:hover {
            background-color: #F15412;
        }

        .addtowishlist:hover i {
            color: white;
        }

        /* sku */
        .detail-info .product-meta {
            padding-top: 15px;
            border-top: none !important;
        }
    </style>
@endpush
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> <a href="{{ url('collections/' . $product->category->slug) }}"
                        rel="nofollow">{{ $product->category->name }}</a>
                    <span></span> <a
                        href="{{ url('collections/' . $product->category->slug . '/' . $product->subcategory->slug) }}"
                        rel="nofollow">{{ $product->subcategory->name }}</a>
                    <span></span> {{ $product->name }}
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9" wire:ignore>
                        <div class="product-detail accordion-detail">
                            <div class="row mb-50">
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-gallery">
                                        <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                                        <!-- MAIN SLIDES -->
                                        <div class="product-image-slider">
                                            @if ($product->productImages->count() > 0)
                                                @forelse ($product->productImages as $productImage)
                                                    <figure class="border-radius-10">
                                                        <img src="{{ Storage::url($productImage->image) }}"
                                                            alt="{{ $product->name }}">
                                                    </figure>
                                                @empty
                                                    No Images Available
                                                @endforelse
                                            @endif
                                        </div>
                                        <!-- THUMBNAILS -->
                                        <div class="slider-nav-thumbnails pl-15 pr-15">
                                            @if ($product->productImages->count() > 0)
                                                @forelse ($product->productImages as $productImage)
                                                    <div>
                                                        <img src="{{ Storage::url($productImage->image) }}"
                                                            alt="{{ $product->name }}">
                                                    </div>
                                                @empty
                                                    No Images Available
                                                @endforelse
                                            @endif
                                        </div>
                                    </div>
                                    <!-- End Gallery -->
                                </div>
                                <div class="col-md-6 col-sm-12 col-xs-12">
                                    <div class="detail-info">
                                        <h2 class="title-detail">{{ $product->name }}</h2>
                                        <div class="product-detail-rating">
                                            <div class="pro-details-brand">
                                                <span> Brands: <a
                                                        href="{{ url('brands/' . $product->brand->slug) }}">{{ $product->brand->name }}</a></span>
                                            </div>
                                        </div>
                                        <div class="clearfix product-price-cover">
                                            <div class="product-price primary-color float-left">
                                                @if ($product->sale_price)
                                                    <ins><span
                                                            class="text-brand">${{ $product->sale_price }}</span></ins>
                                                    <ins><span
                                                            class="old-price font-md ml-15">${{ $product->regular_price }}</span></ins>
                                                @else
                                                    <ins><span
                                                            class="text-brand">${{ $product->regular_price }}</span></ins>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                                        <div class="short-desc mb-30">
                                            <p>{{ $product->short_description }}</p>
                                        </div>
                                        @if ($variants->count() > 0)
                                            <div class="attr-detail attr-color mb-15">
                                                <ul class="list-filter color-filter">
                                                    @foreach ($variants as $variant)
                                                        <li
                                                            style="width: 4.5rem; margin: 0.25rem; box-shadow: 0.5rem 0.5rem 1rem rgb(243, 238, 238); border-radius: 1rem;">
                                                            <a wire:click="variantSelected({{ $variant->id }})">
                                                                @if ($variant->color)
                                                                    <span
                                                                        style="background-color: {{ $variant->color->code }};
                                                                            border: 0.1rem solid grey"></span>
                                                                @else
                                                                    <span
                                                                        style="display:inline; font-size: 0.75rem">Mixed
                                                                        Color</span>
                                                                @endif
                                                                @if ($variant->size)
                                                                    <span
                                                                        style="font-size: 0.75rem">{{ $variant->size->code }}</span>
                                                                @else
                                                                    <span
                                                                        style="display:inline; font-size: 0.75rem">Free
                                                                        Size</span>
                                                                @endif
                                                                <span style="font-size: 0.75rem"
                                                                    class="in-stock text-success ml-5">InStock:{{ $variant->quantity }}</span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                        @if (
                                            $variants->count() > 0 &&
                                                $variants->some(function ($variant) {
                                                    return $variant->quantity > 0;
                                                }))
                                            <div class="detail-extralink">
                                                <div class="detail-qty border radius">
                                                    <a wire:click="decrementQuantity" class="qty-down">
                                                        <i class="fi-rs-angle-small-down"></i>
                                                    </a>
                                                    <span wire:model="quantityCount"
                                                        class="qty-val">{{ $this->quantityCount }}</span>
                                                    <a wire:click="incrementQuantity" class="qty-up">
                                                        <i class="fi-rs-angle-small-up"></i>
                                                    </a>
                                                </div>
                                                <div class="product-extra-link2">
                                                    <button type="button" wire:click="addToCart"
                                                        class="button button-add-to-cart">Add to cart</button>
                                                    <button style="color: #F15412" type="button"
                                                        wire:click="addToWishlist({{ $product->id }})"
                                                        aria-label="Add to Wishlist"
                                                        class="addtowishlist action-btn hover-up">
                                                        <i class="fi-rs-heart"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @elseif (
                                            $variants->count() > 0 &&
                                                $variants->every(function ($variant) {
                                                    return $variant->quantity == 0;
                                                }))
                                            <p class="text-danger">Out of Stock</p>
                                            <div class="product-extra-link2">
                                                <button style="color: #F15412" type="button"
                                                    wire:click="addToWishlist({{ $product->id }})"
                                                    aria-label="Add to Wishlist"
                                                    class="addtowishlist action-btn hover-up">
                                                    <i class="fi-rs-heart"></i>
                                                </button>
                                            </div>
                                        @else
                                            <p class="text-danger">Out of Stock</p>
                                            <div class="product-extra-link2">
                                                <button style="color: #F15412" type="button"
                                                    wire:click="addToWishlist({{ $product->id }})"
                                                    aria-label="Add to Wishlist"
                                                    class="addtowishlist action-btn hover-up">
                                                    <i class="fi-rs-heart"></i>
                                                </button>
                                            </div>
                                        @endif
                                    </div>
                                    <!-- Detail Info -->
                                </div>
                            </div>
                            <div class="tab-style3">
                                <ul class="nav nav-tabs text-uppercase">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="Description-tab" data-bs-toggle="tab"
                                            href="#Description">Description</a>
                                    </li>
                                </ul>
                                <div class="tab-content shop_info_tab entry-main-content">
                                    <div class="tab-pane fade show active" id="Description">
                                        <div class="">
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-60">
                                <div class="col-12">
                                    <h3 class="section-title style-1 mb-30">Related Items</h3>
                                </div>
                                <div class="col-12">
                                    <div class="row related-products">
                                        @forelse ($rproducts as $rproduct)
                                            <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                                <div class="product-cart-wrap mb-30">
                                                    <div class="product-img-action-wrap">
                                                        <div class="product-img product-img-zoom">
                                                            @if ($rproduct->productImages->count() > 0)
                                                                <a
                                                                    href="{{ url('collections/' . $rproduct->category->slug . '/' . $rproduct->subcategory->slug . '/' . $rproduct->slug) }}">
                                                                    <img class="default-img"
                                                                        src="{{ Storage::url($rproduct->productImages[0]->image) }}"
                                                                        alt="{{ $rproduct->name }}">
                                                                    @if (isset($rproduct->productImages[1]))
                                                                        <img class="hover-img"
                                                                            src="{{ Storage::url($rproduct->productImages[1]->image) }}"
                                                                            alt="{{ $rproduct->name }}">
                                                                    @endif
                                                                </a>
                                                            @endif
                                                        </div>
                                                        <div class="product-action-1">
                                                            <a aria-label="Quick View" class="action-btn hover-up"
                                                                href="{{ url('collections/' . $rproduct->category->slug . '/' . $rproduct->subcategory->slug . '/' . $rproduct->slug) }}">
                                                                <i class="fi-rs-search"></i>
                                                            </a>
                                                            <button style="color: #F15412" type="button"
                                                                wire:click="addToWishlist({{ $rproduct->id }})"
                                                                aria-label="Add to Wishlist"
                                                                class="action-btn hover-up">
                                                                <i class="fi-rs-heart"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="product-content-wrap">
                                                        <div class="product-category">
                                                            <a
                                                                href="{{ url('brands/' . $rproduct->brand->slug) }}">{{ $rproduct->brand->name }}</a>
                                                        </div>
                                                        <h2><a
                                                                href="{{ url('collections/' . $rproduct->category->slug . '/' . $rproduct->subcategory->slug . '/' . $rproduct->slug) }}">{{ $rproduct->name }}</a>
                                                        </h2>
                                                        <div class="product-price">
                                                            @if ($rproduct->sale_price)
                                                                <span>${{ $rproduct->sale_price }} </span>
                                                                <span
                                                                    class="old-price">${{ $rproduct->regular_price }}</span>
                                                            @else
                                                                <span>${{ $rproduct->regular_price }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                            No Related Items Available
                                        @endforelse
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 primary-sidebar sticky-sidebar" wire:ignore>
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
                                    No New Items {{ $product->category->name }}
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
