<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $primaryKey = 'id_kelas';
    public $incrementing = true;
    protected $fillable = ['tingkat_kelas', 'nama_kelas', 'id_guru'];
    protected $table = 'kelas';

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
}