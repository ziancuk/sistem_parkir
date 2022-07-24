<?php

namespace App\Http\Controllers;

use App\Models\Parking;

class DashboardController extends Controller
{
    public function index(Parking $parking)
    {
        // Resume Kendaraan
        $total = Parking::where('status', 'Masuk')->count();
        $mobil = Parking::whereHas('vehicle', function ($query) {
            $query->where('jenis_kendaraan', 'Mobil');
        })->where('status', 'Masuk')->count();
        $motor = Parking::whereHas('vehicle', function ($query) {
            $query->where('jenis_kendaraan', 'Motor');
        })->where('status', 'Masuk')->count();

        $pendapatan = Parking::sum('biaya');
        $parkirIncome = Parking::where('fault_id', null)->sum('biaya');
        $denda = $pendapatan - $parkirIncome;

        // Data Master
        $fault = Parking::whereNotNull('fault_id')->paginate(5);
        $master = Parking::with('user', 'vehicle')->orderBy('created_at', 'desc')->paginate(5);
        return view('dashboard.index', compact('master', 'total', 'mobil', 'motor', 'fault', 'pendapatan', 'parkirIncome', 'denda'));
    }
}
