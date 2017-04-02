<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Datatables;
use DB;
use Redirect;
use App;

use Carbon\Carbon;

use App\Siswa;
use App\KelasSiswa;
use App\Pembayaran;
use App\Paket;
use App\User;

class BayarController extends Controller
{
	// View Input NIS
    public function bayar($angkatan)
    {
        $filtertahun    = Siswa::select('angkatan')->distinct()->get();
        $kelas          = KelasSiswa::orderBy('id')->get();
        return view('admin.bayar.view_bayar', [
            'halaman' => 'bayar',
            'angkatan' => $angkatan,
            'filtertahun' => $filtertahun,
            'kelas' => $kelas,
            ]); 
    }

     // DATATABLES DATA_BAYAR.PHP
    public function indexData($angkatan, Request $request)
    {
        $kelas  = Siswa::where('angkatan', $angkatan)->get();
        $kelas_ids  = array();
        foreach ($kelas as $kel) {
            array_push($kelas_ids, $kel->id);
        }

        // Just to display mysql num rows, add this code
        DB::statement(DB::raw('set @rownum=0'));
        $table  = Siswa::select([DB::raw('@rownum := @rownum + 1 AS rownum'),
                    'siswas.*', 'kelas_siswas.kelas as kelas' ,'kelas_siswas.nama_kelas as nama_kelas',
                    
                    // Or Select all with table.*
                    ])
                    ->where('siswas.angkatan', $angkatan)
                    ->join('kelas_siswas', 'siswas.kelas_id','=','kelas_siswas.id')
                    ->get();
        // if(isset)
        $datatables = Datatables::of($table);
        if($keyword = $request->get('search')['value'])
        {
            $datatables->filterColumn('rownum', 'whereRaw', '@rownum + 1 like ?', ["%{$keyword}%"]);
        }
        return $datatables
                ->addColumn('opsi', function($table){
                     return '
                        <a href="'.url('admin/bayar/id/'.$table->id).'" data-toggle="tooltip" title="View Bayar">
                            <button type="button" class="btn btn-primary btn-sm">
                                Bayar
                            </button> 
                        </a>
                        ';
                    // if($this->cek_kelunasan($table->id, $table->kelas_id) == 'LUNAS') {
                    //     return '
                    //     <a href="'.url('admin/bayar/id/'.$table->id).'" data-toggle="tooltip" title="View Bayar">
                    //         <button type="button" class="btn btn-success btn-sm">
                    //             Lunas
                    //         </button> 
                    //     </a>
                    //     ';
                    // }else{
                    //     return '
                    //     <a href="'.url('admin/bayar/id/'.$table->id).'" data-toggle="tooltip" title="Bayar">
                    //         <button type="button" class="btn btn-primary btn-sm">
                    //             Belum lunas
                    //         </button> 
                    //     </a>
                    //     ';
                    // }
            
                })
                ->make(true);
    }

    public function getLunasPerbulan($siswa_id, $paket_id)
    {
        // Ambil sudah lunas berapa kali yang pembayaran perbulan
        $jumlah = Pembayaran::where([
                                    ['siswa_id', $siswa_id],
                                    ['paket_id', $paket_id]
                                    ]
                                )->count();
        return $jumlah;
    }

