<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuType;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class MerchantMenuController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search', '');

        $data = Menu::with('type')->where('merchant_id', Auth::user()->id)
            ->when(
                $search,
                fn($query) =>
                $query->where('name', 'like', '%' . $search . '%')
            )
            ->orderBy('name', 'asc')
            ->paginate(15);

        $types = MenuType::orderBy('name')->get();
        return Inertia::render('Merchant/Menu/Index', [
            'data' => $data,
            'types' => $types,
            'search' => $search,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:menu_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'price' => 'required|numeric|min:0',
        ]);

        $photoUrl = null;

        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();

            $request->file('photo')->storeAs('menus', $filename, 'public');

            $photoUrl = '/storage/menus/' . $filename;
        }

        Menu::create([
            'merchant_id' => Auth::user()->id,
            'menu_type_id' => $request->type_id,
            'name' => $request->name,
            'description' => $request->description,
            'photo_url' => $photoUrl,
            'price' => $request->price,
        ]);

        return redirect()->route('merchant.menus.index')->with('message', 'Data baru berhasil ditambahkan!');
    }



    public function update(Request $request)
    {
        $request->validate([
            'type_id' => 'required|exists:menu_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Make photo optional
            'price' => 'required|numeric|min:0',
        ]);

        $menu = Menu::findOrFail($request->id);

        $oldPhotoUrl = $menu->photo_url; 
        $photoUrl = $oldPhotoUrl; 
    
        if ($request->hasFile('photo')) {
            $filename = time() . '.' . $request->photo->extension();
            $request->file('photo')->storeAs('menus', $filename, 'public');
            $photoUrl = '/storage/menus/' . $filename;
          
            if ($oldPhotoUrl) {
                $oldFilename = basename($oldPhotoUrl);
                Storage::disk('public')->delete('menus/' . $oldFilename);
            }
        }
        $menu->update([
            'menu_type_id' => $request->type_id,
            'name' => $request->name,
            'description' => $request->description,
            'photo_url' => $photoUrl,
            'price' => $request->price,
        ]);
   
      
    
        return redirect()->route('merchant.menus.index')->with('message', 'Data berhasil diperbarui!');
    }
    

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('merchant.menus.index')->with('message', 'Data berhasil dihapus!');
    }
}
