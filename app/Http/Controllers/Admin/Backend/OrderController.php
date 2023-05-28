<?php

namespace App\Http\Controllers\Admin\Backend;

use Carbon\Carbon;
use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Mail\InvoiceOrderMailable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function index()
    {
        // $todayDate = Carbon::now();
        $orders = Order::orderBy('updated_at', 'DESC')->orderBy('created_at', 'DESC')->get();
        return view('admin.backend.orders.index', compact('orders'));
    }

    public function edit($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        return view('admin.backend.orders.edit', compact('order'));
    }

    public function update($orderId, Request $request)
    {
        $order = Order::where('id', $orderId)->first();
        $order->update([
            'status_message' => $request->status_message
        ]);
        return redirect('ecommerce/admin/orders')->with('message', 'Size is updated successfully!');
    }

    public function show($orderId)
    {
        $order = Order::where('id', $orderId)->first();
        if ($order) {
            return view('admin.backend.orders.show', compact('order'));
        } else {
            return redirect()->back()->with('message', 'No Order Found!');
        }
    }

    public function destroy($orderId)
    {
        $order = Order::findOrFail($orderId);
        $order->delete();
        return response()->json(['message' => 'Order and its detail record are deleted successfully!']);
    }

    public function viewInvoice($orderId) {
        $order = Order::findOrFail($orderId);
        return view('admin.backend.orders.invoice.generate-invoice', compact('order'));
    }

    public function generateInvoice($orderId) {
        $order = Order::findOrFail($orderId);
        $data = ['order' => $order];

        $pdf = Pdf::loadView('admin.backend.orders.invoice.generate-invoice', $data);

        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-' . $order->id . '-' . $todayDate . '.pdf');
    }

    public function mailInvoice(int $orderId) {
        try {
            $order = Order::findOrFail($orderId);

            Mail::to("$order->email")->send(new InvoiceOrderMailable($order));
            return redirect('ecommerce/admin/orders/' . $orderId)->with('message', 'Invoice Mail has been sent to ' . $order->email);
        } catch(\Exception $e) {
            return redirect('ecommerce/admin/orders/' . $orderId)->with('message', 'Something Went Wrong!');
        }
    }
}
