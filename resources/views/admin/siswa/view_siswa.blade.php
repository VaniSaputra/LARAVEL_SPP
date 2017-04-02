@extends('layouts.awal')
@section('title', 'Siswa')


@section('content')

	<!-- ==BODY CONTENT== -->
	<nav class="container">
		<div class="row">
			<h2 class="text-center text-primary">SISTEM INFORMASI PEMBAYARAN SPP</h2>
			<h2 class="text-center text-primary">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					Tambah Siswa <span class="glyphicon glyphicon-plus"></span> 
				</button>
			</h2>
			<!-- ==MODAL ADD SISWA== -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<!-- ==MODAL HEADER== -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Masukan data siswa</h4>
						</div>
						<!-- ==MODAL BODY== -->
						<div class="modal-body">
							<!-- FORM TAMBAH DATA SISWA -->
							<form class="form-horizontal" role="form" method="post" action="{{ url('admin/siswa/addData') }}">
							   {!! csrf_field() !!}
								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="kontingen_pilih">NISN</label>  
									<div class="col-md-6">
										<input  name="NISN" type="number" placeholder="nomor induk siswa" class="form-control input-md" required=""> 
									</div>
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Nama Siswa</label>  
									<div class="col-md-6">
										<input name="nama" type="text" placeholder="Nama Lengkap Siswa" class="form-control input-md" required="" id="siswa_pilih">
									</div>            
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Jenis Kelamin</label>
									<div class="col-md-6">
										<select name="jk" class="form-control" id="sel1">
											<option>Jenis kelamin</option>
											@foreach($jk as $jenis)
												<option value="{{ $jenis }}">{{ $jenis }}</option>
											@endforeach
										</select>
									</div>
							    </div>

							    <!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Tempat, Tanggal Lahir</label>  
									<div class="col-md-3">
										<input name="tempat_lahir" type="text" placeholder="tempat lahir Siswa" class="form-control input-md" required="">
									</div> 
									<div class="col-sm-3">
								        <input id="datepicker" name="tgl_lahir" type="text" placeholder="1995-07-28 (Contoh 28 Juli 1995)" class="form-control input-md" required="" />
								     </div>       
								</div>

								
								 <!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Alamat Rumah</label> 
									<div class="col-md-2">
										<input name="dusun" type="text" placeholder="dusun" class="form-control input-md" required="">
									</div> 
									<div class="col-md-2">
										<input name="RT" type="number" placeholder="RT 1" class="form-control input-md" required="">
									</div>  
									<div class="col-md-2">
										<input name="RW" type="number" placeholder="RW 1" class="form-control input-md" required="">
									</div>           
								</div>

								 <!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">&nbsp;</label>  
									<div class="col-md-6">
										<input name="alamat" type="text" placeholder="alamat" class="form-control input-md" required="">
									</div>            
								</div>

								 <!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">No. KPS</label>  
									<div class="col-md-6">
										<input name="KPS" type="number" placeholder="Nomer KPS" class="form-control input-md">
									</div>            
								</div>

								 <!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Nama Ayah & Ibu</label>  
									<div class="col-md-3">
										<input name="data_ayah" type="text" placeholder="nama ayah" class="form-control input-md" required="">
									</div>
									<div class="col-md-3">
										<input name="data_ibu" type="text" placeholder="nama ibu" class="form-control input-md" required="">
									</div>               
								</div>

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Kelas, Angkatan</label>
									<div class="col-md-3">
										<select name="kelas_id" class="form-control" id="sel1">
										<option >kelas siswa</option>
										@foreach($kelas as $kelas)
											<option value="{{ $kelas['id'] }}">{{ $kelas['kelas'] }} - {{ $kelas['nama_kelas'] }}</option>
										@endforeach
										</select>
									</div>
									<div class="col-md-3">
										<input name="angkatan" type="text" placeholder="*contoh(2017-2018)" class="form-control input-md" required="">
									</div> 
							    </div>

								<!-- Text submit -->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">&nbsp;</label> 
									<div class="col-sm-6 btn-group">
										<input name="submit" class="col-sm-6 btn btn-primary" id="focusedInput" type="submit" value="kirim">
										<input class="col-sm-6 btn btn-default" id="focusedInput" type="reset" value="reset">
									</div>
								</div>
							</form> <!--/ FORM TAMBAH DATA SISWA -->
						</div> <!-- //MODAL BODY -->

						<!-- ==MODAL FOOTER== -->
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div> <!-- //MODAL FOOTER -->

					</div>
				</div>
			</div> <!-- //MODAL BODY-->	
			<hr>
		</div> <!-- //ROW -->

		<!-- ==ROW FILTER== -->
		<div class="row">
			<div class="col-md-1"><button type="button" class="btn btn-danger">Filter By</button></div>
			<div class="col-md-6">

				<!-- Tahun filter -->
				<div class="btn-group">
					<button type="button" class="btn btn-primary">Tahun</button>
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('admin/siswa/all') }}">Pilih Tahun Angkatan</a></li>
						@foreach($filtertahun as $ftahun)
					    	<li><a href="{{ url('admin/siswa/'.$ftahun->angkatan ) }}">{{ $ftahun->angkatan }} </a></li>
					    @endforeach
					</ul>
				</div>

				<!-- Tahun filter -->
				<div class="btn-group">
					<button type="button" class="btn btn-primary">Kelas</button>
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('admin/siswa/'.$angkatan.'/all') }}">Pilih kelas siswa</a></li>
						@foreach($filterkelas as $fkelas)
					    	<li><a href="{{ url('admin/siswa/'.$angkatan.'/'.$fkelas->kelas ) }}">{{ $fkelas->kelas }}</a></li>
						@endforeach
					</ul>
				</div> 

				<!-- kelas nama filter -->
				<div class="btn-group">
					<button type="button" class="btn btn-primary">Nama Kelas</button>
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('admin/siswa/'.$angkatan.'/'.$kelasAll.'/all') }}">Pilih namakelas siswa</a></li>
						@foreach($filternamakelas as $nkelas)
					    	<li><a href="{{ url('admin/siswa/'.$angkatan.'/'.$kelasAll.'/'.$nkelas->nama_kelas ) }}">{{ $nkelas->nama_kelas }}</a></li>
						@endforeach
					</ul>
				</div> 

				<!-- ==Opsi Data== -->
				<div class="btn-group">
					<button type="button" class="btn btn-success">Opsi Data</button>
					<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('admin/excel/import') }}">Import data siswa</a></li>
						<li><a href="{{ url('admin/excel/export') }}">Export data siswa</a></li>
					</ul>
				</div> 
				<!-- //Opsi Data -->
			</div>   
		</div> <!-- //ROW FILTER -->
		
		<!-- ==keterangan filter== -->
		<div class="row">
			<div class="col-md-6"><h5>*Urutan filter : angkatan / kelas / nama kelas</h5></div>
		</div>

		<!-- ==Keterangan Siswa== -->
		<div class="row">
			<div class="col-md-12">
				<h6><b>// Semua Siswa : {{ $jumlahsemua->jumlah }} &nbsp; // Siswa Laki-Laki : {{ $jumlahL->jumlah }} &nbsp;  // Siswa Perempuan : {{ $jumlahP->jumlah }} &nbsp; <a href=""><span class="glyphicon glyphicon-share"></span> lihat detail</a></b></h6>
			</div>
		</div>

		<!-- ==ROW== -->
		<div class="row">
			<!-- ==DATATABLES== -->
			<div class="col-md-12 table-responsive">
	            <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>NISN</th>
	                        <th>Nama</th>
	                        <th>Kelas</th>
	                        <th>Nama Kelas</th>
	                        <th>Tahun</th>
	                        <th class="hide-print">Opsi</th>
	                    </tr>
	                </thead>
	            </table>
	        </div> <!-- //DATATABLES -->
		</div><!-- //ROW -->

	</nav> <!-- //BODY CONTENT -->


