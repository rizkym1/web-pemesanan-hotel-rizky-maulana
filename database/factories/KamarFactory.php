<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Kamar>
 */
class KamarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'tipe_kamar' => $this->faker->word(), // atau $this->faker->sentence(2)
            'fasilitas' => $this->faker->words(3, true), // menghasilkan 3 kata
            'keterangan' => $this->faker->sentence(),
            'stok_kamar' => $this->faker->numberBetween(1, 100), // angka stok
            'harga' => $this->faker->numberBetween(100000, 1000000), // angka harga
            'kode_kamar' => $this->faker->unique()->word(), // memastikan kode unik
        ];
    }
}
