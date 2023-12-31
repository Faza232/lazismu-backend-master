<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coakredit>
 */
class CoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, true),
            'kode' => $this->faker->randomFloat(3, 12000, 13000),
            // 'cabang_id' => $this->faker->numberBetween(1,4),
            'cabang_id' => 1,
            'tipe' => $this->faker->numberBetween(0,1),
        ];
    }
}
