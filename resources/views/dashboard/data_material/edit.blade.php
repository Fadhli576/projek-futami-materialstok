@extends('dashboard.layout')

@section('content')
    <div class="card p-3 mb-5 shadow border border-0">
        <h5>Update Material</h5>
        <form class="row" action="{{ route('update-material', $material->no_material) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="col-12 col-md-6">
                <label for="">Nomor Material</label>
                <input class="form-control" type="text" name="no_material" id=""
                    value="{{ $material->no_material }}">
                <label for="">Nama</label>
                <input class="form-control" type="text" name="nama" id="" value="{{ $material->nama }}">
                <label for="">Alat Ukur</label>
                <input class="form-control" type="text" name="alat_ukur" id=""
                    value="{{ $material->alat_ukur }}">
            </div>
            <div class="col-12 col-md-6">
                <label for="">Jumlah</label>
                <input class="form-control" type="text" name="jumlah" id="" value="{{ $material->jumlah }}">
                <label for="">Tempat Penyimpanan</label>
                <input class="form-control" type="text" name="tempat_penyimpanan" id=""
                    value="{{ $material->tempat_penyimpanan }}">
                <label for="">Deskripsi</label>
                <input class="form-control" type="text" name="deskripsi" id=""
                    value="{{ $material->deskripsi }}">
            </div>
            <div class="col-12 mt-2">
                <a href="/dashboard/material-data" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
                <button class="btn btn-success">Submit</button>
            </div>

        </form>
    </div>
@endsection
