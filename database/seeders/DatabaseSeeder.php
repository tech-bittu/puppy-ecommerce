<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Puppyinformation as PuppyInfoModel;
use App\Models\puppy_overview as PuppyOverviewModel;
use App\Models\Admin;
use App\Models\Activity_level as ActivityModel;
use App\Models\Barking_level as BarkingModel;
use App\Models\Characteristics as CharacteristicModel;
use App\Models\Coat_type as CoatModel;
use App\Models\Group_type as GroupModel;
use App\Models\Sheeding as SheedingModel;
use App\Models\Breed_size as BreedSizeModel;
use App\Models\Trainability as TrainabilityModel;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(100)->create();
        // PuppyInfoModel::factory(10)->create();
        // PuppyOverviewModel::factory(10)->create();
        Admin::factory((5))->create();
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password'=>hash('md5','12345678')
        // ]);

        $this->call([
            // #Seeder class call not model class only include model in top
            // BreedSeeder::class,
            // Activity_level::class,
            // Barking_level::class,
            // Characteristic::class,
            // Coat_type::class,
            // Group_type::class,
            // Sheeding_type::class,
            // Size_type::class,
            // Trainability_type::class
        ]);
    }
}
