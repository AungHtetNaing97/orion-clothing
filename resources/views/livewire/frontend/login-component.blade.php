@push('title')
    <title>Login</title>
@endpush
@push('style')
    <style>
        .pt-150 {
        padding-top: 5px !important;
        }
        .pb-150 {
        padding-bottom: 5px !important;
        }
    </style>
@endpush
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Login
                </div>
            </div>
        </div>
        @if (session('noAccess'))
            <div class="alert alert-info alert-dismissible fade show" role="alert" style="margin: 1rem auto; width: 50%">
                <i class="fa-solid fa-circle-info"></i> <strong>{{ session('noAccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-5 mb-2">
                                <div
                                    class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Login</h3>
                                        </div>
                                        <form wire:submit.prevent="login">
                                            <div class="form-group">
                                                <input type="text" wire:model="email" placeholder="Your Email" autofocus>
                                                @error('email')
                                                    <p class="text-danger h6">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="password" wire:model="password" placeholder="Password">
                                                @error('password')
                                                    <p class="text-danger h6">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up">Log in</button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">
                                            Don't have an account? <a href="{{ url('register') }}">Register now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1"></div>
                            <div class="col-lg-6">
                                <img src="{{ asset('storage/frontend/assets/imgs/login.png') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
