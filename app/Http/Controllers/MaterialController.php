<?php

namespace App\Http\Controllers;

use App\Exports\MaterialsExport;
use App\Models\User;
use App\Models\Material;
use App\Models\UpdateStok;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Calculation\TextData\Format;
use RealRashid\SweetAlert\Facades\Alert;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MaterialController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search1 = '';
        
       $materials = Material::all();
            $stokIn =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                                ->where('status','in')
                                ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')->get();

            $stokOut =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                                ->where('status','out')
                                ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')->get();

        return view('dashboard.data_material.index', compact('search1','stokIn','stokOut','materials'));
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
        $request->validate([
            'no_material' => 'required',
            'nama'=>'required',
            'alat_ukur' => 'required',
            'tempat_penyimpanan' => 'required',
            'deskripsi' => 'required',
        ],[
            'no_material.required' => 'no_material harus diisi',
            'nama'=>'required',
            'alat_ukur.required' => 'alat_ukur harus diisi',
            'tempat_penyimpanan.required' => 'category harus diisi',
            'deskripsi.required' => 'deskripsi harus diisi',
        ]);

       
        


        Material::create([
            'no_material' =>$request->no_material,
            'nama'=>$request->nama,
            'alat_ukur' => $request->alat_ukur,
            'tempat_penyimpanan' => $request->tempat_penyimpanan,
            'deskripsi' => $request->deskripsi,
            'user_id'=> Auth::user()->id
        ]);

        toast('Berhasil membuat material!','success');
        return redirect('/dashboard/material-data');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit($no_material)
    {
        $material = Material::where('no_material', $no_material)->first();
        return view('dashboard.data_material.edit', compact('material'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no_material)
    {
        $material = Material::where('no_material', $no_material)->first();

            $request->validate([
                'no_material' => 'required',
                'nama' => 'required',
                'alat_ukur' => 'required',
                'tempat_penyimpanan' => 'required',
                'deskripsi' => 'required',
            ]);
    
            $material->update([
                'no_material' => $request->no_material,
                'nama' => $request->nama,
                'alat_ukur' => $request->alat_ukur,
                'tempat_penyimpanan' => $request->tempat_penyimpanan,
                'deskripsi' => $request->deskripsi,
            ]);


        toast('Berhasil memperbaharui material!','success');
        return redirect('/dashboard/material-data')->with('success', 'Material berhasil diupdate');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->delete();
        Alert::warning('Deleted', 'Material sudah dihapus');
        return redirect()->back();
    }

    public function indexDashboard()
    {
        $stokIn =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                                ->where('status','in')
                                ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
                                ->get();
        
        $stokOut =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                                ->where('status','out')
                                ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
                                ->get();
        return view('dashboard.index', compact('stokIn','stokOut'));
    }


    public function indexUser()
    {
        $users = User::latest()->filter(request(['search']))->paginate(20);
        
        return view('dashboard.data_user.index', ['users'=>$users]);
    }

    public function storeUser(Request $request)
    {
        $user = $request->validate([
            'name' => 'required',
            'email'=>'required',
            'no_hp'=>'required',
            'address' => 'required',
            'role_id' => 'required',
            'password'=>'required'
        ]);


        $user['password'] = bcrypt($user['password']);

        User::create($user);
        toast('Berhasil menembahkan User!','success');
        return redirect('/dashboard/user-data');
        
    }

    public function editUser($id)
    {
        $user = User::where('id',$id)->first();
        return view('dashboard.data_user.edit-user', compact('user'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = $request->validate([
            'name' => 'required',
            'email'=>'required',
            'no_hp'=>'required',
            'address' => 'required',
            'role_id' => 'required',
        ]);

        User::where('id',$id)->update($user);
        toast('Berhasil mengapdet User!','success');
        return redirect('/dashboard/user-data');
    }

    public function destroyUser($id)
    {
        User::find($id)->delete();
        Alert::warning('Sukses', 'User telah dihapus');
        return redirect()->back();

    }

    public function searchMaterialPost(Request $request)
    {
        $search1 = $request->input('search1');
        if($search1 == '') {
            return redirect('/dashboard/material-data');
        }

        return redirect('/dashboard/update-stok/' . $search1);
    }

    public function searchMaterial($no_material)
    {
        $material = Material::where('no_material', $no_material)->first();
        $stokIn =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                            ->where([['no_material', $no_material],['status','in']])
                            ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
                            ->get();

        $stokOut =  UpdateStok::join('materials','update_stoks.stok_id','=','materials.id')
                            ->where([['no_material', $no_material],['status','out']])
                            ->select('update_stoks.id as update_stok_id','update_stoks.stok_id as stok_id','update_stoks.jumlah_stok as jumlah_stok','update_stoks.user_id as user_id','update_stoks.status as status','update_stoks.created_at as created_at_update','materials.*')
                            ->get();

        return view('dashboard.data_material.view-material', compact('material','stokIn','stokOut'));
    }

    public function materialExport()
    {
        return Excel::download(new MaterialsExport, 'stok-material-'.Carbon::now()->format('Y-m-d').'.xlsx');
    }

    public function printMaterial()
    {
        $materials = Material::all();
        return view('print', compact('materials'));
    }

}
