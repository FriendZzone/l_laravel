<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UsersCollection;
use App\Http\Resources\UsersResource;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //
    public function index(Request $request)
    {
        $users = Users::orderBy('id', 'desc');
        if ($request->has('name')) {
            $users->where('name', 'like', "%{$request->input('name')}%");
        }
        if ($request->has('email')) {
            $users->where('email', 'like', "%{$request->input('email')}%");
        }
        $users = $users->with('posts')->paginate();
        $status = !$users->isEmpty() ? 'success' : 'no_data';;
        $response = [
            'status' => $status,
            'data' => new UsersCollection($users)
        ];
        return response()->json($response);
    }

    public function detail($id)
    {
        $user = Users::with('posts')->find($id);
        $status = !empty($user) ? 'success' : 'no_data';
        $response = [
            'status' => $status,
            'data' => new UsersResource($user)
        ];
        return response()->json($response);
    }

    public function create(Request $request)
    {
        $this->validation($request);
        $user = new Users();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $response = [
            'status' => 'success',
            'data' => $user
        ];
        return response()->json($response);
    }

    public function update(Request $request, $id)
    {
        $user = Users::find($id);
        if ($user) {
            $method = $request->method();
            // $this->validation($request);
            if ($method == 'PUT') {
                $user->name = $request->name;
                $user->email = $request->email;
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                } else {
                    $user->password = null;
                }
                $user->save();
                $response = [
                    'status' => 'success',
                    'data' => $user
                ];
                return response()->json($response);
            } else if ($method == 'PATCH') {
                if ($request->name) {
                    $user->name = $request->name;
                }
                if ($request->email) {
                    $user->email = $request->email;
                }
                if ($request->password) {
                    $user->password = Hash::make($request->password);
                }
                $user->save();
                $response = [
                    'status' => 'success',
                    'data' => $user
                ];
                return response()->json($response);
            }
        }
    }

    public function delete(Users $user)
    {
        $status = $user->destroy($user->id);
        return response()->json([
            'status' => $status ? 'success' : 'no_data',
        ]);
    }

    public function validation($request, $id = 0)
    {
        $emailValidation = 'required|email|unique:users';
        if (!empty($id)) {
            $emailValidation .= ',email,' . $id;
        }
        $rules = [
            'name' => 'required|min:5',
            'email' => $emailValidation,
            'password' => 'required|min:5',
        ];
        $request->validate($rules);
    }
}
