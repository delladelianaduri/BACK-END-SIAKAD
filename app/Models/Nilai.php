<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    protected $fillable = ['nisn_siswa', 'nama_siswa', 'presensi', 'tugas', 'uts', 'uas', 'nilai_akhir'];
    protected $table = 'nilai';

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn_siswa');
    }
}