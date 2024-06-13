<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'sales' => $this->faker->numberBetween(10000, 999999),
            'date_released' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'last_update' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'image' => $this->faker->image(public_path('database-image/album-image/'),400,400, 'album cover', false) ,
        ];
    }
}
