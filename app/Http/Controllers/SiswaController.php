<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['index', 'show']]);
    }

    public function index()
    {
        try {
            $siswa = Siswa::with('kelas')->get(); // Mengambil data kelas juga
            return response()->json($siswa);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching data'], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $this->validate($request, [
                'nisn_siswa' => 'required|integer|unique:siswas',
                'nama_siswa' => 'required|string|max:255',
                'jns_kelamin' => 'required|string|max:1',
                'tgl_lahir' => 'required|date',
                'alamat' => 'required|string|max:255',
                'kode_kelas' => 'required|exists:kelas,kode_kelas', // Validasi kode_kelas
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }

        try {
            $siswa = Siswa::create($request->all());
            return response()->json($siswa, 201);
        } catch (QueryException $e) {
            return response()->json(['error' => 'Error saving data: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function show($nisn_siswa)
    {
        try {
            $siswa = Siswa::with('kelas')->findOrFail($nisn_siswa); // Mengambil data kelas juga
            return response()->json($siswa);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Siswa not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while fetching data'], 500);
        }
    }

    public function update(Request $request, $nisn_siswa)
    {
        try {
            $this->validate($request, [
                'nama_siswa' => 'sometimes|required|string|max:255',
                'jns_kelamin' => 'sometimes|required|string|max:1',
                'tgl_lahir' => 'sometimes|required|date',
                'alamat' => 'sometimes|required|string|max:255',
                'kode_kelas' => 'sometimes|required|exists:kelas,kode_kelas', // Validasi kode_kelas
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->errors()], 422);
        }

        try {
            $siswa = Siswa::findOrFail($nisn_siswa);
            $siswa->update($request->all());
            return response()->json($siswa, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Siswa not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'An error occurred while updating data: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function destroy($nisn_siswa)
    {
        try {
            $siswa = Siswa::findOrFail($nisn_siswa);
            $siswa->delete();
            return response()->json(null, 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Siswa not found'], 404);
        } catch (QueryException $e) {
            return response()->json(['error' => 'An error occurred while deleting data: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
}
