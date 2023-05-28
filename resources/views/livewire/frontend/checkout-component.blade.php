@push('title')
    <title>Checkout</title>
@endpush
@push('style')
    <style>
        #cashOnDeliveryTab-tab,
        #onlinePayment-tab {
            border: 1px solid #000;
            border-radius: 8px;
            margin-bottom: 8px;
        }
    </style>
@endpush
<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> <a href="{{ url('cart') }}" rel="nofollow">Cart</a>
                    <span></span> Checkout
                </div>
            </div>
        </div>
        <section class="mt-25 mb-25">
            <div class="container">
                <div class="row">
                    @if ($cart->count() > 0)
                        <div class="col-lg-6">
                            <div class="mb-15">
                                <h4>Billing Details</h4>
                                <small>(You can edit your details in profile tab.)</small>
                            </div>
                            <div class="form-group">
                                <label for="fullname">Full Name</label>
                                <input type="text" wire:model.defer="fullname" id="fullname"
                                    placeholder="Full Name" readonly style="background-color: #d4d2d2">
                                @error('fullname')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" wire:model.defer="phone" id="phone"
                                    placeholder="Phone Number (+959977930021)" readonly style="background-color: #d4d2d2">
                                @error('phone')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" wire:model.defer="email" id="email"
                                    placeholder="Email Address" readonly style="background-color: #d4d2d2">
                                @error('email')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="postal_code">Postal / Zip Code</label>
                                <input type="number" wire:model.defer="postal_code" id="postal_code"
                                    placeholder="Postal / Zip Code (6-digit)" readonly style="background-color: #d4d2d2">
                                @error('postal_code')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Delivery Address</label>
                                <textarea rows="1" id="address" wire:model.defer="address" placeholder="Full Address"
                                readonly style="background-color: #d4d2d2"></textarea>
                                @error('address')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="note">Additional Information</label>
                                <textarea rows="1" id="note" wire:model.defer="note" placeholder="If this is an order for different address and person, please add detail information here."></textarea>
                                @error('note')
                                    <p class="text-danger mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="order_review">
                                <div class="mb-20">
                                    <h4>Your Order</h4>
                                </div>
                                <div class="table-responsive order_table text-center">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th colspan="2">Item</th>
                                                <th>Subtotal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cart as $cartItem)
                                                <tr>
                                                    <td class="image product-thumbnail">
                                                        <img src="{{ Storage::url($cartItem->variant->product->productImages[0]->image) }}"
                                                            alt="{{ $cartItem->variant->product->name }}">
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            <a
                                                                href="{{ url('collections/' . $cartItem->variant->product->category->slug . '/' . $cartItem->variant->product->subcategory->slug . '/' . $cartItem->variant->product->slug) }}">
                                                                {{ $cartItem->variant->product->name }}
                                                            </a>
                                                        </h5>
                                                        <span class="product-qty">x {{ $cartItem->quantity }}</span>
                                                    </td>
                                                    @if ($cartItem->variant->product->sale_price)
                                                        <td>
                                                            <span>
                                                                ${{ $cartItem->variant->product->sale_price * $cartItem->quantity }}
                                                            </span>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <span>
                                                                ${{ $cartItem->variant->product->regular_price * $cartItem->quantity }}
                                                            </span>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="2">Cart Totals</td>
                                                <td class="product-subtotal"><span
                                                        class="font-xl text-brand fw-900">${{ $totalProductAmount }}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="col-md-12 mb-3" wire:ignore>
                                    <div class="mb-20">
                                        <h5>Select Payment Mode: </h5>
                                    </div>
                                    <div class="d-flex align-items-start justify-content-center">
                                        <div class="nav col-md-6 flex-column nav-pills me-3" id="v-pills-tab"
                                            role="tablist" aria-orientation="vertical">
                                            <button wire:loading.attr="disabled" class="nav-link active fw-bold"
                                                id="cashOnDeliveryTab-tab" data-bs-toggle="pill"
                                                data-bs-target="#cashOnDeliveryTab" type="button" role="tab"
                                                aria-controls="cashOnDeliveryTab" aria-selected="true">
                                                Cash on Delivery
                                            </button>
                                            <button wire:loading.attr="disabled" class="nav-link fw-bold"
                                                id="onlinePayment-tab" data-bs-toggle="pill"
                                                data-bs-target="#onlinePayment" type="button" role="tab"
                                                aria-controls="onlinePayment" aria-selected="false">
                                                Online Payment
                                            </button>
                                        </div>
                                        <div class="tab-content col-md-6" id="v-pills-tabContent">
                                            <div class="tab-pane active show fade col-md-12" id="cashOnDeliveryTab"
                                                role="tabpanel" aria-labelledby="cashOnDeliveryTab-tab"
                                                tabindex="0">
                                                <h5>Cash on Delivery Mode</h5>
                                                <hr />
                                                <button type="button" wire:loading.attr="disabled"
                                                    wire:click="codOrder" class="btn btn-primary">
                                                    <span wire:loading.remove wire:target="codOrder">
                                                        Place Order (Cash on Delivery)
                                                    </span>
                                                    <span wire:loading wire:target="codOrder">
                                                        Placing Order
                                                    </span>
                                                </button>

                                            </div>
                                            <div class="tab-pane fade col-md-12" id="onlinePayment" role="tabpanel"
                                                aria-labelledby="onlinePayment-tab" tabindex="0">
                                                <h5>Online Payment Mode</h5>
                                                <hr />
                                                {{-- <button type="button" wire:loading.attr="disabled"
                                                    class="btn btn-warning">
                                                    Pay Now (Online Payment)
                                                </button> --}}
                                                <div>
                                                    <div id="paypal-button-container"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else
                        No Items in Cart
                    @endif
                </div>
            </div>
        </section>
    </main>
