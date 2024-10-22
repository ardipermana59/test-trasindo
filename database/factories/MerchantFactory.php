<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Merchant>
 */
class MerchantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'company_name' => $this->faker->company,
            'address' => $this->faker->streetAddress,
            'village' => $this->faker->citySuffix,
            'district' => $this->faker->state,
            'city' => $this->faker->city,
            'province' => $this->faker->state,
            'contact' => $this->faker->phoneNumber,
            'description' => $this->faker->paragraph,
        ];
    }
}
