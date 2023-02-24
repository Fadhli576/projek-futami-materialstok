@extends('dashboard.layout')

@section('content')
    <div class="card p-3 mb-5 shadow">
        <h5>Scan Langsung</h5>
        <form class="row" action="{{ route('scan-langsung') }}" method="POST">
            @csrf
            <div class="col-12">
                <label for="">Nomor Material</label>
                <input placeholder="Nomor Material" autofocus class="form-control" type="number" name="no_material"
                    id="">
                <button class="btn btn-success mt-3" type="submit">Submit</button>
            </div>
        </form>
    </div>
@endsection
