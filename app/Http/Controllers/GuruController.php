<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;

class GuruController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $gurus = Guru::all();
        return response()->json($gurus);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'no_induk' => 'required|integer|unique:gurus',
            'nama' => 'required|string|max:100',
            'kedudukan' => 'required|in:PNS,Non-PNS',
            'alamat' => 'required|string|max:255',
            'user_id' => 'required|integer|exists:users,id', // Pastikan user_id valid dan ada di tabel users
        ]);

        // Membuat data guru dengan user_id yang diberikan
        $guru = Guru::create([
            'no_induk' => $request->input('no_induk'),
            'nama' => $request->input('nama'),
            'kedudukan' => $request->input('kedudukan'),
            'alamat' => $request->input('alamat'),
            'user_id' => $request->input('user_id'),
        ]);

        return response()->json($guru, 201);
    }

    public function show($no_induk)
    {
        $guru = Guru::findOrFail($no_induk);
        return response()->json($guru);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'no_induk' => 'sometimes|required|integer|unique:gurus,no_induk,' . $id,
            'nama' => 'sometimes|required|string|max:100',
            'kedudukan' => 'sometimes|required|in:PNS,Non-PNS',
            'alamat' => 'sometimes|required|string|max:255',
            'user_id' => 'sometimes|required|integer|exists:users,id', // Pastikan user_id valid dan ada di tabel users
        ]);

        // Memperbarui data guru dengan user_id yang diberikan
        $guru = Guru::findOrFail($id);
        $guru->update([
            'no_induk' => $request->input('no_induk', $guru->no_induk),
            'nama' => $request->input('nama', $guru->nama),
            'kedudukan' => $request->input('kedudukan', $guru->kedudukan),
            'alamat' => $request->input('alamat', $guru->alamat),
            'user_id' => $request->input('user_id', $guru->user_id),
        ]);

        return response()->json($guru, 200);
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return response()->json(null, 204);
    }
}
