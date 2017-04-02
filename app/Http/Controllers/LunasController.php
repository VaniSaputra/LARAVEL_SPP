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
use App\Paket;
use App\General;

class LunasController extends Controller
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
                    <a href="'.url('admin/filter/status/'.$table->id).'" data-toggle="tooltip" title="keterangan">
                        <button type="button" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-pencil "></span> Keterangan Lunas
                        </button> 
                    </a>
                    ';
                })
                ->make(true);
    }

    public function getLunasPerbulan($siswa_id, $semester)
    {
        // Ambil sudah lunas berapa kali yang pembayaran perbulan
        $jumlah = Pembayaran::where([
                                    ['siswa_id', $siswa_id],
                                    ['semester', $semester]
                                    ]
                                )->count();
        return $jumlah;
    }

    public function status($id)
    {
    	$siswa  = Siswa::where('id',$id)->first();
    	$kelas  = KelasSiswa::where('id',$siswa->kelas_id)->first();

    	$pembayaran     = DB::table('pembayarans')
                        ->select('pembayarans.*','pakets.id as idpaket','pakets.nama as nama','pakets.tipe as tipe','pakets.semester as semester')
                        ->join('pakets','pembayarans.paket_id','=','pakets.id')
                        ->where('siswa_id', $id )
                        ->orderBy('id', 'desc')                        
                        ->get();

        // membuar array not in
        $bayar_ids  = array();
        foreach ($pembayaran as $bay) {
            if ($bay->tipe == 'perbulan') {
                array_push($bayar_ids, $bay->idpaket);
            }
        }

        // logika memunculkan paket
        if ($kelas->kelas=='VII')
            $paket  = Paket::whereIn('keterangan',['khusus kelas 7', 'semua'])
                    ->whereNotIn('id',$bayar_ids)
                    ->get();
        elseif ($kelas->kelas=='VIII') {
            $paket  = Paket::whereIn('keterangan',['khusus kelas 8', 'semua'])
                    ->whereNotIn('id',$bayar_ids)
                    ->get();
        }else{
            $paket = Paket::whereIn('keterangan',['khusus kelas 9', 'semua'])
                    ->whereNotIn('id',$bayar_ids)
                    ->where('semester','ganjil')
                    ->get();
        }

        $paketray = array();
        foreach ($paket as $dpaket) {
            array_push($paketray, $dpaket->id);
       }

  		// return GANJIL
        $lunasGanjil  = array();
        foreach ($pembayaran as $bay) {
            if ($bay->semester == 'ganjil') {
                array_push($lunasGanjil, $bay->idpaket);
            }
        }
        sort($lunasGanjil);


       $perbulan =  DB::table('pembayarans')
                ->select('pembayarans.id as id','pakets.id as idpaket')
                ->join('pakets','pembayarans.paket_id','=','pakets.id')
                ->where('pakets.id', '9' )                     
                ->count();

       return $perbulan;
        
       if ($lunasGanjil == $paketray ) {
        	return "Lunas";
        }else{
        	return "Belum Lunas";
        }
       
     // ==========================================
        

         $lunasGenap = array();
        foreach ($pembayaran as $bay) {
            if ($bay->semester == 'genap') {
                array_push($lunasGenap, $bay->idpaket);
            }
        }


    }
}
