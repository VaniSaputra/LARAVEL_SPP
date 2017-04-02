<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use Auth;
use Datatables;
use DB;
use Redirect;

use App\Paket;

class PaketController extends Controller
{
    public function view()
    {
    	return view('admin.paket.view_paket');
    }

    public function indexData(Request $request)
    {
    	// Just to display mysql num rows, add this code
		DB::statement(DB::raw('set @rownum=0'));
		$table 	= Paket::select([DB::raw('@rownum := @rownum + 1 AS rownum'),
					'pakets.*',
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
	    			<a href="'.url('admin/paket/edit/'.$table->id).'" data-toggle="tooltip" title="Edit">
		    			<button type="button" class="btn btn-default btn-sm">
	          				<span class="glyphicon glyphicon-pencil "></span> Setting
	        			</button> 
	        		</a>
	        		&nbsp;
	        		<a href="'.url('admin/paket/delete/'.$table->id).'" onclick="return confirm(\'Hapus Kelas: '.$table->nama.'\')"  data-toggle="tooltip" title="Hapus">
	        			<button type="button" class="btn btn-default btn-sm btn-danger">
				          <span class="glyphicon glyphicon-trash"></span> Delete
				        </button>
	        		</a>
	        		';
	    		})
	    		->make(true);
    }

    public function addData(Request $request)
    {
    	$tambah 			= new Paket();
    	$tambah->nama 		= ucwords($request['nama']);
		$tambah->nominal 	= $request['nominal'];
		$tambah->tipe 		= $request['tipe'];
		$tambah->keterangan = $request['keterangan'];

		$tambah->save();

		return redirect()->to('admin/paket');

    }

      // Edit paket
    public function edit($id)
    {
    	// untuk mendapatkan id dari yang akan diedit
    	$paket = Paket::find($id);
    	return view('admin.paket.edit_paket',['paket' => $paket]);
    }

    public function editPost(Request $request)
    {
    	$id 	= $request['id'];
		$paket 	 = Paket::find($id);

		$paket->nama 	= ucwords($request['nama']);
			$nominal 		= $request['nominal'];
			$nominal 		= str_replace(',', '', $nominal); // hilangkan koma
		$paket->nominal 	= $nominal;
		$paket->tipe		= $request['tipe'];
		$paket->keterangan	= $request['keterangan'];

		$paket->save();

		return redirect()->to('admin/paket');
    }


    // Delete paket
    public function delete($id)
    {
    	$paket	= Paket::where('id', $id)->first();
    	$paket->delete();

    	return redirect()->to('admin/paket');
    }
}
