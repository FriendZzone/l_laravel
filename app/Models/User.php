<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\Phone;
// use Laravel\Sanctum\HasApiTokens;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, HasApiTokens;
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password'];

    public function posts()
    {
        return $this->hasMany(
            Post::class,
            'user_id',
            'id'
        );
    }

    public function phone()
    {
        return $this->hasOne(
            Phone::class,
            'user_id',
            'id'
        )->withDefault(
            function ($phone) {
                $phone->phone = 'N/A';
                return $phone;
            }
        );
    }
    public function group()
    {
        return $this->belongsTo(
            Groups::class,
            'group_id',
            'id'
        );
    }

    public function getUser($id)
    {
        $data = DB::select("SELECT * FROM $this->table WHERE id = ?", [$id]);
        return $data;
    }
    public function getAllUser($filters = [], $keyword = '', $sortFilter = null, $perPage = null)
    {
        DB::enableQueryLog();
        $users = DB::table($this->table)
            ->join('groups', $this->table . '.group_id', '=', 'groups.id')
            ->select('users.*', 'groups.name as group_name');
        if (!empty($filters)) {
            $users = $users->where($filters);
        }
        if (!empty($keyword)) {
            $users = $users
                ->where(function ($query) use ($keyword) {
                    return $query
                        ->where('users.name', 'like', '%' . $keyword . '%')
                        ->orWhere('users.email', 'like', '%' . $keyword . '%')
                        ->orWhere('groups.name', 'like', '%' . $keyword . '%');
                });
        }
        if (!empty($sortFilter)) {
            $users = $users->orderBy('users.' . $sortFilter['sortBy'], $sortFilter['sortType']);
        }

        if (!empty($perPage)) {
            // $users = $users->paginate($perPage)->withQueryString();
        } else {
            $users = $users->get();
        }
        $sql = DB::getQueryLog();
        // dd($sql);
        return $users;
    }
    public function insertUser($dataInsert)
    {
        // $result = DB::insert("INSERT INTO $this->table (name, email, password, created_at) VALUES (?, ? , ?, ?)", $dataInsert);
        $result = DB::table($this->table)->insert($dataInsert);
        return $result;
    }
    public function updateUser($dataUpdate, $id)
    {
        // $data = array_merge($dataInsert, [$id]);
        // $result = DB::update("UPDATE $this->table SET name = ?, email=?, password=?, updated_at=? WHERE id = ?", $data);
        $result = DB::table($this->table)->where('id', $id)->update($dataUpdate);
        return $result;
    }
    public function deleteUser($id)
    {
        // $result = DB::delete("DELETE FROM $this->table WHERE id = ?", [$id]);
        $result = DB::table($this->table)->where('id', $id)->delete();
        return $result;
    }
    public function statementUser($sql)
    {
        $result = DB::statement($sql);
        return $result;
    }

    public function queryBuilder()
    {
        $id = 2;
        DB::enableQueryLog();
        $data = DB::table($this->table)
            ->where('group_id', '=', function ($query) {
                return  $query->select("id")
                    ->from('groups')
                    ->where('name', 'Admin')
                    ->get();
            })
            ->get();
        dd($data);
        $sql = DB::getQueryLog();
        return $sql[0];
    }
}
