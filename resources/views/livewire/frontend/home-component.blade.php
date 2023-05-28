@push('title')
    <title>{{ $appSetting->name ?? 'website name' }}</title>
@endpush
@push('style')
    <style>
        .fake-row>* {
            max-width: 50%;
        }

        @media only screen and (max-width: 499px) {

            .btn.btn-brush,
            .button.btn-brush {
                padding: 0px 80px 14px 65px;
            }
        }

        @media only screen and (max-width: 499px) {

            .btn.btn-brush,
            .button.btn-brush {
                background-image: none !important;
                padding: 10px;
                margin-bottom: 10px;
            }

            #shop-link {
                background-color: rgb(255, 249, 249);
                box-shadow: 1px 1px 1px rgb(214, 212, 212);
            }

            #shop-link:hover {
                background-color: #d0caca;
            }
        }
    </style>
@endpush
<div>
    <main class="main">
        <section class="home-slider position-relative">
            <div class="hero-slider-1 dot-style-1 dot-style-1-position-1">
                @if ($sliders->count() > 0)
                    @foreach ($sliders as $slider)
                        <div class="single-hero-slider single-animation-wrap">
                            <div class="container">
                                <div class="row fake-row align-items-center slider-animated-1">
                                    <div class="col-lg-5 col-md-6">
                                        <div class="hero-slider-content-2">
                                            <h4 class="animated">{{ $slider->top_title }}</h4>
                                            <h2 class="animated fw-900">{{ $slider->title }}</h2>
                                            <h1 class="animated fw-900 text-brand">{{ $slider->sub_title }}</h1>
                                            <p class="animated">{{ $slider->offer }}</p>
                                            <a id="shop-link" class="animated btn btn-brush btn-brush-3"
                                                href="{{ $slider->link }}"> Shop
                                                Now </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-6">
                                        <div class="single-slider-img single-slider-img-1">
                                            <img class="animated slider-1-1" src="{{ Storage::url($slider->image) }}"
                                                alt="{{ $slider->title }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="slider-arrow hero-slider-1-arrow"></div>
        </section>
        <section class="featured mt-40">
            <div class="container">
                <div class="row fake-row">
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-md-3 mb-lg-0 mb-5">
                        <div class="banner-features wow fadeIn animated hover-up card">
                            <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/feature-1.png') }}"
                                class="card-img-top" alt="Free Shipping">
                            <h4 class="bg-1">Free Shipping</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-md-3 mb-lg-0 mb-5">
                        <div class="banner-features wow fadeIn animated hover-up card">
                            <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/feature-2.png') }}"
                                class="card-img-top" alt="Online Order">
                            <h4 class="bg-3">Online Order</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-md-3 mb-lg-0 mb-5">
                        <div class="banner-features wow fadeIn animated hover-up card">
                            <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/feature-3.png') }}"
                                class="card-img-top" alt="Save Money">
                            <h4 class="bg-2">Save Money</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-md-3 mb-lg-0 mb-5">
                        <div class="banner-features wow fadeIn animated hover-up card">
                            <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/feature-4.png') }}"
                                class="card-img-top" alt="Promotions">
                            <h4 class="bg-4">Promotions</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-md-3 mb-lg-0 mb-5">
                        <div class="banner-features wow fadeIn animated hover-up card">
                            <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/feature-5.png') }}"
                                class="card-img-top" alt="Happy Sell">
                            <h4 class="bg-5">Happy Sell</h4>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 col-sm-6 mb-md-3 mb-lg-0 mb-5">
                        <div class="banner-features wow fadeIn animated hover-up card">
                            <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/feature-6.png') }}"
                                class="card-img-top" alt="24/7 Support">
                            <h4 class="bg-6">24/7 Support</h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section style="padding-top: 25px;" class="mt-10 product-tabs position-relative wow fadeIn animated">
            <div class="container">
                <div class="tab-header">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item mb-5" wire:ignore role="presentation">
                            <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab"
                                data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one"
                                aria-selected="true">Featured</button>
                        </li>
                        <li class="nav-item mb-5" wire:ignore role="presentation">
                            <button class="nav-link" id="nav-tab-two" data-bs-toggle="tab" data-bs-target="#tab-two"
                                type="button" role="tab" aria-controls="tab-two"
                                aria-selected="false">Popular</button>
                        </li>
                        <li class="nav-item mb-5" wire:ignore role="presentation">
                            <button class="nav-link" id="nav-tab-three" data-bs-toggle="tab" data-bs-target="#tab-three"
                                type="button" role="tab" aria-controls="tab-three" aria-selected="false">New
                                Arrivals</button>
                        </li>
                    </ul>
                    <a href="{{ url('shop') }}" class="view-more d-none d-md-flex">
                        View More<i class="fi-rs-angle-double-small-right"></i>
                    </a>
                </div>
                <!--End nav-tabs-->
                <div class="tab-content wow fadeIn animated" id="myTabContent" wire:ignore>
                    <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                        <div class="row fake-row product-grid-4">
                            @forelse ($fproducts as $fproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                @if ($fproduct->productImages->count() > 0)
                                                    <a
                                                        href="{{ url('collections/' . $fproduct->category->slug . '/' . $fproduct->subcategory->slug . '/' . $fproduct->slug) }}">
                                                        <img class="default-img"
                                                            src="{{ Storage::url($fproduct->productImages[0]->image) }}"
                                                            alt="{{ $fproduct->name }}">
                                                        @if (isset($fproduct->productImages[1]))
                                                            <img class="hover-img"
                                                                src="{{ Storage::url($fproduct->productImages[1]->image) }}"
                                                                alt="{{ $fproduct->name }}">
                                                        @endif
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick View" class="action-btn hover-up"
                                                    href="{{ url('collections/' . $fproduct->category->slug . '/' . $fproduct->subcategory->slug . '/' . $fproduct->slug) }}">
                                                    <i class="fi-rs-search"></i>
                                                </a>
                                                <button style="color: #F15412" type="button"
                                                    wire:click="addToWishlist({{ $fproduct->id }})"
                                                    aria-label="Add to Wishlist" class="action-btn hover-up">
                                                    <i class="fi-rs-heart"></i>
                                                </button>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Featured</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a
                                                    href="{{ url('brands/' . $fproduct->brand->slug) }}">{{ $fproduct->brand->name }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ url('collections/' . $fproduct->category->slug . '/' . $fproduct->subcategory->slug . '/' . $fproduct->slug) }}">{{ $fproduct->name }}</a>
                                            </h2>
                                            <div class="product-price">
                                                @if ($fproduct->sale_price)
                                                    <span>${{ $fproduct->sale_price }} </span>
                                                    <span class="old-price">${{ $fproduct->regular_price }}</span>
                                                @else
                                                    <span>${{ $fproduct->regular_price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No Featured Items Available
                            @endforelse
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab one (Featured)-->
                    <div class="tab-pane fade" id="tab-two" role="tabpanel" aria-labelledby="tab-two">
                        <div class="row fake-row product-grid-4">
                            @forelse ($tproducts as $tproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                @if ($tproduct->productImages->count() > 0)
                                                    <a
                                                        href="{{ url('collections/' . $tproduct->category->slug . '/' . $tproduct->subcategory->slug . '/' . $tproduct->slug) }}">
                                                        <img class="default-img"
                                                            src="{{ Storage::url($tproduct->productImages[0]->image) }}"
                                                            alt="{{ $tproduct->name }}">
                                                        @if (isset($tproduct->productImages[1]))
                                                            <img class="hover-img"
                                                                src="{{ Storage::url($tproduct->productImages[1]->image) }}"
                                                                alt="{{ $tproduct->name }}">
                                                        @endif
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick View" class="action-btn hover-up"
                                                    href="{{ url('collections/' . $tproduct->category->slug . '/' . $tproduct->subcategory->slug . '/' . $tproduct->slug) }}">
                                                    <i class="fi-rs-search"></i>
                                                </a>
                                                <button style="color: #F15412" type="button"
                                                    wire:click="addToWishlist({{ $tproduct->id }})"
                                                    aria-label="Add to Wishlist" class="action-btn hover-up">
                                                    <i class="fi-rs-heart"></i>
                                                </button>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">Popular</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a
                                                    href="{{ url('brands/' . $tproduct->brand->slug) }}">{{ $tproduct->brand->name }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ url('collections/' . $tproduct->category->slug . '/' . $tproduct->subcategory->slug . '/' . $tproduct->slug) }}">{{ $tproduct->name }}</a>
                                            </h2>
                                            <div class="product-price">
                                                @if ($tproduct->sale_price)
                                                    <span>${{ $tproduct->sale_price }} </span>
                                                    <span class="old-price">${{ $tproduct->regular_price }}</span>
                                                @else
                                                    <span>${{ $tproduct->regular_price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No Popular Items Available
                            @endforelse
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab two (Popular)-->
                    <div class="tab-pane fade" id="tab-three" role="tabpanel" aria-labelledby="tab-three">
                        <div class="row fake-row product-grid-4">
                            @forelse ($nproducts as $nproduct)
                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-6 col-6">
                                    <div class="product-cart-wrap mb-30">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                @if ($nproduct->productImages->count() > 0)
                                                    <a
                                                        href="{{ url('collections/' . $nproduct->category->slug . '/' . $nproduct->subcategory->slug . '/' . $nproduct->slug) }}">
                                                        <img class="default-img"
                                                            src="{{ Storage::url($nproduct->productImages[0]->image) }}"
                                                            alt="{{ $nproduct->name }}">
                                                        @if (isset($nproduct->productImages[1]))
                                                            <img class="hover-img"
                                                                src="{{ Storage::url($nproduct->productImages[1]->image) }}"
                                                                alt="{{ $nproduct->name }}">
                                                        @endif
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick View" class="action-btn hover-up"
                                                    href="{{ url('collections/' . $nproduct->category->slug . '/' . $nproduct->subcategory->slug . '/' . $nproduct->slug) }}">
                                                    <i class="fi-rs-search"></i>
                                                </a>
                                                <button style="color: #F15412" type="button"
                                                    wire:click="addToWishlist({{ $nproduct->id }})"
                                                    aria-label="Add to Wishlist" class="action-btn hover-up">
                                                    <i class="fi-rs-heart"></i>
                                                </button>
                                            </div>
                                            <div class="product-badges product-badges-position product-badges-mrg">
                                                <span class="hot">New</span>
                                            </div>
                                        </div>
                                        <div class="product-content-wrap">
                                            <div class="product-category">
                                                <a
                                                    href="{{ url('brands/' . $tproduct->brand->slug) }}">{{ $nproduct->brand->name }}</a>
                                            </div>
                                            <h2><a
                                                    href="{{ url('collections/' . $nproduct->category->slug . '/' . $nproduct->subcategory->slug . '/' . $nproduct->slug) }}">{{ $nproduct->name }}</a>
                                            </h2>
                                            <div class="product-price">
                                                @if ($nproduct->sale_price)
                                                    <span>${{ $nproduct->sale_price }} </span>
                                                    <span class="old-price">${{ $nproduct->regular_price }}</span>
                                                @else
                                                    <span>${{ $nproduct->regular_price }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                No New Items Available
                            @endforelse
                        </div>
                        <!--End product-grid-4-->
                    </div>
                    <!--En tab three (New added)-->
                </div>
                <!--End tab-content-->
            </div>
        </section>
        <section class="popular-categories mb-25">
            <div class="container wow fadeIn animated">
                <h3 class="section-title mb-20 mt-10"><span>Subcategories</span></h3>
                <div class="carausel-6-columns-cover position-relative">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow" id="carausel-6-columns-arrows">
                    </div>
                    <div class="carausel-6-columns" id="carausel-6-columns">
                        @forelse ($subcategories as $subcategory)
                            <div class="card-1">
                                @if ($subcategory->image)
                                    <figure class="img-hover-scale overflow-hidden">
                                        <a
                                            href="{{ url('collections' . '/' . $subcategory->category->slug . '/' . $subcategory->slug) }}">
                                            <img src="{{ Storage::url($subcategory->image) }}"
                                                alt="{{ $subcategory->name }}">
                                        </a>
                                    </figure>
                                @endif
                                <h5><a
                                        href="{{ url('collections' . '/' . $subcategory->category->slug . '/' . $subcategory->slug) }}">{{ $subcategory->name }}</a>
                                </h5>
                            </div>
                        @empty
                            No Available Subcategories
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding">
            <div class="container">
                <h3 class="section-title mb-20 wow fadeIn animated"><span>Brands</span></h3>
                <div class="carausel-6-columns-cover position-relative wow fadeIn animated">
                    <div class="slider-arrow slider-arrow-2 carausel-6-columns-arrow"
                        id="carausel-6-columns-3-arrows">
                    </div>
                    <div style="color: #c7c7c7" class="carausel-6-columns text-center" id="carausel-6-columns-3">
                        @forelse ($brands as $brand)
                            <div class="brand-logo">
                                <a href="{{ url('brands/' . $brand->slug) }}">
                                    <img class="img-grey-hover" src="{{ Storage::url($brand->image) }}"
                                        alt="{{ $brand->name }}">
                                </a>
                            </div>
                        @empty
                            No Available Brands
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
