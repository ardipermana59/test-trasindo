<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $role = Auth::user()->role;

        if ($role == 'superadmin') {
            return Inertia::render('Admin/Dashboard/Index', []);
        } elseif ($role == 'customer') {
            return Inertia::render('Customer/Dashboard/Index', []);
        } else{
            return Inertia::render('Merchant/Dashboard/Index', []);
        }
    }
}
