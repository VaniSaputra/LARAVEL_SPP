<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Datatables;
use DB;
use Redirect;

use App\Siswa;
use App\KelasSiswa;
use App\Pembayaran;
use App\General;


class SiswaController extends Controller
{
    //Data Lunas/tidak lunas
    public function dataSiswa($angkatan, $kelasAll='all',$namakelas='all')
    {   
        $filtertahun    = Siswa::select('angkatan')->distinct()->get();
        $filterkelas    = KelasSiswa::select('kelas')->distinct()->get();
        $filternamakelas= KelasSiswa::select('nama_kelas')->distinct()->get();
        $kelas          = KelasSiswa::orderBy('id')->get();
        return view('admin.siswa.list', [
            'halaman' => 'awal',
            'angkatan' => $angkatan,
            'filtertahun' => $filtertahun,
            'filterkelas' => $filterkelas,
            'filternamakelas' => $filternamakelas,
            'kelasAll' => $kelasAll,
            'namakelas' => $namakelas,
            'kelas' => $kelas,
            ]);  
    }

     // DATATABLES
    public function siswaTable($angkatan,$kelas='all',$namakelas='all', Request $request)
    {
        // Just to display mysql num rows, add this code
        DB::statement(DB::raw('set @rownum=0'));
        $table  = Siswa::select([DB::raw('@rownum := @rownum + 1 AS rownum'),
                    'siswas.*','kelas_siswas.kelas as kelas','kelas_siswas.nama_kelas as nama_kelas'
                    // Or Select all with table.*
                    ])
                    ->join('kelas_siswas','siswas.kelas_id','=','kelas_siswas.id');

                    if ($namakelas != 'all') {
                        $table = $table->where('kelas_siswas.nama_kelas',$namakelas)
                                        ->where('kelas_siswas.kelas',$kelas)
                                        ->where('siswas.angkatan',$angkatan)
                                        ->get();
                    }
                    elseif ($kelas !='all') {
                         $table = $table->where('kelas_siswas.kelas',$kelas)
                                        ->where('siswas.angkatan',$angkatan)
                                        ->get();
                    }else{
                         $table = $table->where('siswas.angkatan',$angkatan)
                                        ->get();
                    }
                    
        // if(isset)
        $datatables = Datatables::of($table);
        if($keyword = $request->get('search')['value'])
        {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum + 1 like ?', ["%{$keyword}%"]);
        }
        return $datatables
                // 
                ->addColumn('opsi', function($table){
                    return '
                    <a href="'.url('admin/kelas/edit/'.$table->id).'" data-toggle="tooltip" title="keterangan">
                        <button type="button" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-pencil "></span> Keterangan Lunas
                        </button> 
                    </a>
                    ';
                })
                ->make(true);
    }

// ====================================================================================================
    // VIEW SISWA
    public function index($angkatan,$kelasAll='all',$namakelas='all')
    {  

        $filtertahun    = Siswa::select('angkatan')->distinct()->get();
        $filterkelas    = KelasSiswa::select('kelas')->distinct()->get();
        $filternamakelas= KelasSiswa::select('nama_kelas')->distinct()->get();
        $kelas          = KelasSiswa::orderBy('id')->get();
        $jk     = General::getEnumValues('siswas', 'jk');
        // keterangan siswa
        $jumlahsemua = Siswa::select(DB::raw('count(*) as jumlah'))->first();
        $jumlahL = Siswa::select(DB::raw('count(*) as jumlah'))->where('jk','L')->first();
        $jumlahP = Siswa::select(DB::raw('count(*) as jumlah'))->where('jk','P')->first();
        // return
        return view('admin.siswa.view_siswa', [
            'halaman' => 'siswa',
            'angkatan' => $angkatan,
            'kelasAll' => $kelasAll,
            'namakelas' => $namakelas,
            'filtertahun' => $filtertahun,
            'filterkelas' => $filterkelas,
            'filternamakelas' => $filternamakelas,
            'kelas' => $kelas,
            'jk' => $jk,
            // keterangan siswa
            'jumlahsemua' => $jumlahsemua,
            'jumlahL' => $jumlahL,
            'jumlahP' => $jumlahP,
            ]); 
    }

