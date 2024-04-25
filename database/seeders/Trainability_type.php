<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Trainability as TrainabilityModel;

class Trainability_type extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonList = File::get(path:'database/data-list/trainability-type.json');
        $arrayList = collect(json_decode($jsonList));

        $arrayList->each(function($list){
            TrainabilityModel::create([
                'type'=>$list->type
            ]);
        });
    }
}
