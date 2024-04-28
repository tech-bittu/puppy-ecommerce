<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return view('admin.category.list-category');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $data = array();
        $breed = ['name' => 'Lally prasas'];

        $data = ['breed'];
        return view('admin.category.create-category', compact($data));
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
        Category::insert($request->all());

        return redirect('admin/category/create')->with('success_message', 'Category added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::find($id);

        $data = ['category'];
        return view('admin.category.create-category', compact($data));
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

        Category::where('id', $id)
            ->update($request->all());

        return redirect('admin/category')->with('success_message', "$id updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function status(string $id)
    {
        $previousStatus = Category::find($id)->status;

        $status = $previousStatus ? 0 : 1;

        $suc = Category::find($id)
            ->update(['status' => $status]);
        
        if($suc)
        {
            return redirect('admin/category')->with('success_message',"$id Status changed successfully");
        }else{
            return redirect('admin/category')->with('error_message',"Technical error try again!");
        }
    }
}
