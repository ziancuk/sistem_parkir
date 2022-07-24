<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KendaraanExport implements FromCollection, WithMapping, WithHeadings
{

    protected $kendaraan;

    function __construct($kendaraan)
    {
        $this->kendaraan = $kendaraan;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->kendaraan;
    }
    public function map($member): array
    {
        $data = array(
            $member->vehicle->no_polisi,
            $member->vehicle->jenis_kendaraan
        );
        $data[$member->waktu_masuk] = $member->waktu_masuk;
        if ($member->waktu_keluar == null) {
            $data[$member->status] = "Tidak Melakukan Pelanggaran";
        } else {
            $data[$member->waktu_keluar] = $member->waktu_keluar;
        }
        $data[$member->biaya] = $member->biaya;
        if ($member->fault_id == null) {
            $data[$member->status] = "Tidak Melakukan Pelanggaran";
        } else {
            $data[$member->status] = $member->fault->nama_pelanggaran;
        }
        return $data;
    }

    // this is fine
    public function headings(): array
    {
        return [
            'Nomor Polisi',
            'Kendaraan',
            'Waktu Masuk',
            'Waktu Keluar',
            'Biaya',
            'Pelanggaran'
        ];
    }
}
