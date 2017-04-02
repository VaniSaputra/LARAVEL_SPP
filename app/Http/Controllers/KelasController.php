<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Datatables;
use DB;
use Redirect;

use App\KelasSiswa;
use App\Siswa;
use App\Pembayaran;
use App\General;


class KelasController extends Controller
{
	// view kelas
    public function manage()
    {
    	$halaman = 'manage_kelas';
    	$kelas_siswas   = General::getEnumValues('kelas_siswas', 'nama_kelas');
    	return view('admin.kelas.view_kelas', [
    		'halaman' => $halaman,
    		'kelas_siswas' => $kelas_siswas,
    		]);
    }

    // DATATABLES
    public function indexData(Request $request)
    {
		// Just to display mysql num rows, add this code
		DB::statement(DB::raw('set @rownum=0'));
		$table 	= KelasSiswa::select([DB::raw('@rownum := @rownum + 1 AS rownum'),
					'kelas_siswas.*',
					// Or Select all with table.*
					])->get();
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
	    			<a href="'.url('admin/kelas/edit/'.$table->id).'" data-toggle="tooltip" title="Edit">
		    			<button type="button" class="btn btn-default btn-sm">
	          				<span class="glyphicon glyphicon-pencil "></span> Setting
	        			</button> 
	        		</a>
	        		&nbsp;
	        		<a href="'.url('admin/kelas/delete/'.$table->id).'" 
	        		onclick="return confirm(\'Hapus Kelas: '.$table->kelas.' - '.$table->nama_kelas.'\')"  data-toggle="tooltip" title="Hapus">
	        			<button type="button" class="btn btn-default btn-sm btn-danger">
				          <span class="glyphicon glyphicon-trash"></span> Delete
				        </button>
	        		</a>
	        		';
	    		})
	    		->make(true);
    }

    // Add data kelas
    public function addData(Request $request)
    {		
    	// cek data sudah ada apa belom
		$cek 	= KelasSiswa::where([
					['kelas', $request['kelas']],['nama_kelas', $request['nama_kelas'] ]			
					])->first();

		if(isset($cek->id)) {
			return redirect()->to('admin/kelas');
		}

		// Berhasil
		$tambah = new KelasSiswa();
		$tambah->kelas = $request['kelas'];
		$tambah->nama_kelas = $request['nama_kelas'];
		 // $tambah->enum('nama_kelas',array_keys($request['nama_kelas']));
		
		$tambah->save();

		return redirect()->to('admin/kelas');
    }

    // Edit kelas
    public function edit($id)
    {
    	// untuk mendapatkan id dari yang akan diedit
    	$kelas = KelasSiswa::find($id);
    	return view('admin.kelas.edit_kelas',['kelas' => $kelas]);
    }

    public function editPost(Request $request)
    {
    	$id 	= $request['id'];
		$kelas 	 = KelasSiswa::find($id);

		$kelas->kelas = $request['kelas'];
		$kelas->nama_kelas = $request['nama_kelas'];
		// $tagihan = $request['tagihan'];
		// $tagihan = str_replace(',', '', $tagihan); // hilangkan koma
		// $kelas->tagihan = $tagihan;
		
		$kelas->save();

		return redirect()->to('admin/kelas');
    }

    // Delete Kelas
    public function delete($id)
    {
    	$kelas  = KelasSiswa::find($id);

    	$caridisiswa 	= Siswa::where('kelas_id', $id)->first();
    	if(isset($caridisiswa->id)) {
    		return redirect()->to('admin/kelas')->with('pesanwarning', 'Error Masih ada siswa dalam kelas ini');    		
    	}

    	$caridipembayaran = Pembayaran::where('kelas_id', $id)->first();
    	if(isset($caridipembayaran->id)) {
    		return redirect()->to('admin/kelas')->with('pesanwarning', 'Error Masih ada histori pembayaran dengan kelas ini');    		
    	}

    	// Delete
    	$kelas->delete();

    	return redirect()->to('admin/kelas');
    }

  

}
