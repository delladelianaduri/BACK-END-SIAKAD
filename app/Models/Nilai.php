<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nisn_siswa',
        'nama_siswa',
        'presensi',
        'tugas',
        'uts',
        'uas',
        'nilai_akhir',
    ];
}

