<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Breed;
use App\Models\Activity_level as ActivityModel;
use App\Models\Barking_level as BarkingModel;
use App\Models\Breed_size as BreedSizeModel;
use App\Models\Characteristics as CharacteristicModel;
use App\Models\Coat_type as CoatModel;
use App\Models\Group_type as GroupTypeModel;
use App\Models\Sheeding as SheedingModel;
use App\Models\Trainability as TrainabilityModel;
use App\Http\Requests\PuppiesInfoRequest;
use App\Models\Puppyinformation;
use App\Models\puppy_overview;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PuppyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.puppy.list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $data['breed'] = Breed::all();
        $data['trainablity'] = TrainabilityModel::all()->sortBy('type');
        $data['sheeding'] = SheedingModel::all()->sortBy('type');
        $data['breed_group'] = GroupTypeModel::all()->sortBy('type');
        $data['coat_type'] = CoatModel::all()->sortBy('type');
        $data['characteristic'] = CharacteristicModel::all()->sortBy('type');
        $data['breed_size'] = BreedSizeModel::all()->sortBy('type');
        $data['barking_type'] = BarkingModel::all()->sortBy('type');
        $data['activity_type'] = ActivityModel::all()->sortBy('type');

        return view('admin.puppy.create', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PuppiesInfoRequest $request)
    {
        unset($request['_token'], $request['_method']);

        $id =  Puppyinformation::insertGetId($request->all());

        session(['puppy_info_unique_id' => $id]);
        session(['overviewActive' => 'active']);
        return redirect()->route('puppies.create')->with('success_message', 'Basic information added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data['breed'] = Breed::all();
        $data['trainablity'] = TrainabilityModel::all()->sortBy('type');
        $data['sheeding'] = SheedingModel::all()->sortBy('type');
        $data['breed_group'] = GroupTypeModel::all()->sortBy('type');
        $data['coat_type'] = CoatModel::all()->sortBy('type');
        $data['characteristic'] = CharacteristicModel::all()->sortBy('type');
        $data['breed_size'] = BreedSizeModel::all()->sortBy('type');
        $data['barking_type'] = BarkingModel::all()->sortBy('type');
        $data['activity_type'] = ActivityModel::all()->sortBy('type');

        
        $data['puppyinfo'] = Puppyinformation::find($id);
        $data['puppyDes'] = puppy_overview::where('puppyinfo_id',$id)->get();
        // $data['puppyDes'] = DB::table('puppy_overviews')->where('puppyinfo_id',$id)->get();

        return view('admin.puppy.create', ['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      //
      return abort(401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PuppiesInfoRequest $request, string $id)
    {

        unset($request['_token'], $request['_method'],$request['breed_type']);
        // $request['breed_type'] = Puppyinformation::find($id)->breed_type;
        // dd($request->all());
        $puppyId =DB::table('puppyinformations')
              ->where('id', $id)
              ->update($request->all());
        // $puppyId =  Puppyinformation::find($id)->update($request->all());
        session(['overviewActive' => 'active']);
        session(['puppy_info_unique_id' => $puppyId]);
        return redirect('admin/puppies/'.$id)->with('success_message', 'Basic information Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        return "destroy data";
    }
    
}
