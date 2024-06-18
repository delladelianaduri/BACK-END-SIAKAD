<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class NilaiController extends Controller
{
    public function index()
    {
        $nilai = Nilai::all();
        return response()->json($nilai);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn_siswa' => 'required|exists:siswas,nisn_siswa',
            'nama_siswa' => 'required|string|max:255',
            'presensi' => 'required|numeric',
            'tugas' => 'required|numeric',
            'uts' => 'required|numeric',
            'uas' => 'required|numeric',
            'nilai_akhir' => 'required|numeric',
        ]);

        $nilai = Nilai::create($request->all());
        return response()->json($nilai, 201);
    }

    public function show($id)
    {
        $nilai = Nilai::find($id);
        if (!$nilai) {
            return response()->json(['message' => 'Nilai not found'], 404);
        }
        return response()->json($nilai);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nisn_siswa' => 'required|exists:siswas,nisn_siswa',
            'nama_siswa' => 'required|string|max:255',
            'presensi' => 'required|numeric',
            'tugas' => 'required|numeric',
            'uts' => 'required|numeric',
            'uas' => 'required|numeric',
            'nilai_akhir' => 'required|numeric',
        ]);

        $nilai = Nilai::find($id);
        if (!$nilai) {
            return response()->json(['message' => 'Nilai not found'], 404);
        }

        $nilai->update($request->all());
        return response()->json($nilai);
    }

    public function destroy($id)
    {
        $nilai = Nilai::find($id);
        if (!$nilai) {
            return response()->json(['message' => 'Nilai not found'], 404);
        }

        $nilai->delete();
        return response()->json(['message' => 'Nilai deleted successfully']);
    }
}