</div>

@push('script')
    <script
        src="https://www.paypal.com/sdk/js?client-id=AVsjLxCZw6AVGGM8sqgz9s3vYAWkxAbVXPc_Og2b9JhgFXHxPLk6tp1poTYch02bXqzi-csyPM226wRR&currency=USD">
    </script>
    <script>
        paypal.Buttons({
            onClick: function() {
                var noteValue = document.getElementById('note').value;
                if(noteValue == '') {
                    if (!document.getElementById('fullname').value ||
                        !document.getElementById('phone').value ||
                        !document.getElementById('email').value ||
                        !document.getElementById('postal_code').value ||
                        !document.getElementById('address').value) {
                        Livewire.emit('validationForAll');
                        return false;
                    } else {
                        @this.set('fullname', document.getElementById('fullname').value);
                        @this.set('phone', document.getElementById('phone').value);
                        @this.set('email', document.getElementById('email').value);
                        @this.set('postal_code', document.getElementById('postal_code').value);
                        @this.set('address', document.getElementById('address').value);
                    }
                } else {
                    if (!document.getElementById('fullname').value ||
                        !document.getElementById('phone').value ||
                        !document.getElementById('email').value ||
                        !document.getElementById('postal_code').value ||
                        !document.getElementById('address').value ||
                        !document.getElementById('note').value) {
                        Livewire.emit('validationForAll');
                        return false;
                    } else {
                        @this.set('fullname', document.getElementById('fullname').value);
                        @this.set('phone', document.getElementById('phone').value);
                        @this.set('email', document.getElementById('email').value);
                        @this.set('postal_code', document.getElementById('postal_code').value);
                        @this.set('address', document.getElementById('address').value);
                        @this.set('note', document.getElementById('note').value);
                    }
                }
            },
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: "{{ $this->totalProductAmount }}" // Can also reference a variable or function
                        }
                    }]
                });
            },

            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    if (transaction.status == "COMPLETED") {
                        Livewire.emit('transactionEmit', transaction.id);
                    }
                    // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                });
            },

            // style: {
            //     layout: 'horizontal',
            // },
        }).render('#paypal-button-container');
    </script>
@endpush
