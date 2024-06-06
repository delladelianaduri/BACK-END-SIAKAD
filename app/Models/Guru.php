<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $primaryKey = 'no_induk';

    protected $fillable = [
        'no_induk', 'nama', 'kedudukan', 'alamat', 'id_guru',
    ];
}