<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $siswa = Siswa::all();
        return response()->json($siswa);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nisn_siswa' => 'required|integer|unique:siswa,nisn_siswa',
            'nama_siswa' => 'required|string|max:255',
            'jns_kelamin' => 'required|string|max:1',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
        ]);

        $siswa = Siswa::create($request->all());
        return response()->json($siswa, 201);
    }

    public function show($id)
    {
        $siswa = Siswa::findOrFail($id);
        return response()->json($siswa);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_siswa' => 'sometimes|required|string|max:255',
            'jns_kelamin' => 'sometimes|required|string|max:1',
            'tgl_lahir' => 'sometimes|required|date',
            'alamat' => 'sometimes|required|string|max:255',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->all());
        return response()->json($siswa, 200);
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return response()->json(null, 204);
    }
}