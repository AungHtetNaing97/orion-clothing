@push('title')
    <title>Register</title>
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
                    <span></span> Register
                </div>
            </div>
        </div>
        <section class="pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="row">
                            <div class="col-lg-6 mb-2">
                                <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h3 class="mb-30">Create an Account</h3>
                                        </div>
                                        <form wire:submit.prevent="register">
                                            <div class="form-group">
                                                <input type="text" wire:model="name" placeholder="Name" autofocus>
                                                @error('name')
                                                    <p class="text-danger h6">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <input type="text" wire:model="email" placeholder="Email">
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
                                                <input type="password" wire:model="password_confirmation" placeholder="Confirm password">
                                                @error('password_confirmation')
                                                    <p class="text-danger h6">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up">
                                                    Submit &amp; Register
                                                </button>
                                            </div>
                                        </form>
                                        <div class="text-muted text-center">
                                            Already have an account? <a href="{{ url('login') }}">Login now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
