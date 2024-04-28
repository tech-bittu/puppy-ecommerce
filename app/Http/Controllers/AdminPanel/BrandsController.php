<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.brand.list-brands');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['category'] = Brand::all();
        return view('admin.brand.create-brands', ['data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[A-Za-z ]+$/i|unique:brands',
            'slug' => 'required|unique:brands',
            'status' => 'required|boolean',
        ]);
        $request["created_at"] = now();
        $request["updated_at"] = now();
        unset($request['_token'], $request['_method']);
        // dd($request->all());
        Brand::insert($request->all());

        return redirect('admin/brand/create')->with('success_message', 'Brand added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data['category'] = Brand::all();
        $data['brand'] = Brand::find($id);
        return view('admin.brand.create-brands', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[A-Za-z ]+$/i|unique:brands',
            'slug' => 'required|unique:brands',
            'status' => 'required|boolean',
        ]);
        $request["updated_at"] = now();
        unset($request['_token'], $request['_method']);

        Brand::where('id', $id)
            ->update($request->all());

        return redirect('admin/brand')->with('success_message', "$id updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        $previousStatus = Brand::find($id)->status;

        $status = $previousStatus ? 0 : 1;

        $suc = Brand::find($id)
            ->update(['status' => $status]);

        if ($suc) {
            return redirect('admin/brand')->with('success_message', "$id Status changed successfully");
        } else {
            return redirect('admin/brand')->with('error_message', "Technical error try again!");
        }
    }
}
