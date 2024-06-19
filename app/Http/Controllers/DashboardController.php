<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru; // Assuming you have a 'Guru' model
use App\Models\Siswa; // Assuming you have a 'Siswa' model

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch data for the charts
        $totalGuru = Guru::count();
        $guruPNS = Guru::where('status', 'PNS')->count();
        $guruNonPNS = Guru::where('status', 'Non PNS')->count();

        $totalSiswa = Siswa::count();
        $lakiLaki = Siswa::where('jenis_kelamin', 'Laki-laki')->count();
        $perempuan = Siswa::where('jenis_kelamin', 'Perempuan')->count();

        // Calculate percentages
        $guruPNSPercentage = ($guruPNS / $totalGuru) * 100;
        $guruNonPNSPercentage = ($guruNonPNS / $totalGuru) * 100;

        $lakiLakiPercentage = ($lakiLaki / $totalSiswa) * 100;
        $perempuanPercentage = ($perempuan / $totalSiswa) * 100;

        // Prepare data for the API response
        $data = [
            'guruStatus' => [
                [
                    'label' => 'PNS',
                    'value' => $guruPNS,
                    'percentage' => $guruPNSPercentage,
                ],
                [
                    'label' => 'Non PNS',
                    'value' => $guruNonPNS,
                    'percentage' => $guruNonPNSPercentage,
                ],
            ],
            'genderRatio' => [
                [
                    'label' => 'Laki-laki',
                    'value' => $lakiLaki,
                    'percentage' => $lakiLakiPercentage,
                ],
                [
                    'label' => 'Perempuan',
                    'value' => $perempuan,
                    'percentage' => $perempuanPercentage,
                ],
            ],
        ];

        return response()->json($data);
    }
}
