<!DOCTYPE html>
<html lang="en">

<head>
    <title>Report - Sistem Parkir</title>
</head>

<body>
    <main>
        <h1>Laporan Parkir</h1>

        <table class="table align-items-center table-flush">
            <thead class="thead-light">
                <tr>
                    <th scope="col" class="sort" data-sort="name" style="font-size:15px">Nomor Polisi</th>
                    <th scope="col" class="sort" data-sort="budget" style="font-size:15px">Kendaraan</th>
                    <th scope="col" class="sort" data-sort="status" style="font-size:15px">Waktu Masuk</th>
                    <th scope="col" class="sort" data-sort="status" style="font-size:15px">Waktu Keluar</th>
                    <th scope="col" class="sort" data-sort="status" style="font-size:15px">Biaya</th>
                    <th scope="col" class="sort" data-sort="completion" style="font-size:15px">Pelanggaran</th>
                </tr>
            </thead>
            <tbody class="list">
                @forelse($kendaraan as $k)
                <tr>
                    <th scope="row">
                        <div class="media align-items-center">
                            <div class="media-body">
                                @if($k->no_polisi)
                                <span class="name mb-0 text-sm">{{$k->no_polisi}}</span>
                                @else
                                <span class="name mb-0 text-sm">{{$k->vehicle->no_polisi}}</span>
                                @endif
                            </div>
                        </div>
                    </th>
                    <td class="budget">
                        {{$k->vehicle->jenis_kendaraan}}
                    </td>
                    <td>
                        <span class="name mb-0 text-sm">
                            <span class="status">{{$k->waktu_masuk}}</span>
                        </span>
                    </td>
                    @if($k->waktu_keluar)
                    <td>
                        <span class="name mb-0 text-sm">
                            <span class="status">{{$k->waktu_keluar}}</span>
                        </span>
                    </td>
                    @else
                    <td>
                        <span class="name mb-0 text-sm">
                            <span class="status">Belum Keluar</span>
                        </span>
                    </td>
                    @endif
                    <td>
                        <span class="name mb-0 text-sm">
                            <span class="status">{{$k->biaya}}</span>
                        </span>
                    </td>
                    @if( $k->fault_id == null)
                    <td class="budget">
                        Tidak Melakukan Pelanggaran
                    </td>
                    @else
                    <td class="budget">
                        {{$k->fault->nama_pelanggaran}}
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center p-5" style="font-size: 18px;">
                        Belum Ada Kendaraan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </main>



</body>

</html>