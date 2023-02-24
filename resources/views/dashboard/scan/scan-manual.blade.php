@extends('dashboard.layout')

@section('content')
    <div class="card p-3 mb-5 shadow">
        <h5>Scan Manual</h5>
        <form action="{{ route('search-material-post', $search1) }}" method="post"
            class="d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            @csrf
            <div class="input-group">
                <input autofocus type="number" class="form-control bg-light border-0 small" name="search1"
                    placeholder="Cari No Material/Stok..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
