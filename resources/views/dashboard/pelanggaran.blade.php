@extends('layouts.app')
<title>Pelanggaran - Sistem Parkir</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Pelanggaran</h6>
                </div>
                <div class="col-lg-6 col-5 text-right text-white">
                    <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-lg">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="/parkir/masuk">Parkir Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/parkir/keluar">Parkir Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/parkir/fault">Pelanggaran</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="row icon-examples">
                        <div class="col-lg-12 mb-4">
                            <div class="card-group">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Input Pelanggaran Pengendara</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="container">
                                            <form action="/parkir/fault" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <div class="form-group row">
                                                    <label for="tanggal" class="col-sm-12 col-form-label">Jika tiket parkir atau kunci kendaraan hilang : </label>
                                                    <label for="tanggal" class="col-sm-12 col-form-label">1. Pastikan terlebih dahulu pemilik kendaraan membawa STNK untuk memastikan bahwa benar pemiliknya.</label>
                                                    <label for="tanggal" class="col-sm-12 col-form-label">2. Jika sudah dipastikan, silahkan pilih jenis pelanggaran dan input nomor polisi kendaraan.</label>
                                                    <label for="tanggal" class="col-sm-12 col-form-label">3. Jika pengendara tidak membawa STNK, maka menambah pelanggaran dan sesuaikan dengan jenis pelanggaran.</label>
                                                </div>
                                                <fieldset class="form-group row">
                                                    <legend class="col-form-label col-sm-4 float-sm-left pt-0">Jenis Pelanggaran</legend>
                                                    <div class="col-sm-8 p-0">
                                                        <select class="custom-select" name="role_pelanggaran" id="validationTooltip04" required>
                                                            @forelse($penalti as $a)
                                                            <option value="{{$a->role_pelanggaran}}">{{$a->nama_pelanggaran}}</option>
                                                            @empty
                                                            <option value="">Jenis pelanggaran belum ditambahkan ke master</option>
                                                            @endforelse
                                                        </select>
                                                    </div>
                                                </fieldset>
                                                <div class="form-group row">
                                                    <label for="nomor" class="col-sm-4 col-form-label">Nomor Polisi </label>
                                                    <div class="col-sm-7 p-0">
                                                        <input type="text" class="form-control" id="no_polisi" name="no_polisi">
                                                    </div>
                                                    <div class="col-sm-1">
                                                        <button type="submit" class="btn btn-primary">Cari</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!$getParkir && !$alert)
                        @elseif ($alert == 'keluar')
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1">Info Kendaraan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-lg text-center" style="margin-top:10px;">
                                        <h5>NOMOR POLISI YANG DICARI SUDAH KELUAR (KENDARAAN SUDAH KELUAR PARKIR)</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($alert == 'notCode')
                        <div class="col-lg">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="mt-1">Info Kendaraan</h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-lg text-center" style="margin-top:10px;">
                                        <h5>NOMOR POLISI TIDAK DITEMUKAN</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @elseif ($getParkir)
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
                                            <li class="list-group-item font-weight-bold">Pelanggaran</li>
                                            <li class="list-group-item font-weight-bold">Biaya Parkir</li>
                                            <li class="list-group-item font-weight-bold">Denda</li>
                                            <li class="list-group-item font-weight-bold">Total</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-8">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">{{$getVehicle->no_polisi}}</li>
                                            <li class="list-group-item">{{$getVehicle->jenis_kendaraan}}</li>
                                            <li class="list-group-item">{{$getParkir->waktu_masuk}}</li>
                                            <li class="list-group-item">{{$getParkir->waktu_keluar}}</li>
                                            <li class="list-group-item">{{$pelanggaran->nama_pelanggaran}}</li>
                                            <li class="list-group-item">Rp. {{number_format($harga, 0, ',', '.')}}</li>
                                            <li class="list-group-item">Rp. {{number_format($pelanggaran->denda, 0, ',', '.')}}</li>
                                            <li class="list-group-item text-danger" style="font-size: 30px !important;">{{$hasil_rupiah}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection