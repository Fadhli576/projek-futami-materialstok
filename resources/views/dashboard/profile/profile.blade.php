@extends('dashboard.layout')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card p-2 p-md-5 mb-5 shadow rounded-5" style="width: 500px">
            <img src="{{ asset('assets/img/userprofileL.png') }}" alt="" class="img-fluid mx-auto" style="width: 200px">
            <h2 class="text-center mb-3">Profile</h2>
            <form method="POST" action="{{ route('update-profile') }}" class="row">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for=""><strong>Nama</strong></label>
                    <input value="{{ $user->name }}" placeholder="Nama" class="form-control" type="text" name="name"
                        id="">
                    <label for=""><strong> Email</strong></label>
                    <input value="{{ $user->email }}" placeholder="Email" class="form-control" type="email"
                        name="email" id="">
                    <label for=""><strong> No HP</strong></label>
                    <input value="{{ $user->no_hp }}" placeholder="Nomor HP" class="form-control" type="number"
                        name="no_hp" id="">
                </div>
                <div class="col-6">
                    <label for=""><strong> Address</strong></label>
                    <input value="{{ $user->address }}" placeholder="Address" class="form-control" type="text"
                        name="address" id="">
                </div>
                <div class="col-6">
                    <label for=""><strong> Role</strong></label>
                    <input readonly value="{{ $user->role->name }}" placeholder="Role" class="form-control" type="text"
                        name="role" id="">
                </div>
                <a href="{{ route('edit-password') }}" class="btn btn-danger mt-3">Ganti Password</a>
                <div class="mt-3">
                    <a href="/dashboard" class="btn btn-primary"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                    <button type="submit" class="btn text-white float-end" style="background-color: #1CC88A">Save
                        Changes</button>
                </div>

            </form>
        </div>
    </div>
@endsection
