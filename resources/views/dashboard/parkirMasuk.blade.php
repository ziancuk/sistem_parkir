@extends('layouts.app')
<title>Parkir Masuk - Sistem Parkir</title>
@section('content')
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h2 text-white d-inline-block mb-0">Parkir Masuk</h6>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/parkir/masuk">Parkir Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/parkir/keluar">Parkir Keluar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/parkir/fault">Pelanggaran</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="row icon-examples">
                        <div class="col-lg">
                            <div class="card-group">
                                <div class="col-lg-6">
                                    <div class="card" style="height: 28rem;">
                                        <div class="card-header">
                                            <h5 class="card-title mb-0">Input Kendaraan Masuk</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container h-100">
                                                <div class="row align-items-center h-100">
                                                    <div class="col mx-auto">
                                                        <form class="" action="/parkir/masuk" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <label for="tanggal" class="col-sm-4 col-form-label" style="font-size:13px;">Tanggal / Waktu</label>
                                                                <div class="col-sm-8">
                                                                    <p class="text-muted mt-1"><span id="tanggal"></span> ; <span id="watch"></span></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                <label for="nomor" class="col-sm-4 col-form-label" style="font-size:13px;">Nomor Polisi</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" id="no_polisi" name="no_polisi">
                                                                    @error('no_polisi')
                                                                    <div class="mt-1">
                                                                        <small class="" style="color: red;">{{$message}}</small>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <fieldset class="form-group row">
                                                                <legend class="col-form-label col-sm-4 float-sm-left p0" style="font-size:13px;">Kendaraan</legend>
                                                                <div class="col-sm-8">
                                                                    <select class="custom-select" name="jenis_kendaraan" id="validationTooltip04" required>
                                                                        <option value="" selected>Pilih Jenis Kendaraan</option>
                                                                        <option value="Motor">Motor</option>
                                                                        <option value="Mobil">Mobil</option>n>
                                                                    </select>
                                                                    @error('jenis_kendaraan')
                                                                    <div class="mt-1">
                                                                        <small class="" style="color: red;">{{$message}}</small>
                                                                    </div>
                                                                    @enderror
                                                                </div>
                                                            </fieldset>

                                                            <div class="form-group row text-right">
                                                                <div class="col-sm mt-4">
                                                                    <button type="submit" class="col-sm btn btn-primary">Submit</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card" style="height: 28rem;">
                                        <div class=" card-header">
                                            <h5 class="card-title mb-0">Tiket parkir</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="container h-100">
                                                <div class="row align-items-center h-100">
                                                    <div class="col mx-auto">
                                                        @if($parkir == 'belumKeluar')
                                                        <div class="col-lg text-center">
                                                            <h3>NOMOR POLISI KENDARAAN SUDAH MASUK TEMPAT PARKIR DAN BELUM KELUAR</h3>
                                                        </div>
                                                        @elseif($parkir)
                                                        <div class=" container text-center p-0">
                                                            <h5>Tiket Parkir</h5>
                                                            <br>
                                                            <p class="p-0" style="margin-top: -12px !important; font-size:10px">Thamrin Office Park AA03 Jl. Boulevard, Jl. Teluk Betung, RT.11/RW.9, Kb. Melati, Kecamatan Tanah Abang , Daerah Khusus Ibukota Jakarta, 10240.</p>
                                                            <p class="mt-1">{{$date}}</p>
                                                            <h5 style="margin-top: -6px;">KODE PARKIR : </h5>
                                                            <p style="margin-top: -9px;font-size:30px;">{{$kode_parkir}}</p>
                                                            <p class="mt-2" style="font-size:10px;">1. KERUSAKAN & KEHILANGAN BARANG DALAM KENDARAAN JADI TANGGUNG JAWAB PEMILIK (TIDAK ADA PENGGANTIAN) <br>
                                                                2. JIKA TIKET PARKIR HILANG ATAU KUNCI MOTOR TERTINGGAL, MAKA LAPOR KE PETUGAS DAN AKAN DIKENAKAN DENDA SESUAI PELANGGARAN YANG BERLAKU <br>
                                                                3. BERLAKU 1X (SATU KALI) PARKIR</p>
                                                        </div>
                                                        @else
                                                        <div class="col-lg text-center">
                                                            <h3>SILAHKAN INPUT KENDARAAN MASUK UNTUK MENDAPATKAN TIKET PARKIR</h3>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection