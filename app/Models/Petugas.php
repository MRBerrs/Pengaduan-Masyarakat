<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_petugas';

    protected $fillable = [
        'name_petugas',
        'username',
        'password',
        'telp',
        'level',
    ];
}
