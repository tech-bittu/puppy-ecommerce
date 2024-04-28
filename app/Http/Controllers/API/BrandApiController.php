<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandApiController extends Controller
{
    public function list(Request $request)
    {
        // dd($request->all());
        $response = array();
        ## Read value
        $draw = $request['draw'];
        $start = $request['start'];
        $rowperpage = $request['length'];
        // Rows display per page
        $columnIndex = $request['order'][0]['column'];
        // Column index
        $columnName = $request['columns'][$columnIndex]['data'];
        // Column name
        $columnSortOrder = $request['order'][0]['dir'];
        // asc or desc
        $searchValue = $request['search']['value'];
        // Search value

        ## Search
        $searchQuery = '';
        if ($searchValue != '') {
            // $searchQuery = " (id like '%" . $searchValue . "%' or breeds.name like '%" . $searchValue . "%' or activity_levels.type like '%" . $searchValue . "%' or sheedings.type like '%" . $searchValue . "%' or group_types.type like '%" . $searchValue . "%' or coat_types.type like '%" . $searchValue . "%' or barking_levels.type like '%" . $searchValue . "%') ";
            $searchQuery = " name like '%" . $searchValue . "%' or id like '%" . $searchValue . "%' ";
        }
        ## Total number of records without filtering
        $totalRecords = Brand::all()->count();

        ## Total number of record with filtering
        if ($searchQuery) {
            $totalRecordwithFilterQuery =  Brand::offset($start)->limit($rowperpage);
            $totalRecordwithFilterQuery->whereRaw($searchQuery);
            $totalRecordwithFilter = $totalRecordwithFilterQuery->count();
        } else {
            $totalRecordwithFilter =  Brand::all()->count();
        }

        ## Fetch records
        $recordsQuery = Brand::offset($start)->limit($rowperpage)->orderBy($columnName, $columnSortOrder);
        $recordsQuery->select('brands.*');
        // $recordsQuery->select('Categories.id as puppy_id,breeds.name as name,characteristics.type as characteristics_type,activity_levels.type as activity_type,sheedings.type as sheeding_type,group_types.type as group_type,breed_sizes.type as breed_type,coat_types.type as coat_type,barking_levels.type as barking_type');
        if ($searchQuery) {
            $records = $recordsQuery->whereRaw($searchQuery)->get();
        } else {
            $records = $recordsQuery->get();
        }



        $data = array();
        foreach ($records as $record) {
            if ($record->status) {
                $status = ' text-success';
            } else {
                $status = '-off text-danger';
            }

            $updateStatus = $record->id;

            $action = '
               <div class="btn-group" role="group" aria-label="Basic example">
               <a href="' . url('/admin/brand/' . $record->id) . '" type="button" class="btn btn-outline-secondary">
               <i class=" mdi mdi-table-edit icon-md text-warning"></i>
               </a>
               <a href="' . url('/admin/brand/status/' . $record->id) . '"  class="btn btn-outline-secondary">
                 <i class="mdi mdi-toggle-switch' . $status . ' icon-md"></i>
               </a>
             </div>';

            $data[] = array(
                'id' => $record->id,
                'name' => $record->name,
                'slug' => $record->slug,
                'action' => $action,
            );
        }

        ## Response
        $response = array(
            'draw' => intval($draw),
            'iTotalRecords' => $totalRecords,
            'iTotalDisplayRecords' => $totalRecordwithFilter,
            'aaData' => $data
        );

        return $response;
    }
}
