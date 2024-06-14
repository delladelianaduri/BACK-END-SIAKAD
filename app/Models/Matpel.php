<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas; // Import model Kelas

class Matpel extends Model
{
    use HasFactory;

    protected $table = 'matpels'; // Menetapkan nama tabel yang digunakan oleh model Matpel

    protected $primaryKey = 'kd_matpel'; // Menetapkan primary key menjadi 'kd_matpel'

    protected $fillable = [
        'kd_matpel', 'nama_matpel', 'kode_kelas',
    ];

    // Relasi dengan model Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kode_kelas', 'kode_kelas'); // Menghubungkan relasi dengan model Kelas
    }
}