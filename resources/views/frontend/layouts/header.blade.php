<header class="header-area header-style-1 header-height-2">
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="/"><img src="{{ asset('storage/admin/backend/settings/' . $appSetting->image) }}" width="50"
                            height="50" alt="{{ $appSetting->name ?? 'website name' }}">
                    </a>
                </div>
                <div class="header-right">
                    <div class="search-style-1">
                        <form action="{{ url('search') }}" method="GET">
                            <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Search for items…">
                            <button type="submit"><i class="fi-rs-search"></i></button>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="header-action-icon-2">
                                <a href="{{ url('wishlist') }}">
                                    <img class="svgInject" alt="Surfside Media"
                                        src="{{ asset('storage/frontend/assets/imgs/theme/icons/icon-heart.svg') }}">
                                    <span class="pro-count blue">
                                        <livewire:frontend.wishlist-count />
                                    </span>
                                </a>
                            </div>
                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ url('cart') }}">
                                    <img alt="Surfside Media"
                                        src="{{ asset('storage/frontend/assets/imgs/theme/icons/icon-cart.svg') }}">
                                    <span class="pro-count blue">
                                        <livewire:frontend.cart-count />
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="/"><img src="{{ asset('storage/admin/backend/settings/' . $appSetting->image) }}"
                            alt="{{ $appSetting->name ?? 'website name' }}"></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                        <nav>
                            <ul>
                                <li>
                                    <a href="/" class="{{ Request::path() === '/' ? 'active' : '' }}">
                                        <i style="font-size: 16px" class="fa-solid fa-house"></i> Home
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('shop') }}"
                                        class="{{ Request::path() === 'shop' ? 'active' : '' }}">
                                        <i style="font-size: 16px" class="fa-solid fa-basket-shopping"></i> Shop
                                    </a>
                                </li>
                                <li class="position-static">
                                    <a href="{{ url('collections') }}"
                                        class="{{ Request::url() && strpos(Request::url(), 'collections') !== false ? 'active' : '' }}">
                                        <i style="font-size: 16px" class="fa-solid fa-list"></i> Collections <i class="fi-rs-angle-down"></i>
                                    </a>
                                    <ul class="mega-menu">
                                        @forelse ($gcategories as $category)
                                            <li class="sub-mega-menu sub-mega-menu-width-22">
                                                <a class="menu-title"
                                                    href="{{ url('collections/' . $category->slug) }}"
                                                    class="{{ Request::is('collections/' . $category->slug . '*') ? 'active' : '' }}">
                                                    {{ $category->name }}
                                                </a>
                                                <ul>
                                                    @forelse ($category->subcategories->where('status', 0) as $subcategory)
                                                        <li>
                                                            <a href="{{ url('collections/' . $subcategory->category->slug . '/' . $subcategory->slug) }}"
                                                                class="{{ Request::is('collections/' . $subcategory->category->slug . '/' . $subcategory->slug . '*') ? 'active' : '' }}">
                                                                {{ $subcategory->name }}
                                                            </a>
                                                        </li>
                                                    @empty
                                                        <li>No Subcategories Available</li>
                                                    @endforelse
                                                </ul>
                                            </li>
                                        @empty
                                            <li>No Categories Available</li>
                                        @endforelse
                                    </ul>
                                </li>
                                <li>
                                    <a href="{{ url('brands') }}"
                                        class="{{ Request::url() && strpos(Request::url(), 'brands') !== false ? 'active' : '' }}">
                                        <i style="font-size: 16px" class="fa-sharp fa-solid fa-check"></i> Brands
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ url('contactUs') }}"
                                        class="{{ Request::path() === 'contactUs' ? 'active' : '' }}">
                                        <i style="font-size: 16px" class="fa-solid fa-envelope"></i> Contact Us
                                    </a>
                                </li>
                                @auth
                                    <li><i style="font-size: 16px" class="fa-solid fa-user"></i> <a
                                            href="">{{ Auth::user()->name }}<i class="fi-rs-angle-down"></i></a>
                                        <ul class="sub-menu">
                                            <li>
                                                <a href="{{ url('profile') }}"
                                                    class="{{ Request::url() && strpos(Request::url(), 'profile') !== false ? 'active' : '' }}">
                                                    <i class="fa-solid fa-id-card"></i> Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('orders') }}"
                                                    class="{{ Request::url() && strpos(Request::url(), 'orders') !== false ? 'active' : '' }}">
                                                    <i class="fa-solid fa-sort"></i> Orders
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('wishlist') }}"
                                                    class="{{ Request::path() === 'wishlist' ? 'active' : '' }}">
                                                    <i class="fa-regular fa-heart"></i> Wishlist
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('cart') }}"
                                                    class="{{ Request::path() === 'cart' ? 'active' : '' }}">
                                                    <i class="fa-solid fa-cart-shopping"></i> Cart
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ url('logout') }}" method="post">
                                                    @csrf
                                                    <button type="submit">Logout</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @else
                                    <li>
                                        <i class="fa-solid fa-right-to-bracket"></i>
                                        <a href="{{ url('login') }}"
                                            class="{{ Request::path() === 'login' ? 'active' : '' }}">Login </a>
                                        /
                                        <a href="{{ url('register') }}"
                                            class="{{ Request::path() === 'register' ? 'active' : '' }}">Register</a>
                                    </li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-block">
                    <p>
                        <span>Toll Free</span><a href="tel:{{ $appSetting->phone_href ?? '' }}" target="_blank">
                            <i style="color: #F15412" class="fa-solid fa-mobile-screen"></i> {{ $appSetting->phone ?? 'website phone' }}
                        </a>
                    </p>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ url('wishlist') }}">
                                <img alt="Surfside Media"
                                    src="{{ asset('storage/frontend/assets/imgs/theme/icons/icon-heart.svg') }}">
                                <span class="pro-count white">
                                    <livewire:frontend.wishlist-count />
                                </span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ url('cart') }}">
                                <img alt="Surfside Media"
                                    src="{{ asset('storage/frontend/assets/imgs/theme/icons/icon-cart.svg') }}">
                                <span class="pro-count white">
                                    <livewire:frontend.cart-count />
                                </span>
                            </a>
                        </div>
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="/"><img src="{{ asset('storage/admin/backend/settings/' . $appSetting->image) }}"
                        alt="{{ $appSetting->name ?? 'website name' }}"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ url('search') }}" method="GET">
                    <input type="text" name="search" value="{{ Request::get('search') }}" placeholder="Search for items…">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children">
                            <a href="/" class="{{ Request::path() === '/' ? 'active' : '' }}">
                                <i class="fa-solid fa-house"></i> Home
                            </a>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ url('shop') }}" class="{{ Request::path() === 'shop' ? 'active' : '' }}">
                                <i class="fa-solid fa-basket-shopping"></i> Shop
                            </a>
                        </li>
                        <li class="menu-item-has-children">
                            <span class="menu-expand"></span>
                            <a href="{{ url('collections') }}"
                                class="{{ Request::url() && strpos(Request::url(), 'collections') !== false ? 'active' : '' }}">
                                <i class="fa-solid fa-list"></i> Collections
                            </a>
                            <ul class="dropdown">
                                @forelse ($gcategories as $category)
                                    <li class="menu-item-has-children">
                                        <span class="menu-expand"></span>
                                        <a href="{{ url('collections/' . $category->slug) }}"
                                            class="{{ Request::is('collections/' . $category->slug . '*') ? 'active' : '' }}">
                                            {{ $category->name }}
                                        </a>
                                        <ul class="dropdown">
                                            @forelse ($category->subcategories->where('status', 0) as $subcategory)
                                                <li>
                                                    <a href="{{ url('collections/' . $subcategory->category->slug . '/' . $subcategory->slug) }}"
                                                        class="{{ Request::is('collections/' . $subcategory->category->slug . '/' . $subcategory->slug . '*') ? 'active' : '' }}">
                                                        {{ $subcategory->name }}
                                                    </a>
                                                </li>
                                            @empty
                                                <li>No Subcategories Available</li>
                                            @endforelse
                                        </ul>
                                    </li>
                                @empty
                                    <li>No Categories Available</li>
                                @endforelse
                            </ul>
                        </li>
                        <li class="menu-item-has-children">
                            <a href="{{ url('brands') }}"
                                class="{{ Request::url() && strpos(Request::url(), 'brands') !== false ? 'active' : '' }}">
                                <i class="fa-sharp fa-solid fa-check"></i> Brands
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('contactUs') }}"
                                class="{{ Request::path() === 'contactUs' ? 'active' : '' }}">
                                <i style="font-size: 16px" class="fa-solid fa-envelope"></i> Contact Us
                            </a>
                        </li>
                        @auth
                            <li class="menu-item-has-children">
                                <a href="{{ url('profile') }}"
                                    class="{{ Request::path() === 'profile' ? 'active' : '' }}">
                                    <i class="fa-solid fa-id-card"></i> Profile
                                </a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('orders') }}"
                                    class="{{ Request::url() && strpos(Request::url(), 'orders') !== false ? 'active' : '' }}">
                                    <i class="fa-solid fa-sort"></i> Orders
                                </a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('wishlist') }}"
                                    class="{{ Request::path() === 'wishlist' ? 'active' : '' }}">
                                    <i class="fa-regular fa-heart"></i> Wishlist
                                </a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('cart') }}" class="{{ Request::path() === 'cart' ? 'active' : '' }}">
                                    <i class="fa-solid fa-cart-shopping"></i> Cart
                                </a>
                            </li>
                            <li class="menu-item-has-children">
                                <form action="{{ url('logout') }}" method="post">
                                    @csrf
                                    <button type="submit" style="padding: 10px">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="menu-item-has-children">
                                <a href="{{ url('login') }}" class="{{ Request::path() === 'login' ? 'active' : '' }}">
                                    <i class="fa-solid fa-right-to-bracket"></i> Login
                                </a>
                            </li>
                            <li class="menu-item-has-children">
                                <a href="{{ url('register') }}"
                                    class="{{ Request::path() === 'register' ? 'active' : '' }}">
                                    <i class="fa-solid fa-key"></i> Register
                                </a>
                            </li>
                        @endauth
                        <li class="menu-item-has-children">
                            <a href="tel:{{ $appSetting->phone_href ?? '' }}" target="_blank" style="color: #F15412">
                                <i class="fa-solid fa-mobile-screen"></i> {{ $appSetting->phone ?? 'website phone' }}
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-social-icon mt-20">
                <h5 class="mb-5 text-grey-4">Follow Us</h5>
                @if ($appSetting->facebook)
                    <a href="{{ $appSetting->facebook }}" target="_blank">
                        <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/icon-facebook.svg') }}" alt="Facebook">
                    </a>
                @endif
                @if ($appSetting->twitter)
                    <a href="{{ $appSetting->twitter }}" target="_blank">
                        <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/icon-twitter.svg') }}" alt="Twitter">
                    </a>
                @endif
                @if ($appSetting->instagram)
                    <a href="{{ $appSetting->instagram }}" target="_blank">
                        <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/icon-instagram.svg') }}" alt="Instagram">
                    </a>
                @endif
                @if ($appSetting->youtube)
                    <a href="{{ $appSetting->youtube }}" target="_blank">
                        <img src="{{ asset('storage/frontend/assets/imgs/theme/icons/icon-youtube.svg') }}" alt="Youtube">
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
