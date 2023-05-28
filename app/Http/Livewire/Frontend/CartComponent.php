<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;

class CartComponent extends Component
{
    public $cart, $totalPrice = 0;

    public function decrementQuantity($cartItemId) {
        $cartData = Cart::where('id', $cartItemId)->where('user_id', auth()->user()->id)->first();
        if($cartData) {
            if($cartData->variant->quantity >= $cartData->quantity && $cartData->quantity > 1) {
                $cartData->decrement('quantity');
                $this->dispatchBrowserEvent('success', [
                    'text' => 'Quantity decreased!'
                ]);
            } elseif($cartData->quantity == 1) {
                $this->dispatchBrowserEvent('info', [
                    'text' => 'Minimum quantity reached!'
                ]);
            } else {
                $this->dispatchBrowserEvent('info', [
                    'text' => 'Only ' . $cartData->variant->quantity . ' Quantity Available!'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('danger', [
                'text' => 'Something went wrong!'
            ]);
        }
    }
    public function incrementQuantity($cartItemId) {
        $cartData = Cart::where('id', $cartItemId)->where('user_id', auth()->user()->id)->first();
        if($cartData) {
            if($cartData->variant->quantity > $cartData->quantity) {
                $cartData->increment('quantity');
                $this->dispatchBrowserEvent('success', [
                    'text' => 'Quantity increased!'
                ]);
            } else {
                $this->dispatchBrowserEvent('info', [
                    'text' => 'Only ' . $cartData->variant->quantity . ' Quantity Available!'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('danger', [
                'text' => 'Something went wrong!'
            ]);
        }
    }

    public function removeCartItem($cartItemId) {
        $cartRemoveData = Cart::where('id', $cartItemId)->where('user_id', auth()->user()->id)->first();
        if($cartRemoveData) {
            $cartRemoveData->delete();
            $this->emit('cartAddedRemoved');
            $this->dispatchBrowserEvent('success', [
                'text' => 'Item removed from cart!'
            ]);
        } else {
            $this->dispatchBrowserEvent('danger', [
                'text' => 'Something went wrong!'
            ]);
        }
    }

    public function clearAll() {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();

        foreach ($cartItems as $cartItem) {
            $cartItem->delete();
        }

        $this->emit('cartAddedRemoved');
        $this->dispatchBrowserEvent('success', [
            'text' => 'Cart cleared!'
        ]);
    }

    public function render()
    {
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        return view('livewire.frontend.cart-component', [
            'cart' => $this->cart
        ]);
    }
}
