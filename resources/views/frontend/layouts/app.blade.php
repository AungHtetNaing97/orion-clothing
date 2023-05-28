<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    @stack('title')
    <title>@yield('titles')</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="shortcut icon" href="{{ asset('storage/frontend/assets/imgs/logo/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('storage/frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('storage/frontend/assets/css/custom.css') }}">

    {{-- fontawesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- toastify --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    @livewireStyles
    @stack('style')
    @yield('styles')
    <style>
        .header-middle-ptb-1 {
            padding: 15px 0 0 0;
        }

        button[type='submit'] {
            padding: 12px 15px;
        }

        .mobile-menu a.active {
            color: #F15412 !important;
        }

        .main-menu>nav>ul>li ul.sub-menu li a i {
            font-size: 15px;
            float: none;
            position: relative;
            top: 0;
        }

        @media only screen and (max-width: 480px) {
            .logo.logo-width-1 a img {
                min-width: 150px;
                width: 150px;
            }
        }

        @media only screen and (max-width: 330px) {
            .logo.logo-width-1 a img {
                min-width: 100px;
                width: 100px;
            }
        }

        .mobile-header-wrapper-style .mobile-header-wrapper-inner .mobile-header-content-area {
            padding: 10px 30px 10px;
        }

        @media only screen and (max-width: 768px) {
            .mob-center {
                text-align: center !important;
            }

            .mob-center p {
                text-align: center !important;
            }
        }
    </style>
</head>

<body>
    {{-- header is here --}}
    @include('frontend.layouts.header')

    {{-- content is here --}}
    @yield('content')

    {{-- footer is here --}}
    @include('frontend.layouts.footer')

    <!-- Vendor JS-->
    <script src="{{ asset('storage/frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/slick.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/wow.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/jquery-ui.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/magnific-popup.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/waypoints.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/counterup.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/images-loaded.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/isotope.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/scrollup.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
    <!-- Template  JS -->
    <script src="{{ asset('storage/frontend/assets/js/main.js?v=3.3') }}"></script>
    <script src="{{ asset('storage/frontend/assets/js/shop.js?v=3.3') }}"></script>

    {{-- toastify --}}
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
    @livewireScripts
    @stack('script')
    @yield('scripts')
    @if (session('info'))
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                var eventData = {
                    text: '{{ session('info') }}'
                };
                var event = new CustomEvent('info', {
                    detail: eventData
                });
                window.dispatchEvent(event);
            });
        </script>
    @endif

    <script>
        window.addEventListener('info', event => {
            Toastify({
                text: event.detail.text,
                duration: 3000,
                newWindow: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    fontSize: "1rem",
                    background: "linear-gradient(to right, #00aaff, #0055ff)"
                },
                onClick: function() {} // Callback after click
            }).showToast();
        })
        window.addEventListener('success', event => {
            Toastify({
                text: event.detail.text,
                duration: 3000,
                newWindow: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    fontSize: "1rem",
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function() {} // Callback after click
            }).showToast();
        })
        window.addEventListener('warning', event => {
            Toastify({
                text: event.detail.text,
                duration: 3000,
                newWindow: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    fontSize: "1rem",
                    background: "linear-gradient(to right, #000000, #000000)"
                },
                onClick: function() {} // Callback after click
            }).showToast();
        })
        window.addEventListener('danger', event => {
            Toastify({
                text: event.detail.text,
                duration: 3000,
                newWindow: true,
                gravity: "top", // `top` or `bottom`
                position: "center", // `left`, `center` or `right`
                stopOnFocus: true, // Prevents dismissing of toast on hover
                style: {
                    fontSize: "1rem",
                    background: "linear-gradient(to right, #FF0000, #B30000)"
                },
                onClick: function() {} // Callback after click
            }).showToast();
        })
    </script>
</body>

</html>
