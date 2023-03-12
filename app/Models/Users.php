<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    public function getUser($id)
    {
        $data = DB::select("SELECT * FROM $this->table WHERE id = ?", [$id]);
        return $data;
    }
    public function getAllUser()
    {
        $data = DB::select("SELECT * FROM $this->table");
        return $data;
    }
    public function insertUser($dataInsert)
    {
        $result = DB::insert("INSERT INTO $this->table (name, email, password, created_at) VALUES (?, ? , ?, ?)", $dataInsert);
        return $result;
    }
    public function updateUser($dataInsert, $id)
    {
        $data = array_merge($dataInsert, [$id]);
        $result = DB::update("UPDATE $this->table SET name = ?, email=?, password=?, updated_at=? WHERE id = ?", $data);
        return $result;
    }
    public function deleteUser($id)
    {
        $result = DB::delete("DELETE FROM $this->table WHERE id = ?", [$id]);
        return $result;
    }
    public function statementUser($sql)
    {
        $result = DB::statement($sql);
        return $result;
    }
}
