<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;

class PresensiController extends Controller
{
    public function index()
    {
        $presensi = Presensi::with(['siswas', 'kelas'])->get();
        return response()->json($presensi);
    }

    public function show($id)
    {
        $presensi = Presensi::with(['siswas', 'kelas'])->find($id);
        if (!$presensi) {
            return response()->json(['message' => 'Presensi not found'], 404);
        }
        return response()->json($presensi);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn_siswa' => 'required|exists:siswas,nisn_siswa',
            'kode_kelas' => 'required|exists:kelas,kode_kelas',
            'tgl_presensi' => 'required|date',
            'status' => 'required|in:sakit,izin,alpha,hadir',
            'nama_siswa' => 'required|string|max:255'
        ]);

        $presensi = Presensi::create($request->all());
        return response()->json($presensi, 201);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nisn_siswa' => 'required|exists:siswas,nisn_siswa',
            'kode_kelas' => 'required|exists:kelas,kode_kelas',
            'tgl_presensi' => 'required|date',
            'status' => 'required|in:hadir,sakit,izin,alpha',
        ]);

        $presensi = Presensi::find($id);
        if (!$presensi) {
            return response()->json(['message' => 'Presensi not found'], 404);
        }

        $presensi->update($request->all());
        return response()->json($presensi);
    }

    public function destroy($id)
    {
        $presensi = Presensi::find($id);
        if (!$presensi) {
            return response()->json(['message' => 'Presensi not found'], 404);
        }

        $presensi->delete();
        return response()->json(['message' => 'Presensi deleted successfully']);
    }

    public function groupedByStatus()
    {
        $hadir = Presensi::with(['siswas', 'kelas'])->where('status', 'hadir')->get();
        $sakit = Presensi::with(['siswas', 'kelas'])->where('status', 'sakit')->get();
        $izin = Presensi::with(['siswas', 'kelas'])->where('status', 'izin')->get();
        $alpha = Presensi::with(['siswas', 'kelas'])->where('status', 'alpha')->get();

        return response()->json([
            'hadir' => $hadir,
            'sakit' => $sakit,
            'izin' => $izin,
            'alpha' => $alpha,
        ]);
    }
}
