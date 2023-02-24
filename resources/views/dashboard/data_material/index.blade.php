@extends('dashboard.layout')

@section('content')
    {{-- Form Pengisian Material Baru --}}
    @if (Auth::user()->role_id !== '1')
        <div class="card p-3 mb-5 shadow">
            <h5>Form Material</h5>
            <form class="row" action="{{ route('dashboard.store') }}" method="POST">
                @csrf
                <div class="col-md-6 col-sm-12">
                    <label for="">Material</label>
                    <input placeholder="Material" class="form-control" type="number" name="no_material"
                        id="">
                    <label for="">Material Description</label>
                    <input placeholder="Description" class="form-control" type="text" name="nama" id="">
                    <label for="">BUn</label>
                    <select name="satuan_id" id="" class="form-select">
                        <option value="" selected disabled>Pilih</option>
                        @foreach ($satuan as $satuan)
                            <option value="{{ $satuan->id }}">{{ $satuan->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 col-sm-12">
                    <label for="">Lokasi Rak</label>
                    <input placeholder="Lokasi Rak" class="form-control" type="text" name="lokasi"
                        id="">
                    <label for="">Deskripsi</label>
                    <input placeholder="Deskripsi (Optional)" class="form-control" type="text" name="deskripsi" id="">
                </div>
                <div class="col-12 mt-2">
                    <button class="btn text-white" style="background-color: #1CC88A">Submit</button>
                </div>

            </form>
        </div>
    @endif
    {{ $materials->links('pagination::bootstrap-4') }}
    @if (Auth::user()->role_id !== '1')
        <div class="my-3 text-end">
            <a class="btn btn-success" href="{{ route('update-stok-export') }}"><i class="fa-regular fa-file-excel"></i>
                Export Out Data</a>

            <a class="btn btn-success" href="{{ route('material-export') }}"><i class="fa-regular fa-file-excel"></i>
                Export Material data</a>

            <a class="btn btn-warning text-white" href="{{ route('print-material') }}"><i class="fa-solid fa-print"></i>
                Print</a>
        </div>
    @endif
    {{-- Tabel untuk material --}}
    <table
        class="text-center justify-content-center align-items-center table table-hover border shadow table-responsive-sm fs-6"
        style="background-color: white">
        <thead class="table text-white" style="background-color: #1CC88A">
            <td>No</td>
            <td>Material</td>
            <td>Material Description</td>
            <td class="d-none d-md-table-cell">BUn</td>
            <td>Unrestricted</td>
            <td>Lokasi Rak</td>
            <td class="d-none d-md-table-cell">Deskripsi</td>
            <td>QR</td>
            <td style="width: 100px">Aksi</td>
        </thead>
        @forelse ($materials as $material)
            <tr class="justify-content-center align-self-center">
                <td class="align-middle">{{ $material->id }}</td>
                <td class="align-middle">{{ $material->no_material }}</td>
                <td class="align-middle">{{ $material->nama }}</td>
                <td class="align-middle d-none d-md-table-cell">

                    {{ $material->satuan->name }}</td>
                <td class="align-middle">
                    {{ $material->jumlah == null ? 'Kosong' : $material->jumlah }}
                </td>
                <td class="align-middle">{{ $material->lokasi == null ? 'Kosong' : $material->lokasi }}</td>
                <td class="align-middle d-none d-md-table-cell">
                    {{ $material->deskripsi == null ? 'Kosong' : $material->deskripsi }}</td>
                <td class="align-middle">{!! QrCode::size(40)->generate($material->no_material) !!}</td>
                <td class="align-middle">
                    <a href="{{ route('search-material', $material->no_material) }}" class="btn text-white mb-2"
                        style="background-color:#1CC88A">Lihat</a>

                    <a href="{{ route('update-stok', $material->no_material) }}" class="btn btn-primary mb-2">Stok
                    </a>

                    @if (Auth::user()->role_id !== '1')
                        <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">Hapus</button>
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah anda yakin akan menghapus data ini?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <form action="{{ route('delete-material', $material->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </td>
            </tr>
        @empty
            <td colspan="9">Belum ada data</td>
        @endforelse
    </table>

    {{ $materials->links('pagination::bootstrap-4') }}
@endsection
