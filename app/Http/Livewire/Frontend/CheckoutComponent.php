<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItem;
use Illuminate\Support\Str;

class CheckoutComponent extends Component
{
    public $cart, $totalProductAmount = 0;

    public $fullname, $email, $phone, $postal_code, $address, $note, $payment_mode = null, $payment_id = null;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];

    public function paidOnlineOrder($transactionId) {
        $this->payment_id = $transactionId;
        $this->payment_mode = 'Paid by Paypal';

        $codOrder = $this->placeOrder();
        if($codOrder) {
            Cart::where('user_id', auth()->user()->id)->delete();
            $this->dispatchBrowserEvent('success', [
                'text' => 'Order Placed Successfully!'
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('danger', [
                'text' => 'Something Went Wrong!'
            ]);
        }
    }

    public function validationForAll() {
        $this->validate();
    }

    public function rules() {
        return [
            'fullname' => 'required|string|max:121',
            'email' => 'required|email|max:121',
            'phone' => 'required|string|max:15|min:10',
            'postal_code' => 'required|integer|digits:6',
            'address' => 'required|string|max:1000',
            'note' => 'nullable|string|max:500'
        ];
    }

    public function placeOrder() {
        $this->validate();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'tracking_no' => 'Orion-' . Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'postal_code' => $this->postal_code,
            'address' => $this->address,
            'status_message' => 'in progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
            'note' => $this->note,
        ]);

        foreach ($this->cart as $cartItem) {
            if ($cartItem->variant->product->sale_price) {
                $orderItems = OrderItem::create([
                    'order_id' => $order->id,
                    'variant_id' => $cartItem->variant_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->variant->product->sale_price,
                ]);
            } else {
                $orderItems = OrderItem::create([
                    'order_id' => $order->id,
                    'variant_id' => $cartItem->variant_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->variant->product->regular_price,
                ]);
            }

            $cartItem->variant->where('id', $cartItem->variant_id)->decrement('quantity', $cartItem->quantity);
        }

        return $order;
    }

    public function codOrder() {
        $this->payment_mode = 'Cash on Delivery';
        $codOrder = $this->placeOrder();
        if($codOrder) {
            Cart::where('user_id', auth()->user()->id)->delete();
            $this->dispatchBrowserEvent('success', [
                'text' => 'Order Placed Successfully!'
            ]);
            return redirect()->to('thank-you');
        } else {
            $this->dispatchBrowserEvent('danger', [
                'text' => 'Something Went Wrong!'
            ]);
        }
    }

    public function totalProductAmount() {
        $this->totalProductAmount = 0;
        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        foreach ($this->cart as $cartItem) {
            if ($cartItem->variant->product->sale_price) {
                $this->totalProductAmount += $cartItem->variant->product->sale_price * $cartItem->quantity;
            } else {
                $this->totalProductAmount += $cartItem->variant->product->regular_price * $cartItem->quantity;
            }
        }
        return $this->totalProductAmount;
    }

    public function render()
    {
        $this->fullname = auth()->user()->name;
        $this->email = auth()->user()->email;
        $this->phone = auth()->user()->userDetail->phone;
        $this->postal_code = auth()->user()->userDetail->postal_code;
        $this->address = auth()->user()->userDetail->address;

        $this->cart = Cart::where('user_id', auth()->user()->id)->get();
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout-component', [
            'totalProductAmount' => $this->totalProductAmount,
            'cart' => $this->cart
        ]);
    }
}
