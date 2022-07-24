<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Fault;
use App\Models\Parking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    public function getParkirMasuk()
    {
        $parkir = null;
        return view('dashboard.parkirMasuk', compact('parkir'));
    }

    public function postParkirMasuk(Request $request, Parking $parking)
    {
        // Validasi terhadap data kendaraan masuk yang diinput
        $this->validate(
            $request,
            [
                'no_polisi' => 'required|max:12',
                'jenis_kendaraan' => 'required'
            ],
            [
                'no_polisi.required' => 'Nomor Polisi Tidak Boleh Kosong',
                'jenis_kendaraan.required' => 'Jenis Pengendara Tidak Boleh Kosong',
                'max' => 'Nomor Polisi Maksimal 12 Karakter Termasuk Spasi'
            ]
        );

        // Melakukan cek pada database apakah data kendaraan sudah ada dan belum keluar parkir.
        $getVehicle = Vehicle::where('no_polisi', str_replace(' ', '', strtoupper($request->no_polisi)))->latest()->first();
        if ($getVehicle) {
            $getParkir = Parking::with('vehicle')->where('vehicle_id', $getVehicle->vehicle_id)->first();
            if ($getParkir->status == 'Masuk') {
                $parkir = 'belumKeluar';
                return view('dashboard.parkirMasuk', compact('parkir'));
            }
        }

        // Membuat Kode Parkir
        $hari = substr(Carbon::now()->setTimezone('Asia/Jakarta')->isoFormat('dddd'), 0, 1);
        $today = Carbon::now()->isoFormat('DMMYY');
        $last = $parking->latest('created_at')->first();
        if ($last) {
            $no = substr($last->kode_parkir, 9, 5);
            $no++;
            $kode_parkir = $hari . $today . sprintf("%05s", $no);
        } else {
            $kode_parkir = $hari . $today . sprintf("%05s", 1);
        }

        $date = Carbon::now()->setTimezone('Asia/Jakarta')->toDateTimeString();
        // Menyimpan data kendaraan ke tabel vehicle
        $pengendara = Vehicle::create([
            'no_polisi' => str_replace(' ', '', strtoupper($request->no_polisi)),
            'jenis_kendaraan' => $request->jenis_kendaraan
        ]);
        // Menyimpan data ke tabel parking
        $parkir = $parking->create([
            'kode_parkir' => $kode_parkir,
            'user_id' => Auth::user()->user_id,
            'vehicle_id' => $pengendara->vehicle_id,
            'waktu_masuk' => $date,
            'biaya' => 3000,
            'petugas_out' => 'Belum Keluar',
            'status' => 'Masuk'
        ]);

        return view('dashboard.parkirMasuk', compact('parkir', 'date', 'kode_parkir'));
    }

    public function ParkirKeluar(Request $request)
    {
        //query tabel parkir sesuai dengan kode dari request

        $getParkir = Parking::with('vehicle', 'user', 'fault')->where('kode_parkir', $request->kode_parkir)->first();

        if ($getParkir) {
            //validasi kode parkir apakah kode sudah pernah dipakai atau tidak
            if ($getParkir->status == 'Keluar') {
                $parkir = 'keluar';
                return view('dashboard.parkirKeluar', compact('getParkir', 'parkir'));
            } else {
                //jika kode parkir sesuai, menghitung selisih jam masuk ke jam keluar sekaligus menentukan biaya
                $waktu_keluar = Carbon::now()->setTimezone('Asia/Jakarta');
                $keluar = strtotime($waktu_keluar);
                $waktu_masuk = strtotime($getParkir->waktu_masuk);

                $diff = $keluar - $waktu_masuk;
                if (floor($diff / (60 * 60)) == 0.0) {
                    $biaya = $getParkir->biaya;
                } else {
                    $jam = floor($diff / (60 * 60));
                    $biaya  = $getParkir->biaya * ceil($jam);
                }
                $hasil_rupiah = "Rp " . number_format($biaya, 0, ',', '. ');

                //update data ke tabel parking
                $getParkir->update([
                    'waktu_keluar' => $waktu_keluar,
                    'biaya' => $biaya,
                    'petugas_out' => Auth::user()->user_id,
                    'status' => 'Keluar'
                ]);
                $parkir = 'bayar';
                return view('dashboard.parkirKeluar', compact('getParkir', 'parkir', 'hasil_rupiah'));
            }
        } else if ($request->kode_parkir) {
            $parkir = 'notCode';
            return view('dashboard.parkirKeluar', compact('getParkir', 'parkir'));
        } else {
            $parkir = null;
            return view('dashboard.parkirKeluar', compact('getParkir', 'parkir'));
        }
    }

    public function Pelanggaran(Request $request, Parking $parking)
    {
        // Query data pelanggaran pada tabel Fault
        $penalti = Fault::get();

        // Query data parkir sesuai dengan kode dari request
        $getVehicle = Vehicle::where('no_polisi', str_replace(' ', '', strtoupper($request->no_polisi)))->latest()->first();
        if ($getVehicle) {
            $getParkir = $parking->with('user', 'vehicle', 'fault')->where('vehicle_id', $getVehicle->vehicle_id)->first();
        } else {
            $getParkir = null;
        }
        if ($getParkir) {
            // validasi kendaraan apakah kendaraan masih ada atau sudah keluar
            if ($getParkir->status !== 'Masuk') {
                $alert = 'keluar';
                return view('dashboard.pelanggaran', compact('getParkir', 'alert', 'penalti'));
            } else {
                //jika kode parkir sesuai
                $waktu_keluar = Carbon::now()->setTimezone('Asia/Jakarta');
                $keluar = strtotime($waktu_keluar);
                $waktu_masuk = strtotime($getParkir->waktu_masuk);
                $pelanggaran = Fault::where('role_pelanggaran', $request->role_pelanggaran)->first();

                $diff = $keluar - $waktu_masuk;
                if (floor($diff / (60 * 60)) == 0.0) {
                    $harga = $getParkir->biaya;
                    $biaya = $harga + $pelanggaran->denda;
                } else {
                    $jam = floor($diff / (60 * 60));
                    $harga  = $getParkir->biaya * ceil($jam);
                    $biaya = $harga + $pelanggaran->denda;
                }
                $hasil_rupiah = "Rp " . number_format($biaya, 0, ',', '. ');

                //update data ke tabel parkir
                $getParkir->update([
                    'fault_id' => $pelanggaran->fault_id,
                    'biaya' => $biaya,
                    'waktu_keluar' => $waktu_keluar,
                    'petugas_out' => Auth::user()->name,
                    'status' => 'Keluar'
                ]);
                $alert = 'bayar';
                return view('dashboard.pelanggaran', compact('getParkir', 'hasil_rupiah', 'alert', 'getVehicle', 'pelanggaran', 'penalti', 'biaya', 'harga'));
            }
        } else if ($request->no_polisi) {
            $alert = 'notCode';
            return view('dashboard.pelanggaran', compact('getParkir', 'alert', 'penalti'));
        } else {
            $alert = null;
            return view('dashboard.pelanggaran', compact('getParkir', 'alert', 'penalti'));
        };
        return view('dashboard.pelanggaran');
    }
    public function destroyKendaraan(Parking $parking)
    {
        Vehicle::where('vehicle_id', $parking->vehicle_id)->delete();
        return redirect('/report')->with('status', 'Data telah dihapus');
    }
}
