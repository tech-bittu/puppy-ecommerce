<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Breed;
use Dotenv\Store\File\Paths;
use Illuminate\Support\Facades\File;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $breedsJson = File::get(path:'database/data-list/breeds-list.json');
        $breeds = collect(json_decode($breedsJson));

        $breeds->each(function ($breed) {
            Breed::create(
                [
                    "name" => $breed->name,
                ]
            );
        });
    }
}
