<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User; // Import model User

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus'; // Menetapkan nama tabel yang digunakan oleh model Guru

    protected $primaryKey = 'id'; // Menetapkan primary key menjadi 'no_induk'

    protected $fillable = [
        'no_induk', 'nama', 'kedudukan', 'alamat', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); // Menghubungkan relasi dengan model User
    }
}
