<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;

class GuruBiodataController extends Controller
{
    public function show($id)
    {
        $guru = Guru::findOrFail($id);

        $data = [
            'no_induk' => $guru->no_induk,
            'nama' => $guru->nama,
            'kedudukan' => $guru->kedudukan,
            'alamat' => $guru->alamat,
            // Add more fields as needed
        ];

        return response()->json($data);
    }
}
