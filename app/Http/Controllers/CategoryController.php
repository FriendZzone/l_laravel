<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Rules\UpperCase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('clients/add');
    }

    // [POST] create a Category 
    public function handleAddCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product-name' => ['required', 'min:6', function($attribute, $value, $fail) {
                if ($value != strtoupper($value)) {
                    $fail(trans('validation.upper_case'));
                }
            }],
            'product-price' => 'required|integer',
            'id' => 'integer'
        ], $this->messages());
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
            // return back()->withErrors($validator)->withInput();
        } else {
            return response('success', 201);
            // return back()->withInput();
        }
        // return back()->withInput();
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
    // Validation rules
    public function messages()
    {
        return [
            'product-name.required' => 'This :attribute is required',
            'body.required' => 'A message is required',
            'integer' => 'This :attribute must be a number',
            'min' => ':attribute must be :min characters'
        ];
    }

    public function attributes()
    {
        return [
            'product-name' => 'Tên sản phẩm',
            'product-price' => 'Giá sản phẩm',
        ];
    }
}
