@extends('dashboard.layout')

@section('content')
    {{-- Form Pengisian Material Baru --}}
    @if (Auth::user()->role_id !== 1)
        <div class="card p-3 mb-5 shadow">
            <h5>Form Material</h5>
            <form class="row" action="{{ route('dashboard.store') }}" method="POST">
                @csrf
                <div class="col-md-6 col-sm-12">
                    <label for="">Nomor Material</label>
                    <input placeholder="Nomor Material" class="form-control" type="text" name="no_material" id="">
                    <label for="">Nama Material</label>
                    <input placeholder="Nama" class="form-control" type="text" name="nama" id="">
                    <label for="">Alat Ukur (Satuan)</label>
                    <input placeholder="Alat Ukur" class="form-control" type="text" name="alat_ukur" id="">
                </div>
                <div class="col-md-6 col-sm-12">
                    <label for="">Tempat Penyimpanan</label>
                    <input placeholder="Tempat Penyimpanan" class="form-control" type="text" name="tempat_penyimpanan"
                        id="">
                    <label for="">Deskripsi</label>
                    <input placeholder="Deskripsi" class="form-control" type="text" name="deskripsi" id="">
                </div>
                <div class="col-12 mt-2">
                    <button class="btn text-white" style="background-color: #1CC88A">Submit</button>
                </div>

            </form>
        </div>
    @endif
    @if (Auth::user()->role_id !== 1)
        <div class="my-3 text-end">
            <a class="btn btn-success" href="{{ route('material-export') }}"><i class="fa-regular fa-file-excel"></i> Export
                data</a>

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
            <td>No Stok</td>
            <td>Nama</td>
            <td class="d-none d-md-table-cell">Alat Ukur</td>
            <td>Jumlah</td>
            <td>Tempat</td>
            <td class="d-none d-md-table-cell">Deskripsi</td>
            <td>QR</td>
            <td>Action</td>
        </thead>
        @forelse ($materials as $material)
            <tr class="justify-content-center align-self-center">
                <td class="align-middle">{{ $loop->iteration }}</td>
                <td class="align-middle">{{ $material->no_material }}</td>
                <td class="align-middle">{{ $material->nama }}</td>
                <td class="align-middle d-none d-md-table-cell">{{ $material->alat_ukur }}</td>
                <td class="align-middle">
                    {{ $material->jumlah == null ? 'Kosong' : $material->jumlah }}
                </td>
                <td class="align-middle">{{ $material->tempat_penyimpanan }}</td>
                <td class="align-middle d-none d-md-table-cell">{{ $material->deskripsi }}</td>
                <td class="align-middle"><img src="data:image/png;base64, {!! base64_encode(
                    QrCode::format('png')->size(100)->generate($material->no_material),
                ) !!}" alt=""></td>
                <td class="align-middle">
                    <form action="{{ route('delete-material', $material->id) }}" method="POST">
                        @csrf
                        <a href="{{ route('search-material', $material->no_material) }}" class="btn text-white"
                            style="background-color:#1CC88A">Lihat</a>

                        <a href="{{ route('update-stok', $material->no_material) }}" class="btn btn-primary">Stok
                        </a>

                        @if (Auth::user()->role_id !== 1)
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Hapus</button>
                        @endif

                    </form>
                </td>
            </tr>
        @empty
            <td colspan="9">Belum ada data</td>
        @endforelse
    </table>

    {{-- {{ $materials->links('pagination::bootstrap-4') }} --}}
@endsection
