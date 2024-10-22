<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuType;
use App\Models\Merchant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menuTypes = [
            'Traditional Food',
            'Western Food',
            'Chinese Food',
            'Desserts',
            'Beverages'
        ];

        foreach ($menuTypes as $type) {
            $menuType = MenuType::create(['name' => $type]);

            for ($i = 1; $i <= 10; $i++) {
                Menu::create([
                    'merchant_id' => Merchant::inRandomOrder()->first()->id, 
                    'name' => $type . ' Menu ' . $i,
                    'description' => 'Delicious ' . $type . ' item number ' . $i,
                    'photo_url' => 'https://via.placeholder.com/150', 
                    'price' => rand(10000, 50000), 
                    'menu_type_id' => $menuType->id
                ]);
            }
        }
    }
}
