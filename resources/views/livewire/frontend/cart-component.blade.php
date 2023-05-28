@push('title')
    <title>Cart</title>
@endpush

<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> Cart
                </div>
            </div>
        </div>
        <section class="mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table-responsive">
                            @if ($cart->count() > 0)
                                <table class="table shopping-summery text-center clean">
                                    <thead>
                                        <tr class="main-heading">
                                            <th scope="col">Image</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Subtotal</th>
                                            <th scope="col">Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($cart as $cartItem)
                                            @if ($cartItem->variant)
                                                <tr>
                                                    <td class="image product-thumbnail">
                                                        @if ($cartItem->variant->product->productImages)
                                                            <img src="{{ Storage::url($cartItem->variant->product->productImages[0]->image) }}"
                                                                alt="{{ $cartItem->variant->product->name }}">
                                                        @else
                                                            <img src=""
                                                                alt="{{ $cartItem->variant->product->name }}">
                                                        @endif
                                                    </td>
                                                    <td class="product-des product-name">
                                                        <h5 class="product-name">
                                                            <a
                                                                href="{{ url('collections/' . $cartItem->variant->product->category->slug . '/' . $cartItem->variant->product->subcategory->slug . '/' . $cartItem->variant->product->slug) }}">
                                                                {{ $cartItem->variant->product->name }}
                                                            </a>
                                                        </h5>

                                                        @if ($cartItem->variant->color)
                                                            <p class="font-xs">Color:
                                                                {{ $cartItem->variant->color->code }}</p>
                                                        @else
                                                            <p class="font-xs">Color: Mixed Color</p>
                                                        @endif

                                                        @if ($cartItem->variant->size)
                                                            <p class="font-xs">Size:
                                                                {{ $cartItem->variant->size->code }}</p>
                                                        @else
                                                            <p class="font-xs">Size: Free Size</p>
                                                        @endif

                                                        <p class="font-xs">Brand:
                                                            {{ $cartItem->variant->product->brand->name }}</p>
                                                    </td>
                                                    @if ($cartItem->variant->product->sale_price)
                                                        <td class="price" data-title="Price">
                                                            <span>${{ $cartItem->variant->product->sale_price }} </span>
                                                        </td>
                                                    @else
                                                        <td class="price" data-title="Price">
                                                            <span>${{ $cartItem->variant->product->regular_price }}
                                                            </span>
                                                        </td>
                                                    @endif

                                                    <td class="text-center" data-title="Stock">
                                                        <div class="detail-qty border radius  m-auto">
                                                            <a wire:loading.attr="disabled"
                                                                wire:click="decrementQuantity({{ $cartItem->id }})"
                                                                class="qty-down">
                                                                <i class="fi-rs-angle-small-down"></i>
                                                            </a>
                                                            <span wire:model="quantityCount" class="qty-val">
                                                                {{ $cartItem->quantity }}
                                                            </span>
                                                            <a wire:loading.attr="disabled"
                                                                wire:click="incrementQuantity({{ $cartItem->id }})"
                                                                class="qty-up">
                                                                <i class="fi-rs-angle-small-up"></i>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    @if ($cartItem->variant->product->sale_price)
                                                        <td class="text-right" data-title="Cart">
                                                            <span>${{ $cartItem->variant->product->sale_price * $cartItem->quantity }}</span>
                                                        </td>
                                                        @php
                                                            $totalPrice += $cartItem->variant->product->sale_price * $cartItem->quantity
                                                        @endphp
                                                    @else
                                                        <td class="text-right" data-title="Cart">
                                                            <span>${{ $cartItem->variant->product->regular_price * $cartItem->quantity }}</span>
                                                        </td>
                                                        @php
                                                            $totalPrice += $cartItem->variant->product->regular_price * $cartItem->quantity
                                                        @endphp
                                                    @endif
                                                    <td class="action" data-title="Remove">
                                                        <a wire:loading.attr="disabled"
                                                            wire:click="removeCartItem({{ $cartItem->id }})"
                                                            class="text-muted">
                                                            <i class="fi-rs-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endif
                                        @empty
                                        @endforelse
                                        <tr>
                                            <td colspan="6" class="text-end">
                                                <a wire:loading.attr="disabled" wire:click="clearAll"
                                                    class="text-muted">
                                                    <i class="fi-rs-cross-small"></i> Clear Cart</a>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                            <td></td>
                                        </tr> --}}
                                    </tbody>
                                </table>
                            @else
                                No Items in Cart
                            @endif
                        </div>
                        <div class="row mb-50 justify-content-end">
                            <div class="col-lg-6 col-md-12">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td style="text-align: center" class="cart_total_label">Cart Totals</td>
                                                <td style="text-align: center" class="cart_total_amount">
                                                    <strong>
                                                        <span
                                                            class="font-xl fw-900 text-brand">${{ $totalPrice }}</span>
                                                    </strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center">
                                                    <a class="btn" href="{{ url('shop') }}"><i
                                                            class="fi-rs-shopping-bag mr-10"></i>
                                                        Continue Shopping
                                                    </a>
                                                </td>
                                                <td style="text-align: center">
                                                    <a href="{{ url('checkout') }}" class="btn "> <i
                                                            class="fi-rs-box-alt mr-10"></i>
                                                        Proceed to CheckOut</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
