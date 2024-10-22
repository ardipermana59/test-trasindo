<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Menu;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class CustomerCateringController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $data = Menu::with(['type', 'merchant'])
            ->when(
                $search,
                fn($query) => $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('price', 'like', '%' . $search . '%')
                        ->orWhereHas('type', function ($query) use ($search) {
                            $query->where('name', 'like', '%' . $search . '%');
                        });
                })
            )
            ->orderBy('name', 'asc')
            ->paginate(15);

        return Inertia::render('Customer/Catering/Index', [
            'data' => $data,
            'search' => $search,
        ]);
    }

    public function order(Request $request)
    {
        $request->validate([
            'merchant_id' => 'required|exists:merchants,id',
            'id' => 'required|exists:menus,id',
            'amount' => 'required|integer|min:1',
            'delivery_date' => 'required|date|after_or_equal:today',
        ]);

        $customer = Customer::where('user_id', Auth::user()->id)->first();

        Order::create([
            'customer_id' => $customer->id,
            'merchant_id' => $request->merchant_id,
            'menu_id' => $request->id,
            'quantity' => $request->amount,
            'delivery_date' => $request->delivery_date,
        ]);


        return redirect()->route('customer.caterings.index')->with('message', 'Order baru berhasil dibuat!');
    }
}
