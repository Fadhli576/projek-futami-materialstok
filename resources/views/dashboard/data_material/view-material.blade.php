@extends('dashboard.layout')

@section('content')
    @if ($material == null)
        <div class="text-center">
            <strong style="font-size: 25px">Data tidak ditemukan!</strong>
            <div class="mt-2">
                <a href="/dashboard/material-data" class="btn btn-success">Back</a>

            </div>
        </div>
    @else
        <div class="card p-3 mb-5 shadow border border-0">
            <h5>Update Material</h5>
            <form class="row" action="{{ route('update-material', $material->no_material) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-12 col-md-6">
                    <div class="bg-warning p-3 shadow text-white mb-4" style="border-radius: 12px">
                        <label class="fs-2" for="">Jumlah</label>
                        <input class="form-control mb-5" {{ Auth::user()->role_id == 1 ? 'readonly' : '' }} type="number"
                            name="{{ Auth::user()->role_id == 1 ? 'jumlah_stok' : 'jumlah' }}" id=""
                            value="{{ $material->jumlah }}">
                    </div>

                    <label for="">Nomor Material</label>
                    <input class="form-control" type="number" name="no_material" id=""
                        value="{{ $material->no_material }}" {{ Auth::user()->role_id == 1 ? 'readonly' : '' }}>
                </div>
                <div class="col-12 col-md-6">
                    <label for="">Nama Material</label>
                    <input class="form-control" type="text" name="nama" id="" value="{{ $material->nama }}"
                        {{ Auth::user()->role_id == 1 ? 'readonly' : '' }}>
                    <label for="">Alat Ukur</label>
                    <input class="form-control" type="text" name="alat_ukur" id=""
                        value="{{ $material->alat_ukur }}" {{ Auth::user()->role_id == 1 ? 'readonly' : '' }}>
                    <label for="">Tempat Penyimpanan</label>
                    <input class="form-control" type="text" name="tempat_penyimpanan" id=""
                        value="{{ $material->tempat_penyimpanan }}" {{ Auth::user()->role_id == 1 ? 'readonly' : '' }}>
                    <label for="">Deskripsi</label>
                    <input class="form-control" type="text" name="deskripsi" id=""
                        value="{{ $material->deskripsi }}" {{ Auth::user()->role_id == 1 ? 'readonly' : '' }}>
                </div>
                <div class="col-12 mt-2">
                    <a href="/dashboard/material-data" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i>
                        Back</a>
                    @if (Auth::user()->role_id !== 1)
                        <button class="btn text-white" style="background-color: #1CC88A">Submit</button>
                    @endif

                    <p class="text-end fs-6" style="border-radius: 12px">Nama Pembuat : {{ $material->user->name }}</p>
                </div>

            </form>
        </div>
    @endif

    <div class="row">
        <div class="col-12 col-md-6">
            <table class="text-center justify-content-center align-items-center table table-hover border shadow fs-6"
                style="background-color: white">
                <thead class="table text-white" style="background-color: #1CC88A">
                    <td>No</td>
                    <td>No Stok</td>
                    <td>Jumlah In</td>
                    <td>Nama</td>
                    <td>Tanggal</td>
                </thead>
                @forelse ($stokIn as $stokIn)
                    <tr class="justify-content-center align-self-center">
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $material->no_material }}</td>
                        <td class="align-middle">{{ $stokIn->jumlah_stok }}</td>
                        <td class="align-middle">{{ $stokIn->user->name }}</td>
                        <td class="align-middle">
                            {{ \Carbon\Carbon::parse($stokIn->created_at_update)->translatedFormat('d F Y, H:i') }}</td>
                    </tr>
                @empty
                    <td colspan="5">Belum ada data</td>
                @endforelse
            </table>
        </div>
        <div class="col-12 col-md-6">
            <table class="text-center justify-content-center align-items-center table table-hover border shadow fs-6"
                style="background-color: white">
                <thead class="table text-white" style="background-color: #1CC88A">
                    <td>No</td>
                    <td>No Stok</td>
                    <td>Jumlah Out</td>
                    <td>Nama</td>
                    <td>Tanggal</td>
                </thead>
                @forelse ($stokOut as $stokOut)
                    <tr class="justify-content-center align-self-center">
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $material->no_material }}</td>
                        <td class="align-middle">{{ $stokOut->jumlah_stok }}</td>
                        <td class="align-middle">{{ $stokOut->user->name }}</td>
                        <td class="align-middle">
                            {{ \Carbon\Carbon::parse($stokOut->created_at_update)->translatedFormat('d F Y, H:i') }}</td>
                    </tr>
                @empty
                    <td colspan="5">Belum ada data</td>
                @endforelse
            </table>
        </div>
    </div>
    </div>
@endsection
