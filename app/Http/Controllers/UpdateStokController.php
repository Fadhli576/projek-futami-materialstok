<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\UpdateStok;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateStokController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Models\UpdateStok  $updateStok
     * @return \Illuminate\Http\Response
     */
    public function show(UpdateStok $updateStok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UpdateStok  $updateStok
     * @return \Illuminate\Http\Response
     */
    public function edit($no_material)
    {
        $material = Material::where('no_material', $no_material)->first();
        // $materials = UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
        //                         ->where('no_material', $no_material)
        //                         ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
        //                         ->latest('created_at_update')->get();
        // $materials = Material::where('no_material', $no_material)->join('update_stoks','materials.id','=','update_stoks.stok_id')->orderBy('no_material','asc')->get();
        // $materiael = UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
        //                         ->where('no_material', $no_material)
        //                         ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
        //                         ->latest('created_at_update')->first();
        
        $stokIn =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')->join('users','update_stoks.user_id','users.id')
                                ->where([['no_material', $no_material],['status','in']])
                                ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','users.name as user_name','update_stoks.status as status','update_stoks.created_at as created_at_update', 'materials.*')
                                ->get();
        
        $stokOut =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')->join('users','update_stoks.user_id','users.id')
                                ->where([['no_material', $no_material],['status','out']])
                                ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','users.name as user_name','update_stoks.status as status','update_stoks.created_at as created_at_update', 'materials.*')
                                ->get();

        return view('dashboard.data_material.update-stok', compact('material','stokIn','stokOut','no_material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UpdateStok  $updateStok
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no_material)
    {

        $materiala = Material::where('no_material',$no_material)->first();

        $request->validate([
            'jumlah_stok' => 'required',
        ]);

        UpdateStok::create([
            'stok_id'=>$materiala->id,
            'jumlah_stok'=>$request->jumlah_stok,
            'user_id'=>Auth::user()->id,
            'status'=>$request->status,
            'keterangan'=>$request->keterangan,
            'metode_scan'=>'manual',
            'tanggal_scan'=> Carbon::now()->format('Y-m-d')
        ]); 

        $material = UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                                ->where('no_material', $no_material)
                                ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
                                ->latest('created_at_update')->first();

        $stokMasuk =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                            ->where([['no_material', $no_material],['status','in']])
                            ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
                            ->latest('created_at_update')->first();

        $stokKeluar =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                            ->where([['no_material', $no_material],['status','out']])
                            ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
                            ->latest('created_at_update')->first();

        // Material::where('no_material', $no_material)->update([
        //         'jumlah' => $material->jumlah + $stokIn->sum('jumlah_stok') - $stokOut->sum('jumlah_stok')
        // ]);

        if ($request->status == 'in') {
            Material::where('no_material', $no_material)->update([
                'jumlah' => $material->jumlah + $stokMasuk->jumlah_stok
            ]);
        } elseif ($request->status == 'out') {
            Material::where('no_material', $no_material)->update([
                'jumlah' => $material->jumlah - $stokKeluar->jumlah_stok
            ]);
        }
        toast('Berhasil memperbaharui material!','success');
        return redirect('/dashboard/material-data/'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UpdateStok  $updateStok
     * @return \Illuminate\Http\Response
     */
    public function destroy(UpdateStok $updateStok)
    {
        //
    }
}
