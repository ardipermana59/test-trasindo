<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomerOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $customer = Customer::where('user_id', Auth::user()->id)->firstOrFail();

        $data = Order::with(['merchant', 'menu'])
            ->where('customer_id', $customer->id)
            ->when($search, function ($query) use ($search) {
                $query->whereHas('menu', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                    ->orWhere('status', 'like', '%' . $search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        return Inertia::render('Customer/Order/Index', [
            'data' => $data,
            'search' => $search,
        ]);
    }


    public function invoice(Request $request, $id)
    {
        $order = Order::with(['merchant', 'customer'])
            ->where('id', $id)
            ->first();

        $html = view('invoices.catering', compact('order'))->render();

        $pdf = Pdf::loadHTML($html);
        return $pdf->download('invoice-' . $order->id . '.pdf');
    }
}
