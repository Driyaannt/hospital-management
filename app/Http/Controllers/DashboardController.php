<?php

namespace App\Http\Controllers;

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

        // Kirim data ke view
        return view('layouts.dashboard.dashboard', compact('adminCount', 'apotekerCount', 'perawatCount', 'dokterCount', 'totalCount'));
    }
}
