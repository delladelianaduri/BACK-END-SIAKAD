<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn_siswa', 'nisn_siswa');
    }

    public function presensi()
    {
        return $this->hasMany(Presensi::class, 'nisn_siswa', 'nisn_siswa');
    }
}