@push('jslib')
<script>
		// Datatable View
	var datatable =
	$('#datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{ url("admin/siswa/".$angkatan."/".$kelasAll."/".$namakelas."/getdata") }}',
		columns: [
			{ data: 'rownum', name: 'rownum', searchable: false },
			{ data: 'NISN', name: 'NISN' },
			{ data: 'nama', name: 'nama' },
			{ data: 'kelas', name: 'kelas' },	
			{ data: 'nama_kelas', name: 'nama_kelas' },
			{ data: 'angkatan', name: 'angkatan' },	
			{ data: 'opsi', name: 'opsi' },
		],
		order: [ [0, 'desc'] ]
	});

	// Datepicker BS 3
	$('#datepicker').datetimepicker({
		viewMode: 'days',
		format: 'YYYY-MM-DD'
	}); 
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	    $('#tahunfilter').val('{{ $angkatan }}');
	});
	$('#tahunfilter').change(function() {
		var tahunnya = $('#tahunfilter').val();
		document.location = '{{ url("admin/siswa") }}' + '/' + tahunnya;
	})
	$('#kelasfilter').change(function() {
		var kelasnya = $('#kelasfilter').val();
		var tahunnya = $('#tahunfilter').val();
		document.location = '{{ url("admin/siswa") }}' + '/' + tahunnya + '/' + kelasnya;
	})
		$('#namakelasfilter').change(function() {
		var namakelasnya = $('#namakelasfilter').val();
		var kelasnya = $('#kelasfilter').val();
		var tahunnya = $('#tahunfilter').val();
		document.location = '{{ url("admin/siswa") }}' + '/' + tahunnya + '/' + kelasnya + '/' + namakelasnya;
	})
</script>
@endpush

@endsection
