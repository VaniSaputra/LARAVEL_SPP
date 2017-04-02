<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Rute untuk Admin
Route::group(['middleware' => 'isAdmin'], function() {
	//  ==MENU==
	Route::get('menu','HomeController@menu');

	//  ==AWAL==
	Route::get('admin/filter/{angkatan}/{kelasAll}/{namakelas}', 'LunasController@dataSiswa');
	Route::get('admin/filter/{angkatan}/{kelasAll}/{namakelas}/getdata/', 'LunasController@siswaTable'); 
	//lunas bayar
	Route::get('admin/filter/status/{id}','LunasController@status');

	// ==SISWA==

		// datatables add siswa
	Route::get('admin/siswa/{angkatan}/{kelasAll}/{namakelas}', 'SiswaController@index');
	Route::get('admin/siswa/{angkatan}/{kelasAll}/{namakelas}/getdata', 'SiswaController@indexData');
	// add data siswa
	Route::post('admin/siswa/addData','SiswaController@addData');
	// detail Siswa
	Route::get('admin/siswa/{angkatan}/{kelasAll}/detail/{id}','SiswaController@detail');
	// edit
	Route::get('admin/siswa/{angkatan}/{kelasAll}/edit/{id}','SiswaController@edit');
	Route::post('admin/siswa/edit','SiswaController@editPost');
	// delete
	Route::get('admin/siswa/{angkatan}/{kelasAll}/delete/{id}','SiswaController@delete');

	// ==KELAS==

	// setting kelas
	Route::get('admin/kelas/', 'KelasController@manage');
	// datatables kelas
	Route::get('admin/kelas/getdata', 'KelasController@indexData');
	// add data kelas
	Route::post('admin/kelas/addData','KelasController@addData');
	// edit kelas
	Route::get('admin/kelas/edit/{id}','KelasController@edit');
	Route::post('admin/kelas/edit','KelasController@editPost');
	// delete kelas
	Route::get('admin/kelas/delete/{id}','KelasController@delete');

	//  ==BAYAR==

	// view input nis
	Route::get('admin/bayar/{angkatan}', 'BayarController@bayar');
	// Datatable
	Route::get('admin/bayar/{angkatan}/getdata', 'BayarController@indexData');
	//  view pembayaran
	Route::get('admin/bayar/id/{id}','BayarController@pembayaran');
	// input pembayaran
	Route::post('admin/bayar/input','BayarController@input');
	Route::get('autocomplete',array('as'=>'autocomplete','uses'=>'BayarController@autocomplete'));
	// Detail Pembayaran
	Route::get('admin/bayar/cetakAll/{id}','BayarController@cetakAll');
	Route::get('admin/bayar/cetakId/{id}/{idbayar}', 'BayarController@cetakId');
	// Hapus Pembayaran
	Route::get('admin/bayar/delete/{id}','BayarController@delete');

	// ==REKAP==

	// tampilan input tgl rekap
	Route::get('admin/rekap', 'RekapController@rekap');
	// tampilan data
	Route::post('admin/rekap/cari', 'RekapController@viewData');
	// cetak rekap per kelas
	Route::get('admin/rekap/cetak/{kelas}/{tahun}/{tgl1}/{tgl2}','RekapController@cetak');
	// cetak rekap semua kelas
	Route::get('admin/rekap/cetak/{tgl1}/{tgl2}','RekapController@cetakAll');

	//  ==PAKET==

	// view Paket
	Route::get('admin/paket','PaketController@view');
	// datatables paket
	Route::get('admin/paket/getdata', 'PaketController@indexData');
	//add data paket
	Route::post('admin/paket/addData', 'PaketController@addData');
	// edit paket
	Route::get('admin/paket/edit/{id}','PaketController@edit');
	Route::post('admin/paket/edit','PaketController@editPost');
	// delete paket
	Route::get('admin/paket/delete/{id}','PaketController@delete');

	//  ==Import==
	Route::get('admin/excel/import','ExcelController@getImport');
	Route::post('admin/excel/import2','ExcelController@postImport');
	Route::get('admin/excel/export', 'ExcelController@exportExcel');
	Route::post('admin/excel/export2', 'ExcelController@postExport');
		
});

