<footer class="main">
    <section class="footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-4 col-md-12 mb-md-3 mb-3">
                    <div class="widget-about font-md mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="/"><img
                                    src="{{ asset('storage/admin/backend/settings/' . $appSetting->image) }}"
                                    width="50" height="50" alt="{{ $appSetting->name ?? 'website name' }}"></a>
                        </div>
                        <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                        <p class="wow fadeIn animated">
                            <strong>Address: </strong>
                            <a target="_blank" href="{{ $appSetting->address_href ?? '' }}">
                                {{ $appSetting->address ?? 'website address' }}
                            </a>
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Phone: </strong>
                            <a href="tel:{{ $appSetting->phone_href ?? '' }}" target="_blank" style="color: #F15412">
                                {{ $appSetting->phone ?? 'website phone' }}
                            </a>
                        </p>
                        <p class="wow fadeIn animated">
                            <strong>Email: </strong>
                            <a href="mailto:{{ $appSetting->email_href ?? '' }}">{{ $appSetting->email ?? 'website email' }}</a>
                        </p>
                        <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-md-0">
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
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="widget-title wow fadeIn animated">Quick Links</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ url('shop') }}">Shop</a></li>
                        <li><a href="{{ url('collections') }}">Collections</a></li>
                        <li><a href="{{ url('brands') }}">Brands</a></li>
                        <li><a href="{{ url('contactUs') }}">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 col-6">
                    <h5 class="widget-title wow fadeIn animated">My Account</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li><a href="{{ url('profile') }}">Profile</a></li>
                        <li><a href="{{ url('orders') }}">Orders</a></li>
                        <li><a href="{{ url('wishlist') }}">Wishlist</a></li>
                        <li><a href="{{ url('cart') }}">Cart</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-3 col-12 mob-center">
                    <h5 class="widget-title wow fadeIn animated">Payments</h5>
                    <ul class="footer-list wow fadeIn animated">
                        <li>Cash on Delivery</li>
                        <li><img src="{{ asset('storage/frontend/assets/imgs/logo/paypal.png') }}" alt="PayPal"></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated mob-center">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <p class="text-center font-sm text-muted mb-0">
                &copy; <strong class="text-brand">{{ $appSetting->name ?? 'website name' }} </strong> All rights reserved
            </p>
        </div>
    </div>
</footer>
