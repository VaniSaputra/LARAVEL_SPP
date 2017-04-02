<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


Use Excel;
use Auth;
use DB;
use Redirect;

use App\Siswa;
use App\KelasSiswa;

class ExcelController extends Controller
{
    public function getImport()
    {
        $kelas = KelasSiswa::orderBy('id')->get();
    	return view('excel.import',[
                'kelas' => $kelas
            ]);
    }

    public function postImport(Request $request)
    {
    	$file = Input::file('file');
 
    	/* Upload ambil file excel kemudia simpan ke dalam               Mahasiswa */
        $data = Excel::load($file);
        $data 	= $data->toArray();

		if(!empty($data)){
            foreach ($data as $data) {
                $tambah = new Siswa();
                $tambah->nis = $data['nis'];
                $tambah->nama = ucwords($data['nama']);
                $tambah->jk = $data['jk'];
                $tambah->tempat_lahir = $data['tempat_lahir'];
                $tambah->tgl_lahir = $data['tgl_lahir'];
                $tambah->alamat = $data['alamat'];
                $tambah->kelas_id = $request['kelas'];

                $tambah->save();
            }			
		}
        // }// close foreach

        return redirect()->to('admin/siswa/all');

    }

    public function exportExcel()
	{
        $kelas = KelasSiswa::orderBy('id')->get();
        return view('excel.export',[
                'kelas' => $kelas
            ]);
	}

    public function postExport(Request $request)
    {
        $id_kelas = $request['kelas'];
        $kelas    = KelasSiswa::where('id',$id_kelas)->get();
        $data     = Siswa::select('nis', 'nama', 'jk', 'tempat_lahir', 'tgl_lahir', 'alamat')->where('kelas_id',$id_kelas)->get()->toArray();
        
        foreach ($kelas as $kelas) { 
            return Excel::create('Data_Siswa_'.$kelas['kelas'].'_'.$kelas['tahun'].'_export', function($excel) use ($data) {
             $excel->sheet('mySheet', function($sheet) use ($data)
                {
                 $sheet->fromArray($data);
                });
            })->download('xlsx');
        }
    }

}
