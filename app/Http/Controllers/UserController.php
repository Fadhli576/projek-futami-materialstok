<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('dashboard.profile.profile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = User::where('id', Auth::user()->id)->first();
        return view('dashboard.profile.edit-profile', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'no_hp'=>'required',
            // 'password'=>'required',
            'email'=>'required'
        ]);

        User::where('id', Auth::user()->id)->update([
            'name'=> $request->name,
            'address'=> $request->address,
            'no_hp'=> $request->no_hp,
            // 'password'=> bcrypt($request->password),
            'email'=> $request->email
        ]);

        toast('Berhasil mengupdate profile!','success');
        return redirect('/dashboard/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Satuan  $satuan
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {

    }

    public function passwordUpdate(Request $request)
    {
        $request->validate([
            'password'=>'required',
        ]);

        User::where('id', Auth::user()->id)->update([
            'password'=> bcrypt($request->password),
        ]);

        toast('Berhasil mengupdate password!','success');
        return redirect('/dashboard/profile');
    }
}
