<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $primaryKey = 'nisn_siswa';

    protected $fillable = [
        'nisn_siswa',
        'nama_siswa',
        'jns_kelamin',
        'tgl_lahir',
        'alamat',
        'kode_kelas',
    ];

    public function kelas()
    {
         return $this->belongsTo(Kelas::class, 'kode_kelas', 'kode_kelas');
    }
}
