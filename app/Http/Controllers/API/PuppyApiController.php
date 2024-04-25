<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Puppyinformation;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class PuppyApiController extends Controller
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
            $searchQuery = " puppyinformations.id like '%" . $searchValue . "%' or breeds.name like '%" . $searchValue . "%' ";
        }
        ## Total number of records without filtering
        $totalRecords = Puppyinformation::all()->count();

        ## Total number of record with filtering
        if ($searchQuery) {
            $totalRecordwithFilterQuery =  Puppyinformation::offset($start)->limit($rowperpage);
            $totalRecordwithFilterQuery->join('breeds', 'puppyinformations.breed_type', '=', 'breeds.id');
            $totalRecordwithFilterQuery->whereRaw($searchQuery);
            $totalRecordwithFilter = $totalRecordwithFilterQuery->count();
        } else {
            $totalRecordwithFilter =  Puppyinformation::all()->count();
        }

        ## Fetch records
        $recordsQuery = Puppyinformation::offset($start)->limit($rowperpage)->orderBy($columnName, $columnSortOrder);
        $recordsQuery->join('breeds', 'puppyinformations.breed_type', '=', 'breeds.id');
        $recordsQuery->join('puppy_overviews', 'puppyinformations.id', '=', 'puppy_overviews.puppyinfo_id');
        $recordsQuery->select('puppyinformations.*', 'puppyinformations.id as p_id', 'breeds.name as name', 'puppy_overviews.status as status');
        // $recordsQuery->select('puppyinformations.id as puppy_id,breeds.name as name,characteristics.type as characteristics_type,activity_levels.type as activity_type,sheedings.type as sheeding_type,group_types.type as group_type,breed_sizes.type as breed_type,coat_types.type as coat_type,barking_levels.type as barking_type');
        if ($searchQuery) {
            $records = $recordsQuery->whereRaw($searchQuery)->get();
        } else {
            $records = $recordsQuery->get();
        }

        ## collection neccessary data
        $characteristics = DB::select('select * from characteristics');
        $trainabilities = DB::select('select * from trainabilities');
        $group_types = DB::select('select * from group_types');

        $data = array();
        foreach ($records as $record) {
            if ($record->status) {
                $status = ' text-success';
            } else {
                $status = '-off text-danger';
            }

            $updateStatus = $record->id;

            $action = '<div class="btn-group" role="group" aria-label="Basic example">
            <a href="' . url('/admin/puppies/' . $record->p_id) . '" type="button" class="btn btn-outline-secondary">
            <i class=" mdi mdi-table-edit icon-md text-warning"></i>
            </a>
            <a href="' . url('/admin/puppiesdes/' . $record->p_id ) . '"  type="button"  class="btn btn-outline-secondary">
              <i class="mdi mdi-toggle-switch' . $status . ' icon-md"></i>
            </a>
          </div>';

            $data[] = array(
                'id' => $record->p_id,
                'name' => $record->name,
                'group_type' => $group_types[$record->group_type-1]->type,
                'characteristics' => $characteristics[$record->characteristics-1]->type,
                'trainability' => $trainabilities[$record->trainability-1]->type,
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
        // return Puppyinformation::all();
    }
}
