@push('title')
    <title>Contact Us</title>
@endpush

@push('style')
    <style>
        .estart {
            text-align: left;
        }
    </style>
@endpush
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Contact us
                </div>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fa-solid fa-circle-check"></i> <strong>{{ session('message') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <section class="pt-25 pb-25">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="contact-from-area padding-20-row-col wow FadeInUp">
                            <h3 class="mb-10 text-center">Drop Us a Line</h3>
                            <p class="text-muted mb-30 text-center font-sm">We will connect with you soon!</p>
                            <form class="contact-form-style text-center" wire:submit.prevent="contact">
                                <div class="row">
                                    <input type="hidden" wire:model="user_id">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input style="background-color: rgb(212, 210, 210)" placeholder="Full Name"
                                                wire:model="name" type="text" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input style="background-color: rgb(212, 210, 210)" placeholder="Your Email"
                                                type="email" wire:model="email" readonly>
                                        </div>
                                    </div>
                                    @if (optional(Auth::user()->userDetail)->phone)
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input style="background-color: rgb(212, 210, 210)"
                                                    placeholder="Your Phone" type="tel" wire:model="phone"
                                                    readonly>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-lg-6 col-md-6">
                                            <div class="input-style mb-20">
                                                <input placeholder="Your Phone (start with +95)" type="text" wire:model="phone"
                                                pattern="^\+?\d{10,15}$"
                                                title="Please enter a valid phone (+1234567891 (10 to 15 digits))">
                                                @error('phone')
                                                    <p class="estart text-danger h6">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input placeholder="Subject" type="text"
                                                wire:model="subject">
                                            @error('subject')
                                                <p class="estart text-danger h6">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="textarea-style mb-15">
                                            <textarea placeholder="Message" wire:model="message"></textarea>
                                            @error('message')
                                                <p class="estart text-danger h6">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <button class="submit submit-auto-width" type="submit">Send message</button>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
