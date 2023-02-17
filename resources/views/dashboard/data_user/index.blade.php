@extends('dashboard.layout')

@section('content')
    @if (Auth::user()->role_id == 3)
        <div class="card p-3 mb-5 shadow">
            <h5>Form User</h5>
            <form class="row" action="{{ route('user-store') }}" method="POST">
                @csrf
                <div class=" col-sm-12 col-md-6">
                    <label for="">Nama</label>
                    <input placeholder="Nama" class="form-control" type="text" name="name" id="">
                    <label for="">Email</label>
                    <input placeholder="Email" class="form-control" type="email" name="email" id="">
                    <label for="">No HP</label>
                    <input placeholder="Nomor HP" class="form-control" type="number" name="no_hp" id="">
                </div>
                <div class="col-sm-12 col-md-6 ">
                    <label for="">Address</label>
                    <input placeholder="Address" class="form-control" type="text" name="address" id="">
                    <label for="">Role</label>
                    <select name="role_id" id="" class="form-select">
                        <option selected disabled value="">Pilih Role</option>
                        <option value="1">User</option>
                        <option value="2">Admin</option>
                        <option value="3">Super Admin</option>
                    </select>
                    <label for="">Password</label>
                    <input placeholder="Password" class="form-control" type="password" name="password" id="">
                </div>
                <div class="col-12 mt-2">
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
            <td>Email</td>
            <td>No HP</td>
            <td>Address</td>
            <td>Role</td>
            <td>Action</td>
        </thead>
        @forelse ($users as $user)
            <tr class="bg-white">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->no_hp }}</td>
                <td>{{ $user->address }}</td>
                <td>{{ $user->role->name }}</td>
                <td>
                    <form action="{{ route('delete-user', $user->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <a class="btn" style="color:#1CC88A" href="{{ route('edit-user', $user->id) }}"><i class="fa-solid fa-pen fa-lg"></i></a>
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

    {{ $users->links('pagination::bootstrap-4') }}
@endsection
