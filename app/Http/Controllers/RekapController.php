<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Datatables;
use DB;
use Redirect;
use App;

use carbon\Carbon;

use App\Siswa;
use App\KelasSiswa;
use App\Pembayaran;
use App\User;

class RekapController extends Controller
{
     public function rekap()
    {
    	$halaman = 'rekap';
    	return view('admin.rekap.rekap_pembayaran',compact('halaman'));
    }

    public function viewData(Request $request)
    {
    	$tgl1 = $request['tgl1'];
        $tgl2 = $request['tgl2'];
        $data = DB::table('pembayarans')
                ->select('pembayarans.id as id',DB::raw('sum(nominal) as nominal'),'pembayarans.created_at as created_at','pembayarans.kelas_id as kelas_id',  'kelas_siswas.kelas as kelas', 'kelas_siswas.tahun as tahun')
                ->join('kelas_siswas', 'pembayarans.kelas_id', '=', 'kelas_siswas.id')
                ->whereBetween('pembayarans.created_at',[$tgl1,$tgl2])
                ->groupBy('kelas_id')
                ->get();


        if($data == [] ){
            return redirect()->to('admin/rekap')->with('pesanwarning', 'Periksa kembali TANGGAL yang anda masukan!!! *tidak boleh sama dan terbalik');
        }

        return view('admin.rekap.view_rekap',[
                'data' => $data,
                'tgl1'  => $tgl1,
                'tgl2'  => $tgl2
                ]);      
    }   

    // CETAK
    public function cetak($kelas,$tahun,$tgl1,$tgl2)
    {
        $dt = Carbon::now();
        $dt = $dt->format('l, j F Y ');

        $data = DB::table('pembayarans')
                ->select('pembayarans.id as id',DB::raw('sum(nominal) as nominal'),'pembayarans.created_at as created_at','pembayarans.kelas_id as kelas_id',  'kelas_siswas.kelas as kelas', 'kelas_siswas.tahun as tahun')
                ->join('kelas_siswas', 'pembayarans.kelas_id', '=', 'kelas_siswas.id')
                ->whereBetween('pembayarans.created_at',[$tgl1,$tgl2])
                ->where([
                        ['kelas', '=', $kelas],
                        ['tahun', '=', $tahun]
                 ])
                ->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('admin.rekap.cetak_rekap', [
                'data' => $data,
                'tgl1' => $tgl1,
                'tgl2' => $tgl2,
                'dt'   => $dt
                ]);
        return $pdf->stream();     
    }

    public function cetakAll($tgl1,$tgl2)
    {
        $dt = Carbon::now();
        $dt = $dt->format('l, j F Y ');

        $data = DB::table('pembayarans')
                ->select('pembayarans.id as id',DB::raw('sum(nominal) as nominal'),'pembayarans.created_at as created_at','pembayarans.kelas_id as kelas_id',  'kelas_siswas.kelas as kelas', 'kelas_siswas.tahun as tahun')
                ->join('kelas_siswas', 'pembayarans.kelas_id', '=', 'kelas_siswas.id')
                ->whereBetween('pembayarans.created_at',[$tgl1,$tgl2])
                ->groupBy('kelas_id')
                ->get();

        $pdf = App::make('dompdf.wrapper');
        $pdf = \PDF::loadView('admin.rekap.cetak_rekap', [
                'data' => $data,
                'tgl1' => $tgl1,
                'tgl2' => $tgl2,
                'dt'   => $dt
                ]);
        return $pdf->stream();

    }
}
