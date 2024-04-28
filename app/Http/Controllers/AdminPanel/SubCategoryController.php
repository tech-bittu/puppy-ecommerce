<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.subcategory.list-subcategory');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['category'] = Category::all();
        return view('admin.subcategory.create-subcategory', ['data',$data]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[A-Za-z ]+$/i|unique:categories',
            'slug' => 'required|unique:categories',
            'status' => 'required|boolean',
        ]);
        $request["created_at"] = now();
        $request["updated_at"] = now();
        unset($request['_token'], $request['_method']);
        Subcategory::insert($request->all());

        return redirect('admin/subcategory/create')->with('success_message', 'subcategory added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $subcategory = Subcategory::find($id);

        $data = ['subcategory'];
        return view('admin.subcategory.create-subcategory', compact($data));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|regex:/^[A-Za-z ]+$/i|unique:categories',
            'slug' => 'required|unique:categories',
            'status' => 'required|boolean',
        ]);
        $request["updated_at"] = now();
        unset($request['_token'], $request['_method']);

        Subcategory::where('id', $id)
            ->update($request->all());

        return redirect('admin/subcategory')->with('success_message', "$id updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        $previousStatus = Subcategory::find($id)->status;

        $status = $previousStatus ? 0 : 1;

        $suc = Subcategory::find($id)
            ->update(['status' => $status]);

        if ($suc) {
            return redirect('admin/subcategory')->with('success_message', "$id Status changed successfully");
        } else {
            return redirect('admin/subcategory')->with('error_message', "Technical error try again!");
        }
    }
}
