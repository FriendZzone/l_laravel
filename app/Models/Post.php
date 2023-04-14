<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;

    // Configuration
    protected $connection = 'mysql';
    protected $table = 'posts';
    protected $primaryKey = 'id';
    // protected $keyType = 'int';
    // protected $fillable = ['title', 'content', 'status'];

    // // default values
    // protected $attributes = [
    //     'status' => 'thua',
    // ];

    // auto increment
    public $incrementing = true;

    // timestamp
    // public $timestamps = true;
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';

    public function comments()
    {
        return $this->hasMany(
            Comments::class,
            'post_id',
            'id'
        );
    }
}
