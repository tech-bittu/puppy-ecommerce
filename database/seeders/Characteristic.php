<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Characteristics as CharacteristicModel;

class Characteristic extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $jsonList = File::get(path:'database/data-list/characteristic-type.json');

        $arrayList = collect(json_decode($jsonList));

        $arrayList->each(function($list){
            CharacteristicModel::create([
                'type'=>$list->type
            ]);
        });
    }
}