    // DATATABLES SISWA
    public function indexData($angkatan,$kelasAll='all',$namakelas='all', Request $request)
    {

        // Just to display mysql num rows, add this code
        DB::statement(DB::raw('set @rownum=0'));
        $table  = Siswa::select([DB::raw('@rownum := @rownum + 1 AS rownum'),
                    'siswas.*','kelas_siswas.kelas as kelas','kelas_siswas.nama_kelas as nama_kelas',
                    // Or Select all with table.*
                    ])
                    ->join('kelas_siswas', 'siswas.kelas_id', '=', 'kelas_siswas.id');

                    if($namakelas != 'all'){
                        $table = $table->where('siswas.angkatan', $angkatan)
                                        ->where('kelas_siswas.kelas', $kelasAll)
                                        ->where('kelas_siswas.nama_kelas', $namakelas)->get();
                    }
                    elseif ($kelasAll != 'all') {
                        $table = $table->where('siswas.angkatan', $angkatan)
                                        ->where('kelas_siswas.kelas', $kelasAll)->get();
                    }
                    else {
                        $table = $table->where('siswas.angkatan', $angkatan)->get();
                    }

        // if(isset)
        $datatables = Datatables::of($table);
        if($keyword = $request->get('search')['value'])
        {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum + 1 like ?', ["%{$keyword}%"]);
        }
        return $datatables
                ->addColumn('opsi', function($table){
                    return '
                    <a href="'.url('admin/siswa/'.$table->angkatan.'/'.$table->kelas.'/detail/'.$table->id).'" data-toggle="tooltip" title="Detail">
                        <button type="button" class="btn btn-default btn-sm">
                            <span class="glyphicon glyphicon-list-alt"></span>
                        </button> 
                    </a>
                    &nbsp;
                    <a href="'.url('admin/siswa/'.$table->angkatan.'/'.$table->kelas.'/edit/'.$table->id).'" data-toggle="tooltip" title="Edit">
                        <button type="button" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-pencil "></span>
                        </button> 
                    </a>
                    &nbsp;
                    <a href="'.url('admin/siswa/'.$table->angkatan.'/'.$table->kelas.'/delete/'.$table->id).'" onclick="return confirm(\'Hapus Siswa: '.$table->nama.'\')"  data-toggle="tooltip" title="Hapus">
                        <button type="button" class="btn btn-default btn-sm btn-danger">
                          <span class="glyphicon glyphicon-trash"></span>
                        </button>
                    </a>
                    ';
                })
                ->make(true);
    }

    // ADD DATA SISWA
     public function addData(Request $request)
    {
        $tambah = new Siswa();
        $tambah->NISN = $request['NISN'];
        $tambah->nama = ucwords($request['nama']);
        $tambah->jk = $request['jk'];
        $tambah->tempat_lahir = ucwords($request['tempat_lahir']);
        $tambah->tgl_lahir = $request['tgl_lahir'];
        $tambah->alamat = ucwords($request['alamat']);
        $tambah->RT = $request['RT'];
        $tambah->RW = $request['RW'];
        $tambah->dusun = ucwords($request['dusun']);
        $tambah->KPS = $request['KPS'];
        $tambah->data_ayah = ucwords($request['data_ayah']);
        $tambah->data_ibu = ucwords($request['data_ibu']);
        $tambah->angkatan = $request['angkatan'];
        $tambah->kelas_id = $request['kelas_id'];

        $tambah->save();

        return redirect()->to('admin/siswa/all');
    }

    // VIEW DETAIL DATA SISWA
    public function detail($angkatan,$kelas,$id)
    {
        $siswa  = Siswa::find($id);
        $kelas = KelasSiswa::where('id',$id)->first();
        return view('admin.siswa.detail_siswa',[
            'kelas' => $kelas,
            'siswa' => $siswa 
            ]);
    }

    // VIEW EDIT DATA SISWA
    public function edit($angkatan,$kelasAll,$id)
    {
        $siswa   = Siswa::find($id);
        $kelas = KelasSiswa::orderBy('id')->get();
        return view('admin.siswa.edit_siswa', [
                'kelas' => $kelas,
                'siswa' => $siswa,
            ]);
    }

    // EDIT DATA SISWA
    public function editPost(Request $request)
    {
        $id     = $request['id'];
        $siswa   = Siswa::find($id);

        $siswa->NISN = $request['NISN'];
        $siswa->nama = ucwords($request['nama']);
        $siswa->jk = $request['jk'];
        $siswa->tempat_lahir = ucwords($request['tempat_lahir']);
        $siswa->tgl_lahir = $request['tgl_lahir'];
        $siswa->alamat = ucwords($request['alamat']);
        $siswa->RT = $request['RT'];
        $siswa->RW = $request['RW'];
        $siswa->dusun = ucwords($request['dusun']);
        $siswa->KPS = $request['KPS'];
        $siswa->data_ayah = ucwords($request['data_ayah']);
        $siswa->data_ibu = ucwords($request['data_ibu']);
        $siswa->angkatan = $request['angkatan'];
        $siswa->kelas_id = $request['kelas_id'];
        
        $siswa->save();

        return redirect()->to('admin/siswa/all');
    }

    // DELETE DATA SISWA
    public function delete($angkatan,$kelasAll,$id)
    {
        $siswa   = Siswa::find($id);
        $siswa->delete();

        return redirect()->to('admin/siswa/all');
    }


}
