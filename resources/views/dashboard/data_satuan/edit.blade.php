@extends('dashboard.layout')

@section('content')
    <div class="card p-3 mb-5 shadow border border-0">
        <h5>Update Satuan</h5>
        <form class="row" action="{{ route('satuan-update', $satuan->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class=" col-12">
                <label for="">Nama</label>
                <input value="{{ $satuan->name }}" placeholder="Nama" class="form-control" type="text" name="name"
                    id="">
            </div>
            <div class="col-12 mt-2">
                <a href="/dashboard/satuan-data" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
                <button class="btn text-white" style="background-color: #1CC88A">Submit</button>
            </div>

        </form>
    </div>
@endsection
