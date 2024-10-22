<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $users = User::with(['merchant', 'customer'])
            ->paginate(15);

        return Inertia::render('Admin/Users/Index', [
            'users' => $users,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role == 'merchant') {
            $user->merchant()->create([
                'company_name' => $request->name,
                'address' => $request->address,
                'contact' => $request->contact,
            ]);
        } elseif ($request->role == 'customer') {
            $user->customer()->create([
                'company_name' => $request->name,
                'address' => $request->address,
                'contact' => $request->contact,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }


    // public function update(Request $request, User $user)
    // {
    //     $data = $request->validated();

    //     if ($request->filled('password')) {
    //         $data['password'] = Hash::make($request->password);
    //     } else {
    //         unset($data['password']);
    //     }

    //     $user->update($data);

    //     return redirect()->route('admin.users.index');
    // }


    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}
