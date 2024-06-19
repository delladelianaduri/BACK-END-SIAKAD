<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;

class GuruBiodataController extends Controller
{
    public function show($id)
    {
        $guru = Guru::findOrFail($id);

        $data = [
            'nomor_induk' => $guru->nomor_induk,
            'nama_guru' => $guru->nama_guru,
            'kedudukan' => $guru->kedudukan,
            'alamat' => $guru->alamat,
            // Add more fields as needed
        ];

        return response()->json($data);
    }
}
