@extends('dashboard.layout')

@section('content')
    <div class="card p-3 mb-5 shadow border border-0">
        <h5>Update User</h5>
        <form class="row" action="{{ route('update-user', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class=" col-sm-12 col-md-6">
                <label for="">Nama</label>
                <input value="{{ $user->name }}" placeholder="Nama" class="form-control" type="text" name="name"
                    id="">
                <label for="">Email</label>
                <input value="{{ $user->email }}" placeholder="Email" class="form-control" type="email" name="email"
                    id="">
                <label for="">No HP</label>
                <input value="{{ $user->no_hp }}" placeholder="Nomor HP" class="form-control" type="number" name="no_hp"
                    id="">
            </div>
            <div class="col-sm-12 col-md-6 ">
                <label for="">Address</label>
                <input value="{{ $user->address }}" placeholder="Address" class="form-control" type="text" name="address"
                    id="">
                <label for="">Role</label>
                <select name="role_id" id="" class="form-select">
                    <option selected disabled value="">Pilih Role</option>
                    <option {{ $user->role->id == 1 ? 'selected' : ''}} value="1">User</option>
                    <option {{ $user->role->id == 2 ? 'selected' : ''}} value="2">Admin</option>
                    <option {{ $user->role->id == 3 ? 'selected' : ''}} value="3">Super Admin</option>
                </select>
            </div>
            <div class="col-12 mt-2">
                <a href="/dashboard/user-data" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> Back</a>
                <button class="btn text-white" style="background-color: #1CC88A">Submit</button>
            </div>

        </form>
    </div>
@endsection
