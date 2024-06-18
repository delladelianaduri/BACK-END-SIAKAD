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

    // Definisikan relasi dengan Presensi
    public function presensi()
    {
        return $this->belongsTo(Presensi::class, 'nisn_siswa', 'nisn_siswa');
    }

    // Method untuk mengisi nilai presensi dari tabel presensi
    public function getPresensiValue()
    {
        return $this->presensi ? $this->presensi->status : null;
    }
}