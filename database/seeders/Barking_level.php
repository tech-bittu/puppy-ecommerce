<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Barking_level as BreedModel;

class Barking_level extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $json_list = File::get(path:'database/data-list/barking-level.json');

        $arrayList = collect(json_decode($json_list));

        $arrayList->each(function($list){
            BreedModel::create([
                'type'=>$list->type
            ]);
        });
    }
}
