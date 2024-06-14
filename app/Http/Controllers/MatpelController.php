<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matpel;

class MatpelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $matpels = Matpel::all();
        return response()->json($matpels);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'kd_matpel' => 'required|integer|unique:matpels,kd_matpel',
            'nama_matpel' => 'required|string|max:255',
            'kode_kelas' => 'required|exists:kelas,kode_kelas', // Pastikan foreign key sesuai dengan struktur yang ada
        ]);

        $matpel = Matpel::create($request->all());
        return response()->json($matpel, 201);
    }

    public function show($id)
    {
        $matpel = Matpel::findOrFail($id);
        return response()->json($matpel);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_matpel' => 'sometimes|required|string|max:255',
            'kode_kelas' => 'sometimes|required|exists:kelas,kode_kelas', // Pastikan foreign key sesuai dengan struktur yang ada
        ]);

        $matpel = Matpel::findOrFail($id);
        $matpel->update($request->all());
        return response()->json($matpel, 200);
    }

    public function destroy($id)
    {
        $matpel = Matpel::findOrFail($id);
        $matpel->delete();
        return response()->json(null, 204);
    }
}