// Rute untuk TU
Route::group(['middleware' => 'isTU'], function() {
	//  ==MENU==
	Route::get('menu','HomeController@menu');

	//  ==AWAL==
	Route::get('admin/filter/{tahun}/{status?}', 'SiswaController@dataSiswa');
	Route::get('admin/filter/{tahun}/getdata/{status?}', 'SiswaController@siswaTable'); 

	// ==SISWA==

	// datatables add siswa
	Route::get('admin/siswa/{tahun}/{kelasz}', 'SiswaController@index');
	Route::get('admin/siswa/{tahun}/getdata/{kelasz}', 'SiswaController@indexData');
	// add data siswa
	Route::post('admin/siswa/addData','SiswaController@addData');
	// detail Siswa
	Route::get('admin/siswa/{tahun}/detail/{id}','SiswaController@detail');
	// edit
	Route::get('admin/siswa/{tahun}/edit/{id}','SiswaController@edit');
	Route::post('admin/siswa/edit','SiswaController@editPost');
	// delete
	Route::get('admin/siswa/{tahun}/delete/{id}','SiswaController@delete');

	// ==KELAS==

	// setting kelas
	Route::get('admin/kelas/', 'KelasController@manage');
	// datatables kelas
	Route::get('admin/kelas/getdata', 'KelasController@indexData');
	// add data kelas
	Route::post('admin/kelas/addData','KelasController@addData');
	// edit kelas
	Route::get('admin/kelas/edit/{id}','KelasController@edit');
	Route::post('admin/kelas/edit','KelasController@editPost');
	// delete kelas
	Route::get('admin/kelas/delete/{id}','KelasController@delete');

	//  ==BAYAR==

	// view input nis
	Route::get('admin/bayar/{tahun}', 'BayarController@bayar');
	// Datatable
	Route::get('admin/bayar/{tahun}/getdata', 'BayarController@indexData');
	//  view pembayaran
	Route::get('admin/bayar/id/{id}','BayarController@pembayaran');
	// input pembayaran
	Route::post('admin/bayar/input','BayarController@input');
	// Detail Pembayaran
	Route::get('admin/bayar/cetakAll/{id}','BayarController@cetakAll');
	Route::get('admin/bayar/cetakId/{id}/{idbayar}', 'BayarController@cetakId');
	// Hapus Pembayaran
	Route::get('admin/bayar/delete/{id}','BayarController@delete');

	// ==REKAP==

	// tampilan input tgl rekap
	Route::get('admin/rekap', 'RekapController@rekap');
	// tampilan data
	Route::post('admin/rekap/cari', 'RekapController@viewData');
	// cetak rekap per kelas
	Route::get('admin/rekap/cetak/{kelas}/{tahun}/{tgl1}/{tgl2}','RekapController@cetak');
	// cetak rekap semua kelas
	Route::get('admin/rekap/cetak/{tgl1}/{tgl2}','RekapController@cetakAll');

	//  ==Import==
	Route::get('admin/excel/import','ExcelController@getImport');
	Route::post('admin/excel/import2','ExcelController@postImport');
	Route::get('admin/excel/export', 'ExcelController@exportExcel');
	Route::post('admin/excel/export2', 'ExcelController@postExport');
		
});

// Rute untuk Kepala Sekolah
Route::group(['middleware' => 'isKepsek'], function() {
	//  ==MENU==
	Route::get('menu','HomeController@menu');
	
	//  ==AWAL==
	Route::get('admin/filter/{tahun}/{status?}', 'SiswaController@dataSiswa');
	Route::get('admin/filter/{tahun}/getdata/{status?}', 'SiswaController@siswaTable'); 

	// ==SISWA==

	// datatables add siswa
	Route::get('admin/siswa/{tahun}', 'SiswaController@index');
	Route::get('admin/siswa/{tahun}/getdata', 'SiswaController@indexData');

	// ==KELAS==

	// setting kelas
	Route::get('admin/kelas/', 'KelasController@manage');
	// datatables kelas
	Route::get('admin/kelas/getdata', 'KelasController@indexData');

	//  ==BAYAR==

	// view input nis
	Route::get('admin/bayar/{tahun}', 'BayarController@bayar');
	// Datatable
	Route::get('admin/bayar/{tahun}/getdata', 'BayarController@indexData');

});

Route::get('/', function () {
    return view('welcome');
});

Route::auth();
// login
Route::get('/home', 'HomeController@index');

// ERROR
// error bayar
Route::get('error/bayar','BayarController@errorbayar');