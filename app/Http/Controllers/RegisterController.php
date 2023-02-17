<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    public function  index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required',
            'address'=>'required',
            'role_id'=>'required',
            'email' => 'required',
            'password' => 'required',
            'no_hp' => 'required'
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        User::create($validateData);
        Alert::success('Berhasil', 'Berhasil membuat akun');

        return redirect('/login')->with('success', 'Registrasi berhasil! , silahkan Login');
    }
}