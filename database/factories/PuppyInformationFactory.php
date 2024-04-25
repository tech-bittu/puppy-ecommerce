<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Support\Number;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PuppyInformationFactory extends Factory
{
     protected static ?string $password;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $array = [1, 2, 3, 4];

        return [
            'breed_type'=>fake()->unique()->numberBetween(1,99),
            'group_type' => Arr::random($array),
            'barking_level' => Arr::random($array),
            'activity_level' => Arr::random($array),
            'coat_type' => Arr::random($array),
            'characteristics' => Arr::random($array),
            'shedding' => Arr::random($array),
            'size' => Arr::random($array),
            'trainability' => Arr::random($array),
            'drooling_level' => Arr::random($array),
            'life_expetancy' => Arr::random($array),
            'affectionate_with_family' => Arr::random($array),
            'good_with_child' => Arr::random($array),
            'good_with_other_dogs' => Arr::random($array),
            'openness_to_strangers' => Arr::random($array),
            'watchdog_protective_nature' => Arr::random($array),
            'adaptability_level' => Arr::random($array),
            'playfulness_level' => Arr::random($array),
        ];
    }
}
