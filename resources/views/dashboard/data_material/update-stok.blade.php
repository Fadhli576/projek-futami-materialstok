@extends('dashboard.layout')

@section('content')
    <div class="card p-2 p-md-4 shadow">
        <h4><a href="/dashboard/material-data" class="btn d-md-none"><i class="fa-solid fa-arrow-left"></i>
            </a><strong>Data Material</strong></h4>
        <table
            class="text-center justify-content-center align-items-center table table-hover border shadow table-responsive-sm fs-6"
            style="background-color: white">
            <thead class="table text-white" style="background-color: #1CC88A">
                <td>No</td>
                <td>Material</td>
                <td>Material Description</td>
                <td>BUn</td>
                <td>Unrestricted</td>
                <td>Lokasi Rak</td>
                <td>Deskripsi</td>
            </thead>
            <tr class="justify-content-center align-self-center">
                <td class="align-middle">{{ $material->id }}</td>
                <td class="align-middle">{{ $material->no_material }}</td>
                <td class="align-middle">{{ $material->nama }}</td>
                <td class="align-middle">{{ $material->satuan->name }}</td>
                <td class="align-middle">{{ $material->jumlah }}</td>
                <td class="align-middle">{{ $material->lokasi == null ? 'Kosong' : $material->lokasi }}</td>
                <td class="align-middle">{{ $material->deskripsi == null ? 'Kosong' : $material->deskripsi }}</td>
            </tr>
        </table>

        <form action="{{ route('update-stoki', $no_material) }}" method="POST" class="row">
            @csrf
            @method('PUT')
            <div class="col-12 col-md-6">
                <table class="text-center justify-content-center align-items-center table table-hover border shadow fs-6">
                    @if ($material->satuan->name == 'KG')
                        <tr>
                            <td>Type Satuan</td>
                            <td><select required name="konversi" id="" class="form-select">
                                    <option disabled selected value="">Pilih</option>
                                    <option value="KG">KG</option>
                                    <option value="G">G (Gram)</option>
                                </select>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>Jumlah Stok</td>
                        <td><input class="form-control" required type="number" min="0" step="0.01"
                                name="jumlah_stok" value="" placeholder="Masukkan jumlah stok..."></td>
                    </tr>
                    <tr>
                        <td>Type Stok</td>
                        <td><select required name="status" id="" class="form-select">
                                <option disabled selected value="">Pilih</option>
                                <option value="in">In/Tambah</option>
                                <option value="out">Out/Kurangi</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td><input class="form-control" required type="text" name="keterangan" value=""
                                placeholder="Keterangan"></td>
                    </tr>
                    <tr>
                        <td align="end"><a href="/dashboard/material-data"
                                class="btn btn-secondary d-none d-md-inline"><i class="fa-solid fa-arrow-left"></i><span>
                                    Back</span>
                            </a></td>
                        <td align="end">
                            <button type="submit" class="btn text-white" style="background-color: #1CC88A">Submit</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-12 col-md-6">
                <table class="text-center justify-content-center align-items-center table table-hover border shadow fs-6"
                    style="background-color: white;">
                    <tr>
                        <td>Total Stok Masuk</td>
                        <td>{{ $stokIn->sum('jumlah_stok') }}</td>
                    </tr>
                    <tr>
                        <td>Total Stok Keluar</td>
                        <td>{{ $stokOut->sum('jumlah_stok') }}</td>
                    </tr>
                </table>
            </div>
        </form>

        <div class="row mt-5">
            <div class="col-12 col-md-6">
                <table class="text-center justify-content-center align-items-center table table-hover border shadow fs-6"
                    style="background-color: white">
                    <thead class="table text-white" style="background-color: #1CC88A">
                        <td>No</td>
                        <td>Material</td>
                        <td>Jumlah In</td>
                        <td>Nama</td>
                        <td>Tanggal</td>
                    </thead>
                    @forelse ($stokIn as $stokIn)
                        <tr class="justify-content-center align-self-center">
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $material->no_material }}</td>
                            <td class="align-middle">{{ $stokIn->jumlah_stok }}</td>
                            <td class="align-middle">{{ $stokIn->user_name }}</td>
                            <td class="align-middle">
                                {{ \Carbon\Carbon::parse($stokIn->created_at_update)->translatedFormat('d F Y, H:i') }}
                            </td>
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
                    </thead>
                    @forelse ($stokOut as $stokOut)
                        <tr class="justify-content-center align-self-center">
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $material->no_material }}</td>
                            <td class="align-middle">{{ $stokOut->jumlah_stok }}</td>
                            <td class="align-middle">{{ $stokOut->user_name }}</td>
                            <td class="align-middle">
                                {{ \Carbon\Carbon::parse($stokOut->created_at_update)->translatedFormat('d F Y, H:i') }}
                            </td>
                        </tr>
                    @empty
                        <td colspan="7">Belum ada data</td>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
