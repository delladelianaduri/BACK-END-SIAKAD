<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Guru; // Import model Guru

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas'; // Menetapkan nama tabel yang digunakan oleh model Kelas

    protected $primaryKey = 'kode_kelas'; // Menetapkan primary key menjadi 'id_kelas'

    protected $fillable = [
        'kode_kelas', 'nama_kelas', 'no_induk',
    ];

    // Relasi dengan model Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'no_induk', 'id'); // Menghubungkan relasi dengan model Guru
    }
}
