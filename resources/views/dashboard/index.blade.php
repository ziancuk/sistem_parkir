@extends('layouts.app')
<title>Dashboard - Sistem Parkir</title>
@section('content')

<!-- Main content -->
<div class="header bg-gradient-primary pb-6">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <h6 class="h1 text-white d-inline-block mb-0">Dashboard</h6>
                </div>
                <div class="col-lg-6 col-5 text-right text-white">
                    <strong><span id="tanggal"></span> ; <span id="watch"></span></strong>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Resume Kendaraan -->
<div class="container-fluid mt--6">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">Kendaraan Parkir</h6>
                            <span class="h2 font-weight-bold mb-0">{{$total}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="fas fa-car-side"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">Mobil</h6>
                            <span class="h2 font-weight-bold mb-0">{{$mobil}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="fas fa-car"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">Motor</h6>
                            <span class="h2 font-weight-bold mb-0">{{$motor}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="fas fa-motorcycle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resume Pendapatan -->
    <div class="row">
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">Total Pendapatan</h6>
                            <span class="h6 font-weight-bold mb-0">Rp. {{number_format($pendapatan, 0, ',', '.')}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-warning text-white rounded-circle shadow">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">Parkir</h6>
                            <span class="h6 font-weight-bold mb-0">Rp. {{number_format($parkirIncome, 0, ',', '.')}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-primary text-white rounded-circle shadow">
                                <i class="fas fa-parking"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6">
            <div class="card card-stats">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h6 class="card-title text-uppercase text-muted mb-0">Denda</h6>
                            <span class="h6 font-weight-bold mb-0">Rp. {{number_format($denda, 0, ',', '.')}}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="fas fa-times-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">List Kendaraan Terbaru</h4>
                        </div>
                        @if(Auth::user()->role == '1')
                        <div class="col text-right">
                            <a href="/report" class="btn btn-sm btn-primary">Lihat Laporan</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name" style="font-size:10px">Nomor Polisi</th>
                                <th scope="col" class="sort" data-sort="budget" style="font-size:10px">Jenis Kendaraan</th>
                                <th scope="col" class="sort" data-sort="status" style="font-size:10px">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($master as $m)
                            <tr>
                                <th scope="row">
                                    {{$m->vehicle->no_polisi}}
                                </th>
                                <td>
                                    {{$m->vehicle->jenis_kendaraan}}
                                </td>
                                <td>
                                    {{$m->status}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center p-5">
                                    Belum ada yang parkir
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-center">Total Kendaraan : {{$master->total()}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">Pelanggaran</h5>
                        </div>
                        @if(Auth::user()->role == '1')
                        <div class="col text-right">
                            <a href="/report" class="btn btn-sm btn-primary">Lihat Laporan</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Pelanggaran Tiket Parkir Hilang -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="name" style="font-size:10px">Nomor Polisi</th>
                                <th scope="col" class="sort" data-sort="budget" style="font-size:10px">Jenis Kendaraan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($fault as $f)
                            <tr>
                                <th scope="row">
                                    {{$f->vehicle->no_polisi}}
                                </th>
                                <td>
                                    {{$f->vehicle->jenis_kendaraan}}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center p-5">
                                    Tidak ada pelanggaran hari ini
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" class="text-center">Total Pelanggaran : {{$fault->total()}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection