<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Merchant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->sequence(
            ['name' => 'Superadmin', 'email' => 'superadmin@gmail.com', 'role' => 'superadmin'],
        )->create();

        $userMerchants = User::factory()->count(2)->sequence(
            ['name' => 'Merchant 1','email' => 'merchant1@gmail.com', 'role' => 'merchant'],
            ['name' => 'Merchant 2','email' => 'merchant2@gmail.com', 'role' => 'merchant']
        )->create();

        foreach ($userMerchants as $user) {
            Merchant::factory()->create([
                'user_id' => $user->id,
            ]);
        }

        $userCustomer = User::factory()->count(2)->sequence(
            ['name' => 'Customer 1','email' => 'customer1@gmail.com', 'role' => 'customer'],
            ['name' => 'Customer 2','email' => 'customer2@gmail.com', 'role' => 'customer']
        )->create();

        foreach ($userCustomer as $user) {
            Customer::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
