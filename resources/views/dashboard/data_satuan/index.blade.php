@extends('dashboard.layout')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow">
            <h5>Form BUn</h5>
            <form class="row" action="{{ route('satuan-store') }}" method="POST">
                @csrf
                <div class="col-12">
                    <label for="">Nama</label>
                    <input type="text" name="name" id="" class="form-control">
                </div>
                <div class="col-12 mt-3">
                    <button class="btn text-white" style="background-color: #1CC88A">Submit</button>
                </div>
            </form>
        </div>
    @endif
    <table
        class="text-center justify-content-center align-items-center table table-hover border shadow table-responsive-sm">
        <thead class="table text-white" style="background-color: #1CC88A">
            <td>No</td>
            <td>Nama</td>
            <td>Action</td>
        </thead>
        @forelse ($satuans as $satuan)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $satuan->name }}</td>
                <td>
                    <form action="{{ route('satuan-delete', $satuan->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#1CC88A" href="{{ route('satuan-edit', $satuan->id) }}"><i class="fa-solid fa-pen fa-lg"></i></a>
                        <button class="btn" type="submit"><i class="fa-solid fa-trash-can fa-lg text-danger"></i></button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td class="text-center h5 bg-white" colspan="7">Result not found.</td>
            </tr>
        @endforelse
    </table>
@endsection