    // Input Data Pembayaran
    public function pembayaran($id,Request $request)
    {
        // View Pembayaran
        $siswa  = Siswa::where('id',$id)->first();
    	$kelas  = KelasSiswa::where('id',$siswa->kelas_id)->first();
        // Detail Pembayaran Per siswa
        $pembayaran     = DB::table('pembayarans')
                        ->select('pembayarans.*','pakets.id as idpaket','pakets.nama as nama','pakets.tipe as tipe','pakets.nominal as nominal', 'users.name as name')
                        ->join('users','pembayarans.user_id','=','users.id')
                        ->join('pakets','pembayarans.paket_id','=','pakets.id')
                        ->where([
                            ['siswa_id', $siswa->id, ],
                            ['kelas_id', $siswa->kelas_id]
                         ]  )
                        ->orderBy('id', 'desc')                        
                        ->get();

        // membuar array not in
        $bayar_ids  = array();
        foreach ($pembayaran as $bay) {
            if ($bay->tipe == 'sekali') {
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
                    ->get();
        }

        return view('admin.bayar.input_bayar',[
                    'siswa' => $siswa,
                    'kelas' => $kelas,
                    'paket' => $paket,
                    'pembayaran' => $pembayaran,
                    'spp7' => $this->getLunasPerbulan($siswa->id, '10'),
                    'spp8' => $this->getLunasPerbulan($siswa->id, '11'),
                    'spp9' => $this->getLunasPerbulan($siswa->id, '12'),
                    'ekskul' => $this->getLunasPerbulan($siswa->id, '8'),
                    'les' => $this->getLunasPerbulan($siswa->id, '9'),
                    // 'status_lunas' => $status,
                ]);

    }

    // public function cek_kelunasan($siswa_id, $kelas_id)
    // {
    //     $totalbayar     = Pembayaran::where([
    //                         ['siswa_id', $siswa_id],
    //                         ['kelas_id', $kelas_id],
    //                      ])
    //                     ->sum('nominal');
    //     $tagihan_kelas  = KelasSiswa::where('id', $kelas_id)->first();
    //     $tagihan_kelas  = $tagihan_kelas->tagihan;

    //     // return $totalbayar - $tagihan_kelas;

    //     if($tagihan_kelas - $totalbayar < 0) {
    //         return 'Pembayaran Berlebih dari Tagihan';
    //     }
    //     else if($tagihan_kelas - $totalbayar == 0) {
    //         return 'LUNAS';
    //     }
    //     else {
    //         return 'Belum Lunas.';
    //     }
    // }

    public function input(Request $request)
    {
        $id = $request['siswa_id'];
        $nominal = $request['nominal'];
        // $nominal = str_replace(',', '', $nominal); // hilangkan koma
        $kelas_id   = $request['kelas_id'];

        $bayar   = new Pembayaran();
        $bayar->siswa_id    = $id;
        $bayar->kelas_id    = $kelas_id;
        $bayar->paket_id    = $nominal = $request['paket_id'];
        $bayar->user_id     = Auth::user()->id;
        $bayar->save();

        return Redirect::to('admin/bayar/id/'.$id);
    }

    public function cetakAll($id)
    {
        $siswa  = Siswa::where('id',$id)->first();
        $kelas = KelasSiswa::where('id',$siswa->kelas_id)->first();

        $dt = Carbon::now();
        $dt = $dt->format('l, j F Y ');

        // Detail Pembayaran Per siswa
         $pembayaran     = DB::table('pembayarans')
                        ->select('pembayarans.*','pakets.id as idpaket','pakets.nama as nama','pakets.nominal as nominal', 'users.name as name')
                        ->join('users','pembayarans.user_id','=','users.id')
                        ->join('pakets','pembayarans.paket_id','=','pakets.id')
                        ->get();

        // $status         = $this->cek_kelunasan($siswa->id, $siswa->kelas_id);

        $pdf = App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('admin.bayar.cetak_bayar',[
                    'siswa' => $siswa,
                    'kelas' => $kelas,
                    'pembayaran' => $pembayaran,
                    'dt'    => $dt,
                    // 'status_lunas' => $status,
                ]);
        return $pdf->stream(); 
    }

    public function cetakId($id,$idbayar)
    {
        $siswa  = Siswa::where('id',$id)->first();
        $kelas = KelasSiswa::where('id',$siswa->kelas_id)->first();

        $dt = Carbon::now();
        $dt = $dt->format('l, j F Y ');

        // Detail Pembayaran Per siswa
         $pembayaran     = DB::table('pembayarans')
                        ->select('pembayarans.*','pakets.id as idpaket','pakets.nama as nama','pakets.nominal as nominal', 'users.name as name')
                        ->join('users','pembayarans.user_id','=','users.id')
                        ->join('pakets','pembayarans.paket_id','=','pakets.id')
                        ->where('pembayarans.id','=',$idbayar)
                        ->get();

        // $status         = $this->cek_kelunasan($siswa->id, $siswa->kelas_id);

        $pdf = App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('admin.bayar.cetak_bayar',[
                    'siswa' => $siswa,
                    'kelas' => $kelas,
                    'pembayaran' => $pembayaran,
                    'dt'    => $dt,
                    // 'status_lunas' => $status,
                ]);
        return $pdf->stream(); 
    }

    public function delete($id)
    {
        $siswa   = Pembayaran::find($id);
        $siswa->delete();

        return redirect()->to('admin/bayar/id/'.$siswa->siswa_id);
    }

    public function errorbayar()
    {
        return view('errors.404');
    }

}
