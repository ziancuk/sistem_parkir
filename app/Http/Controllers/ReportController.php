<?php

namespace App\Http\Controllers;

use App\Exports\KendaraanExport;
use App\Exports\MttRegistrationsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Parking;
use PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getReport()
    {
        // return variabel dengan nilai null agar tidak menampilkan data apapun
        $kendaraan = null;
        $total = null;
        return view('dashboard.report', compact('kendaraan', 'total'));
    }

    public function report(Request $request)
    {
        // Validasi form filter laporan
        $request->validate(
            [
                'start_date' => 'required',
                'end_date' => 'required',
                'jenis_kendaraan' => 'required',
                'jenis_parkir' => 'required'
            ],
            [
                'required' => 'Form tidak boleh kosong!'
            ]
        );

        // Query data sesuai dengan filter yang diipilih
        if ($request->jenis_kendaraan == 'All' && $request->jenis_parkir == 'All') {
            $kendaraan = Parking::with('vehicle', 'fault')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
            $vehicle = Parking::with('vehicle', 'fault')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        } else if ($request->jenis_kendaraan == 'All') {
            $kendaraan = Parking::with('vehicle', 'fault')->whereNotNull('fault_id')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
            $vehicle = Parking::with('vehicle', 'fault')->whereNotNull('fault_id')->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        } else if ($request->jenis_parkir == 'All') {
            $kendaraan = Parking::with('vehicle', 'fault')->whereHas('vehicle', function ($query) use ($request) {
                $query->where('jenis_kendaraan', $request->jenis_kendaraan);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
            $vehicle = Parking::with('vehicle', 'fault')->whereHas('vehicle', function ($query) use ($request) {
                $query->where('jenis_kendaraan', $request->jenis_kendaraan);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        } else {
            $kendaraan = Parking::with('vehicle', 'fault')->whereNotNull('fault_id')->whereHas('vehicle', function ($query) use ($request) {
                $query->where('jenis_kendaraan', $request->jenis_kendaraan);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59'])->get();
            $vehicle = Parking::with('vehicle', 'fault')->whereNotNull('fault_id')->whereHas('vehicle', function ($query) use ($request) {
                $query->where('jenis_kendaraan', $request->jenis_kendaraan);
            })->whereBetween('created_at', [$request->start_date . ' 00:00:00', $request->end_date . ' 23:59:59']);
        }
        // Menghitung total semua kendaraan
        $countKendaraan = $kendaraan->count();

        // Menghitung total pendapatan
        $pendapatan = $kendaraan->sum('biaya');

        // Menghitung total mobil
        $countMobil = $vehicle->whereHas('vehicle', function ($query) {
            $query->where('jenis_kendaraan', 'Mobil');
        })->count();

        // Menghitung total motor
        $countMotor = $kendaraan->count() - $vehicle->count();

        // Menghitung total pelanggaran
        $pelanggaran = $kendaraan->whereNotNull('fault_id')->count();

        // Mencetak laporan pada web, pdf, atau excel
        if ($request->button == "submit") {
            $awal = $request->start_date;
            $akhir = $request->end_date;
            $jenis_kendaraan = $request->jenis_kendaraan;
            $jenis_parkir = $request->jenis_parkir;
            return view('dashboard.report', compact('kendaraan', 'countKendaraan', 'countMobil', 'countMotor', 'awal', 'akhir', 'jenis_kendaraan', 'jenis_parkir', 'pendapatan', 'pelanggaran'));
        } else if ($request->button == "pdf") {
            $pdf = PDF::loadView('dashboard.generatePDF', compact('kendaraan'));
            return $pdf->download('report-parking.pdf');
        } else if ($request->button == "csv") {
            return Excel::download(new KendaraanExport($kendaraan), 'report-parking.xlsx');
        }
    }

    public function detailKendaraan(Parking $parking)
    {
        //query ke tabel parkir
        $getParkir = $parking->where('kode_parkir', $parking->kode_parkir)->with('vehicle', 'user', 'fault')->first();
        return view('dashboard.detailKendaraan', compact('getParkir'));
    }
}
