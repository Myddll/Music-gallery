<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    protected $model = Album::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'artist_id' => 1,
            'user_id' => 1,
            'cover' => null,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae hendrerit ante. Donec magna ex, varius at sapien nec, gravida pretium magna. Nam in luctus tellus, eu aliquam nisi.'
        ];
    }
}
