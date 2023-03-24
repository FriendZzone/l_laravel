<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Groups;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    private $users;
    private $groups;
    private $table = 'users';
    const _PER_PAGE = 3;
    public function __construct()
    {

        $users = new Users();
        $this->users = $users;
        $groups = new Groups();
        $this->groups = $groups;
    }
    public function index(Request $request)
    {
        $title = 'User List';
        $filters = [];
        $keyword = '';
        if (!empty($request->status)) {
            $status = $request->status;
            if ($status == 'active') {
                $status = 1;
            } else {
                $status = 0;
            }
            $filters[] = [
                'users.status', '=', $status
            ];
        }
        if (!empty($request->group_id)) {
            $group_id = $request->group_id;
            $filters[] = [
                'users.group_id', '=', $group_id
            ];
        }
        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
        }

        // sort handle
        $sortBy = $request->input('sort-by') ? $request->input('sort-by') : 'id';
        $allowSort = ['asc', 'desc'];
        $sortType = in_array($request->input('sort-type'), $allowSort) ? $request->input('sort-type') : 'asc';
        $sortFilter = compact('sortBy', 'sortType');

        $usersList = $this->users->getAllUser($filters, $keyword, $sortFilter, self::_PER_PAGE);
        // dd($usersList);
        return view('clients/users/lists', compact('usersList', 'title', 'sortBy', 'sortType'));
    }
    public function add()
    {
        $title = 'Add User';
        $allGroups = $this->groups->getAll();
        return view('clients/users/add', compact('title', 'allGroups'));
    }

    public function postAdd(UserRequest $request)
    {

        $dataInsert = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => $request->status,
            'group_id' => $request->group_id,
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
                $allGroups = $this->groups->getAll();
                session(['id' => $id]);
                return view('clients/users/edit', compact('title', 'userDetail', 'id', 'allGroups'));
            } else {
                return redirect()->route('users.index')->withErrors(['msg' => 'User not exist!']);
            }
        } else {
            return redirect()->route('users.index')->withErrors(['msg' => 'Request not exist!']);
        }
    }

    public function postEdit(UserRequest $request)
    {
        $id = $request->id;
        $dataUpdate = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'created_at' => date('Y-m-d H:i:s'),
            'status' => $request->status,
            'group_id' => $request->group_id,
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
