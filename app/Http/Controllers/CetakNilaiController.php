<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;

class CetakNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilai = Nilai::all();
        $cetak_nilai = [];

        foreach ($nilai as $n) {
            $nilai_akhir = $n->presensi + $n->tugas + $n->uas + $n->uts;

            if ($nilai_akhir >= 75) {
                $status = 'LULUS';
            } else {
                $status = 'TIDAK LULUS';
            }

            $cetak_nilai[] = [
                'nama' => $n->nama,
                'ata_pelajaran' => $n->mata_pelajaran,
                'presensi' => $n->presensi,
                'tugas' => $n->tugas,
                'uas' => $n->uas,
                'uts' => $n->uts,
                'nilai_akhir' => $nilai_akhir,
                'tatus' => $status,
            ];
        }

        return response()->json($cetak_nilai);
    }
}
