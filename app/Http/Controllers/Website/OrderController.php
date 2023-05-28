<?php

namespace App\Http\Controllers\Website;

use App\Models\Order;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'DESC')->paginate(5);
        return view('frontend.orders.index', compact('orders'));
    }

    public function show($orderId) {
        $order = Order::where('user_id', auth()->user()->id)->where('id', $orderId)->first();
        if($order) {
            return view('frontend.orders.show', compact('order'));
        } else {
            return redirect()->back()->with('message', 'No Order Found!');
        }
    }
}
