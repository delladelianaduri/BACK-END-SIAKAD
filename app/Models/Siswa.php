<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nisn_siswa';
    public $incrementing = false; // Jika kunci utama bukan auto-increment
    protected $keyType = 'int';

    protected $fillable = [
        'nisn_siswa', 'nama_siswa', 'jns_kelamin', 'tgl_lahir', 'alamat'
    ];
}