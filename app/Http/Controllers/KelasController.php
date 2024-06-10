<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

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
            'tingkat_kelas' => 'required|integer',
            'nama_kelas' => 'required|string|max:255',
            'id_guru' => 'required|exists:gurus,id',
        ]);

        $kelas = Kelas::create($request->all());
        return response()->json($kelas, 201);
    }

    public function show($id)
    {
        $kelas = Kelas::findOrFail($id);
        return response()->json($kelas);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tingkat_kelas' => 'sometimes|required|integer',
            'nama_kelas' => 'sometimes|required|string|max:255',
            'id_guru' => 'sometimes|required|exists:gurus,id',
        ]);

        $kelas = Kelas::findOrFail($id);
        $kelas->update($request->all());
        return response()->json($kelas, 200);
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return response()->json(null, 204);
    }
}