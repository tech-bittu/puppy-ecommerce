<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class Puppy_overviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $id = [3,4,5,6,7,8,9,10,11,12];
        return [
            'puppyinfo_id'=>Arr::random($id),
            'short_desc'=>fake()->sentence(3),
            'long_desc'=>fake()->sentence(13),
            'status'=>Arr::random([1,0]),
            'page_title'=>fake()->words(3, true),
            'meta_image'=>fake()->imageUrl(640, 480, 'animals', true),
            'meta_title'=>fake()->words(9, true),
            'meta_keyword'=>fake()->words(23, true),
            'meta_description'=>fake()->words(33, true),
            'og_image'=>fake()->imageUrl(640, 480, 'animals', true),
            'og_title'=>fake()->words(3, true),
            'og_description'=>fake()->words(9, true),
            'og_url'=>fake()->imageUrl(640, 480, 'animals', true),
            'robots'=>Arr::random([1,0]),
            'googlebot'=>Arr::random([1,0]),
        ];
    }
}
