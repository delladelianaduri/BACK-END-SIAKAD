<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    protected $table = 'presensi';

    protected $fillable = [
        'nisn_siswa', 'kode_kelas', 'tanggal', 'status',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn_siswa', 'nisn_siswa'); // Menghubungkan relasi dengan model Siswa
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kode_kelas', 'kode_kelas'); // Menghubungkan relasi dengan model Kelas
    }
}
