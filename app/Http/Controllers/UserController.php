<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    private $users;
    public function __construct()
    {

        $users = new Users();
        $this->users = $users;
    }
    public function index()
    {
        $title = 'User List';
        $data = $this->users->queryBuilder();
        dd($data);
        // $usersList = $this->users->getAllUser();
        // return view('clients/users/lists', compact('usersList', 'title'));
    }
    public function add()
    {
        $title = 'Add User';
        return view('clients/users/add', compact('title'));
    }

    public function postAdd(Request $request)
    {
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ];
        $message = [
            'name.required' => ':attribute is required',
            'name.min' => ':attribute must be at least :min characters',
            'email.required' => ':attribute is required',
            'email.email' => ':attribute must be type email',
            'email.unique' => ':attribute has already taken',
            'pasword.required' => ':attribute is required',

        ];
        $attribute = [
            'name' => 'User name',
            'email' => 'User email',
            'password' => 'User password',
        ];
        $request->validate($rules, $message, $attribute);
        $dataInsert = [
            $request->name,
            $request->email,
            $request->password,
            date('Y-m-d H:i:s')
        ];
        $result = $this->users->insertUser($dataInsert);
        if ($result) {
            return redirect()->route('users.index')->with(['msg' => 'Add user successfully!']);
        } else {
            return back()->withErrors('Error inserting user!');
        }
    }

    public function edit($id = 0)
    {
        $title = 'Update User';
        if (!empty($id)) {
            $userDetail = $this->users->getUser($id);
            if (!empty($userDetail[0])) {
                $userDetail = $userDetail[0];
                return view('clients/users/edit', compact('title', 'userDetail', 'id'));
            } else {
                return redirect()->route('users.index')->withErrors(['msg' => 'User not exist!']);
            }
        } else {
            return redirect()->route('users.index')->withErrors(['msg' => 'Request not exist!']);
        }
    }

    public function postEdit(Request $request)
    {
        $id = $request->id;
        $rules = [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users, email' . $id,
            'password' => 'required'
        ];
        $message = [
            'name.required' => ':attribute is required',
            'name.min' => ':attribute must be at least :min characters',
            'email.required' => ':attribute is required',
            'email.email' => ':attribute must be type email',
            'pasword.required' => ':attribute is required',
        ];
        $attribute = [
            'name' => 'User name',
            'email' => 'User email',
            'password' => 'User password',
        ];
        $request->validate($rules, $message, $attribute);
        $dataUpdate = [
            $request->name,
            $request->email,
            $request->password,
            date('Y-m-d H:i:s')
        ];
        $userDetail = $this->users->updateUser($dataUpdate, $id);
        if ($userDetail) {
            return redirect()->route('users.edit', ['id' => $id])->with('msg', 'Update user successfully!')->withInput();
        }
    }

    public function delete($id)
    {
        $currentUser = $this->users->getUser($id);
        if (!empty($id) && !empty($currentUser[0])) {
            $result = $this->users->deleteUser($id);
            if ($result) {
                return redirect()->route('users.index')->with(['msg' => 'Delete user successfully']);
            } else {
                return redirect()->route('users.index')->withErrors(['msg' => 'Delete user Error']);
            }
        } else {
            return redirect()->route('users.index')->withErrors(['msg' => 'User does not exist']);
        }
    }
}
