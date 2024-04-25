<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use App\Models\Group_type as GroupModel;

class Group_type extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $jsonList = File::get(path:'database/data-list/group-type.json');
        $arrayList = collect(json_decode($jsonList));

        $arrayList->each(function($list){
            GroupModel::create([
                'type'=>$list->type
            ]);
        });
    }
}
