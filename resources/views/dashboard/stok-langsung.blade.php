@extends('dashboard.layout')

@section('content')
    <div class="row mt-5 bg-white shadow p-0 p-md-3" style="border-radius: 12px">
        <h4><strong>Data Stok Keluar Langsung</strong></h4>
        <div class="col-12">
            <table class="text-center justify-content-center align-items-center table table-hover border shadow fs-6"
                style="background-color: white">
                <thead class="table text-white" style="background-color: #1CC88A">
                    <td>No</td>
                    <td>Material</td>
                    <td class="d-none d-md-table-cell">Jumlah Out</td>
                    <td>Nama</td>
                    <td>Tanggal</td>
                    <td>Keterangan</td>
                </thead>
                @forelse ($stokOut as $stokOut)
                    <tr class="justify-content-center align-self-center">
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $stokOut->nama_material }}</td>
                        <td class="align-middle d-none d-md-table-cell">{{ $stokOut->jumlah_stok }}</td>
                        <td class="align-middle">
                            {{ $stokOut->nama_user }}
                        </td>
                        <td class="align-middle">
                            {{ \Carbon\Carbon::parse($stokOut->created_at)->translatedFormat('d F Y, H:i') }}
                        </td>
                        <td>
                            <form action="{{ route('tambah-keterangan', $stokOut->id) }}" method="POST" class="d-inline d-md-flex">
                                @csrf
                                @method('PUT')
                                <input type="text" class="form-control" name="keterangan"
                                    value="{{ $stokOut->keterangan }}">
                                <button class="btn text-white" style="background-color: #1CC88A" type="submit">Submit</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="7">Belum ada data</td>
                @endforelse
            </table>
        </div>
    @endsection
