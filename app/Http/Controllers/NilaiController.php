<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class NilaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $nilai = Nilai::all();
        return response()->json($nilai);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn_siswa' => 'required|exists:siswas,nisn',
            'nama_siswa' => 'required|string|max:255',
            'presensi' => 'required|integer',
            'tugas' => 'required|integer',
            'uts' => 'required|integer',
            'uas' => 'required|integer',
            'nilai_akhir' => 'required|integer',
        ]);

        $nilai = Nilai::create($request->all());
        return response()->json($nilai, 201);
    }

    public function show($id)
    {
        $nilai = Nilai::findOrFail($id);
        return response()->json($nilai);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nisn_siswa' => 'sometimes|required|exists:siswas,nisn',
            'nama_siswa' => 'sometimes|required|string|max:255',
            'presensi' => 'sometimes|required|integer',
            'tugas' => 'sometimes|required|integer',
            'uts' => 'sometimes|required|integer',
            'uas' => 'sometimes|required|integer',
            'nilai_akhir' => 'sometimes|required|integer',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($request->all());
        return response()->json($nilai, 200);
    }

    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();
        return response()->json(null, 204);
    }
}