@extends('layouts.app')
<title>Detail Kendaraan - Sistem Parkir</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Detail kendaraan</h6>
                </div>
                <div class="col-lg-6 col-5 text-right text-white">
                    <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <h5 class="mt-1">Kode Parkir : {{$getParkir->kode_parkir}}</h5>
                </div>
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-bold">Nomor Polisi</li>
                            <li class="list-group-item font-weight-bold">Jenis Kendaraan</li>
                            <li class="list-group-item font-weight-bold">Waktu Masuk</li>
                            <li class="list-group-item font-weight-bold">Waktu Keluar</li>
                            <li class="list-group-item font-weight-bold">Status</li>
                            <li class="list-group-item font-weight-bold">Biaya</li>
                            <li class="list-group-item font-weight-bold">Petugas Parkir Masuk</li>
                            <li class="list-group-item font-weight-bold">Petugas Parkir Keluar</li>
                            <li class="list-group-item font-weight-bold">Pelanggaran</li>
                        </ul>
                    </div>
                    <div class="col-lg-8">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$getParkir->vehicle->no_polisi}}</li>
                            <li class="list-group-item">{{$getParkir->vehicle->jenis_kendaraan}}</li>
                            <li class="list-group-item">{{$getParkir->waktu_masuk}}</li>
                            @if($getParkir->waktu_keluar)
                            <li class="list-group-item">{{$getParkir->waktu_keluar}}</li>
                            @else
                            <li class="list-group-item">Belum Keluar</li>
                            @endif
                            <li class="list-group-item">{{$getParkir->status}}</li>
                            @if($getParkir->waktu_keluar)
                            <li class="list-group-item">Rp. {{number_format($getParkir->biaya, 0, ',', '.')}}</li>
                            @else
                            <li class="list-group-item">Belum Keluar</li>
                            @endif
                            <li class="list-group-item">{{$getParkir->user->name}}</li>
                            @if($getParkir->waktu_keluar)
                            <li class="list-group-item">{{$getParkir->petugas_out}}</li>
                            @else
                            <li class="list-group-item">Belum Keluar</li>
                            @endif
                            @if($getParkir->fault_id !== null)
                            <li class="list-group-item">{{$getParkir->fault->nama_pelanggaran}}</li>
                            @else
                            <li class="list-group-item">Tidak Melakakukan Pelanggaran</li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg p-4 text-right">
                    <form action="/delete/{{$getParkir->kode_parkir}}/kendaraan" method="POST">
                        @csrf
                        @method("delete")
                        @if(Auth::user()->role == '1')
                        <button type="submit" onclick="return confirm('Anda yakin ingin menghapusnya?')" class="btn btn-danger delete-campaign">Hapus</button>
                        @endif
                        <form>
                            <input type="button" class="btn btn-primary text-right" value="Kembali" onclick="history.back()"></input>
                        </form>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection