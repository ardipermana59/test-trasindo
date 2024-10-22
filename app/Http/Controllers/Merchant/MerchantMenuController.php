<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\MercharRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\MenuType;
use Inertia\Inertia;
use App\Models\Menu;

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

    public function store(MercharRequest $request)
    {
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

    public function update(MercharRequest $request)
    {
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
