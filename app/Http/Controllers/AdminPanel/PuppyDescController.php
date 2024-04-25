<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PuppyOveviewRequest;
use App\Models\puppy_overview;

class PuppyDescController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PuppyOveviewRequest $request)
    {
        $puppyinfo_id = session('puppy_info_unique_id');

        // # cover Image 
        if($request->hasfile('cover_image'))
        {
            $file = $request->file('cover_image');
            $extenstion = $file->getClientOriginalExtension();
            $coverImagePath = "$request->puppyinfo_id-t5ba1e9cbba836f77c2a4f271cba816d0.$extenstion";
            $file->move(public_path('puppy-images/cover/'), $coverImagePath);
        }else{
            $previousImagePath = puppy_overview::where('puppyinfo_id',$request->puppyinfo_id)->get();
            $coverImagePath = $previousImagePath[0]->cover_image;
        }
        // ## meta image
        if($request->hasfile('meta_image'))
        {
            $file = $request->file('meta_image');
            $extenstion = $file->getClientOriginalExtension();
            $metaImagePath = "$request->puppyinfo_id-269d66de64d8d6ec810a76dc8f4dd984.$extenstion";
            $file->move(public_path('puppy-images/meta-images/'), $metaImagePath);
        }else{
            $previousImagePath = puppy_overview::where('puppyinfo_id',$request->puppyinfo_id)->get();
            $metaImagePath = $previousImagePath[0]->meta_image;
        }
        // ## Og  image
        if($request->hasfile('og_image'))
        {
            $file = $request->file('og_image');
            $extenstion = $file->getClientOriginalExtension();
            $ogImagePath = "$request->puppyinfo_id-90b343547307627eb92636be2e468c56.$extenstion";
            $file->move(public_path('puppy-images/og-images/'), $ogImagePath);
        }else{
            $previousImagePath = puppy_overview::where('puppyinfo_id',$request->puppyinfo_id)->get();
            $ogImagePath = $previousImagePath[0]->og_image;
        }

        $insertData = [
            "puppyinfo_id"=> $puppyinfo_id,
            "cover_image"=> $coverImagePath,
            "short_desc" => $request->short_desc,
            "long_desc" => $request->long_desc,
            "status" => $request->status,
            "page_title" => $request->page_title,
            "meta_image" => $metaImagePath,
            "meta_title" => $request->meta_title,
            "meta_keyword" => $request->meta_keyword,
            "meta_description" => $request->meta_description,
            "og_image" => $ogImagePath,
            "og_title" => $request->og_title,
            "og_description" => $request->og_description,
            "og_url" => $request->og_url,
            "robots" => $request->robots,
            "googlebot" => $request->googlebot,
        ];

        // dd($insertData);
        
        $suc =  DB::table('puppy_overviews')->insert($insertData);
        if ($suc) {
            return redirect()->route('puppies.index')->with('success_message', 'Overview details inserted successfully.');
        } else {
            return redirect()->route('puppies.index')->with('error_message', 'Technical issue, try again or contact tech team.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = collect(DB::table('puppy_overviews')->where('puppyinfo_id', $id)->select('status')->get());
        if ($data[0]->status) {
            $status = 0;
        } else {
            $status = 1;
        }
        $idd = DB::table('puppy_overviews')->where('puppyinfo_id', $id)
            ->update(['status' => $status]);

        return redirect('admin/puppies')->with('success_message', $id . ' Status changed.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PuppyOveviewRequest $request)
    {
        $puppy_id = $request->puppyinfo_id;
        // dd(session('overviewActive'));
        $request->session()->forget('overviewActive');
        // # cover Image 
        if($request->hasfile('cover_image'))
        {
            $file = $request->file('cover_image');
            $extenstion = $file->getClientOriginalExtension();
            $coverImagePath = "$request->puppyinfo_id-t5ba1e9cbba836f77c2a4f271cba816d0.$extenstion";
            $file->move(public_path('puppy-images/cover/'), $coverImagePath);
        }else{
            $previousImagePath = puppy_overview::where('puppyinfo_id',$request->puppyinfo_id)->get();
            $coverImagePath = $previousImagePath[0]->cover_image;
        }
        // ## meta image
        if($request->hasfile('meta_image'))
        {
            $file = $request->file('meta_image');
            $extenstion = $file->getClientOriginalExtension();
            $metaImagePath = "$request->puppyinfo_id-269d66de64d8d6ec810a76dc8f4dd984.$extenstion";
            $file->move(public_path('puppy-images/meta-images/'), $metaImagePath);
        }else{
            $previousImagePath = puppy_overview::where('puppyinfo_id',$request->puppyinfo_id)->get();
            $metaImagePath = $previousImagePath[0]->meta_image;
        }
        // ## Og  image
        if($request->hasfile('og_image'))
        {
            $file = $request->file('og_image');
            $extenstion = $file->getClientOriginalExtension();
            $ogImagePath = "$request->puppyinfo_id-90b343547307627eb92636be2e468c56.$extenstion";
            $file->move(public_path('puppy-images/og-images/'), $ogImagePath);
        }else{
            $previousImagePath = puppy_overview::where('puppyinfo_id',$request->puppyinfo_id)->get();
            $ogImagePath = $previousImagePath[0]->og_image;
        }

        $updateData = [
            "cover_image"=> $coverImagePath,
            "short_desc" => $request->short_desc,
            "long_desc" => $request->long_desc,
            "status" => $request->status,
            "page_title" => $request->page_title,
            "meta_image" => $metaImagePath,
            "meta_title" => $request->meta_title,
            "meta_keyword" => $request->meta_keyword,
            "meta_description" => $request->meta_description,
            "og_image" => $ogImagePath,
            "og_title" => $request->og_title,
            "og_description" => $request->og_description,
            "og_url" => $request->og_url,
            "robots" => $request->robots,
            "googlebot" => $request->googlebot,
        ];
        // dd($request->all());
        // unset($_SESSION['overviewActive']);
        
        $suc = DB::table('puppy_overviews')->where('puppyinfo_id', $puppy_id)->update($updateData);
        return redirect('admin/puppies')->with('success_message', 'Overview Data updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
