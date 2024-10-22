<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class MerchantOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $data = Order::with(['customer', 'menu'])->where('merchant_id', Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return Inertia::render('Merchant/Order/Index', [
            'data' => $data,
            'search' => $search,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai,batal',
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('merchant.orders.index')->with('message', 'Order status berhasil diupdate');
    }

    public function invoice(Request $request, $id)
    {
        $customer = Customer::where('user_id', Auth::user()->id)->firstOrFail();

        $order = Order::with(['merchant','customer'])
        ->where('customer_id', $customer->id)
        ->where('id', $id)
        ->first();
  

        $html = view('invoices.catering', compact('order'))->render();

        $pdf = Pdf::loadHTML($html);
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}
