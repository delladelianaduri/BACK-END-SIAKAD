<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Presensi;

class NilaiController extends Controller
{
    public function index()
    {
        // Mengambil semua nilai dan menyertakan data presensi
        $nilai = Nilai::with('presensi')->get();

        // Mengubah kolom presensi berdasarkan data dari tabel presensi
        $nilai->each(function ($item) {
            $item->presensi = $item->getPresensiValue();
        });

        return response()->json($nilai);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn_siswa' => 'required|exists:siswas,nisn_siswa',
            'nama_siswa' => 'required|string|max:255',
            'tugas' => 'required|numeric',
            'uts' => 'required|numeric',
            'uas' => 'required|numeric',
            'nilai_akhir' => 'required|numeric',
        ]);

        // Mengambil nilai presensi dari tabel presensi
        $presensi = Presensi::where('nisn_siswa', $request->nisn_siswa)->first();
        $request->merge(['presensi' => $presensi ? $presensi->status : null]);

        $nilai = Nilai::create($request->all());
        return response()->json($nilai, 201);
    }

    public function show($id)
    {
        $nilai = Nilai::with('presensi')->find($id);
        if (!$nilai) {
            return response()->json(['message' => 'Nilai not found'], 404);
        }

        $nilai->presensi = $nilai->getPresensiValue();

        return response()->json($nilai);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nisn_siswa' => 'required|exists:siswas,nisn_siswa',
            'nama_siswa' => 'required|string|max:255',
            'tugas' => 'required|numeric',
            'uts' => 'required|numeric',
            'uas' => 'required|numeric',
            'nilai_akhir' => 'required|numeric',
        ]);

        $nilai = Nilai::find($id);
        if (!$nilai) {
            return response()->json(['message' => 'Nilai not found'], 404);
        }

        // Mengambil nilai presensi dari tabel presensi
        $presensi = Presensi::where('nisn_siswa', $request->nisn_siswa)->first();
        $request->merge(['presensi' => $presensi ? $presensi->status : null]);

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