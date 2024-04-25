<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Sheeding as SheedingModel;

class Sheeding_type extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonList = File::get(path:'database/data-list/sheeding-type.json');
        $arrayList = collect(json_decode($jsonList));

        $arrayList->each(function($list){
            SheedingModel::create([
                'type'=>$list->type
            ]);
        });
    }
}
