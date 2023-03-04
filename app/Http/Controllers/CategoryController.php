<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
    }

    // [GET] get all categories
    public function index(Request $request)
    {
        dd($request->input());
        // return view('clients/categories/list');
    }

    // [GET] get Category by ID 
    public function getCategory($id)
    {
        return view('clients/categories/edit', ['id' => $id]);
    }
    // [GET] get Category by ID 
    public function fileCategory()
    {
        return view('clients/categories/file');
    }

    // [GET] show form create a Category 
    public function addCategory()
    {
        return view('clients/categories/add');
    }
    // [POST] create a Category 
    public function handleAddCategory(Request $request)
    {
        dd($request->old('id'));
        // return redirect(route('category.add'));
    }
    // [POST] create a Category 
    public function handleFileCategory(Request $request)
    {
        dd($request->file('photo')->extension());
        // dd($request->file('photo')->storeAs('folder', 'newName'));
        // return redirect(route('category.add'));
    }

    // [POST] Update a Category
    public function updateCategory($id)
    {
        return 'Submit Update category' . $id;
    }

    // [DEL] Delete a Category
    public function deleteCategory($id)
    {
        return 'Submit Delete category' . $id;
    }
}
