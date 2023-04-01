<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'country';

    public function posts()
    {
        return $this->hasManyThrough(
            Post::class, // model muon lien ket
            Users::class, // model trung gian
            'country_id', // field lien ket cua model trung gian
            'user_id', // field lien ket cua model muon lien ket
            'id', // primary key cua table chinh
            'id', // primary key cua table trung gian
        );
    }
}
