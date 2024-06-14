<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Database\QueryException;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $kelas = Kelas::all();
        return response()->json($kelas);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kode_kelas' => 'required|integer',
            'nama_kelas' => 'required|string|max:2', // Maksimal 2 karakter
            'no_induk' => 'required|exists:gurus,id',
        ]);

        try {
            $kelas = Kelas::create([
                'kode_kelas' => $request->kode_kelas,
                'nama_kelas' => $request->nama_kelas,
                'no_induk' => $request->no_induk,
            ]);

            return response()->json($kelas, 201);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error
                return response()->json(['error' => 'Duplicate entry for kode_kelas'], 409);
            }
            // Other errors
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json($kelas);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'kode_kelas' => 'sometimes|required|integer',
            'nama_kelas' => 'sometimes|required|string|max:2', // Maksimal 2 karakter
            'no_induk' => 'sometimes|required|exists:gurus,id',
        ]);

        try {
            $kelas = Kelas::findOrFail($id);
            $kelas->update([
                'kode_kelas' => $request->input('kode_kelas', $kelas->kode_kelas),
                'nama_kelas' => $request->input('nama_kelas', $kelas->nama_kelas),
                'no_induk' => $request->input('no_induk', $kelas->no_induk),
            ]);

            return response()->json($kelas, 200);
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                // Duplicate entry error
                return response()->json(['error' => 'Duplicate entry for kode_kelas'], 409);
            }
            // Other errors
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return response()->json(['deleted' => 'data telah dihapus'], 204);
    }
}
