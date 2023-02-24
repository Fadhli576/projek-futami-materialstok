@extends('dashboard.layout')

@section('content')
    <div class="card bg-white p-3 shadow" style="border-left: 40px solid #1CC88A">
        <strong style="font-size: 25px">Selamat Datang!</strong>
        <p>Selamat datang, {{ Auth::user()->name }}.</p>
    </div>
    @if (Auth::user()->role_id !== '1')
        <div class="row mt-5 bg-white shadow p-3" style="border-radius: 12px">
            <h4><strong>Data Stok Masuk dan Keluar</strong></h4>
            <div class="col-12 col-md-6">
                <table class="text-center justify-content-center align-items-center table table-hover border shadow fs-6"
                    style="background-color: white">
                    <thead class="table text-white" style="background-color: #1CC88A">
                        <td>No</td>
                        <td>Material</td>
                        <td>Jumlah In</td>
                        <td>Nama</td>
                        <td>Tanggal</td>
                        <td>Keterangan</td>
                    </thead>
                    @forelse ($stokIn as $stokIn)
                        <tr class="justify-content-center align-self-center">
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $stokIn->nama_material }}</td>
                            <td class="align-middle">{{ $stokIn->jumlah_stok }}</td>
                            <td class="align-middle">
                                {{ $stokIn->nama_user }}
                            </td>
                            <td class="align-middle">
                                {{ \Carbon\Carbon::parse($stokIn->created_at)->translatedFormat('d F Y, H:i') }}
                            </td>
                            <td class="align-middle">{{ $stokIn->keterangan }}</td>
                        </tr>
                    @empty
                        <td colspan="7">Belum ada data</td>
                    @endforelse
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="text-center justify-content-center align-items-center table table-hover border shadow fs-6"
                    style="background-color: white">
                    <thead class="table text-white" style="background-color: #1CC88A">
                        <td>No</td>
                        <td>Material</td>
                        <td>Jumlah Out</td>
                        <td>Nama</td>
                        <td>Tanggal</td>
                        <td>Keterangan</td>
                    </thead>
                    @forelse ($stokOut as $stokOut)
                        <tr class="justify-content-center align-self-center">
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $stokOut->nama_material }}</td>
                            <td class="align-middle">{{ $stokOut->jumlah_stok }}</td>
                            <td class="align-middle">
                                {{ $stokOut->nama_user }}
                            </td>
                            <td class="align-middle">
                                {{ \Carbon\Carbon::parse($stokOut->created_at)->translatedFormat('d F Y, H:i') }}
                            </td>
                            <td class="align-middle">{{ $stokOut->keterangan }}</td>
                        </tr>
                    @empty
                        <td colspan="7">Belum ada data</td>
                    @endforelse
                </table>
            </div>
    @endif
@endsection
