<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Activity_level as ActivityModel;

class Activity_level extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $jsonnList = File::get(path:'database/data-list/activity-level.json');

        $arrayList = collect(json_decode($jsonnList));

        $arrayList->each( function($activity_typ){
            ActivityModel::create([
                'type'=>$activity_typ->type
            ]);
        });
    }
}
