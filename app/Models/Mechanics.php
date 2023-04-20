<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Owners;

class Mechanics extends Model
{
    use HasFactory;
    protected $table = 'mechanics';

    public function carOwner()
    {
        return $this->hasOneThrough(
            Owners::class, // model muon lien ket toi
            Cars::class, // model trung gian
            'mechanic_id', // khoa ngoai cua table trung gian
            'car_id', // khoa ngoai cua table muon lien ket toi
            'id', // primary key cua table chinh
            'id' // primary key cua table trung gian
        );
    }
}
