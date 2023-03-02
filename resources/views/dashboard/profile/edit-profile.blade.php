@extends('dashboard.layout')

@section('content')
    <div class="d-flex justify-content-center">
        <div class="card p-3 mb-5 shadow rounded-4" style="width:500px">
            <h5>Ganti Password</h5>
            <form class="row" action="{{ route('update-password') }}" method="POST">
                @csrf
                @method('PUT')
                <div class=" col-12">
                    <label for="">Password</label>
                    <input required placeholder="Password" class="form-control" type="password" name="password"
                        id="">
                    <div class="mt-3">
                        <a class="btn btn-primary" href="/dashboard/profile"><i class="fa-solid fa-arrow-left-long"></i> Back</a>
                        <button class="btn text-white" style="background-color: #1CC88A">Submit</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection
