<?php

namespace App\Http\Controllers;

use App\Models\AssesmenModel;
use App\Models\PatientsModel;
use Illuminate\Http\Request;
use App\Models\UserModel;

class DashboardController extends Controller
{
    public function index()
    {
        $adminCount = UserModel::where('role', 'admin')->count();
        $apotekerCount = UserModel::where('role', 'apoteker')->count();
        $perawatCount = UserModel::where('role', 'perawat')->count();
        $dokterCount = UserModel::where('role', 'dokter')->count();

        $totalCount = UserModel::all()->count();

        $totalPatients = PatientsModel::count();
        $totalIgdRujuk = AssesmenModel::where('keterangan_terakhir', 'IGD - Rujuk')->count();
        $totalIgdRawat = AssesmenModel::where('keterangan_terakhir', 'IGD - Rawat')->count();
        $totalIgdPulang = AssesmenModel::where('keterangan_terakhir', 'IGD - Pulang')->count();
        $totalIgdMeninggal = AssesmenModel::where('keterangan_terakhir', 'IGD - Meninggal')->count();


        // Kirim data ke view
        return view('layouts.dashboard.dashboard', compact('adminCount', 'apotekerCount', 'perawatCount', 'dokterCount', 'totalCount', 'totalPatients','totalIgdRujuk', 'totalIgdRawat', 'totalIgdPulang', 'totalIgdMeninggal'));
    }
}
