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
            'id_guru' => 'required|integer',
        ]);

        $guru = Guru::create($request->all());
        return response()->json($guru, 201);
    }

    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return response()->json($guru);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'sometimes|required|string|max:100',
            'kedudukan' => 'sometimes|required|in:PNS,Non-PNS',
            'alamat' => 'sometimes|required|string|max:255',
            'id_guru' => 'sometimes|required|integer',
        ]);

        $guru = Guru::findOrFail($id);
        $guru->update($request->all());
        return response()->json($guru, 200);
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return response()->json(null, 204);
    }
}