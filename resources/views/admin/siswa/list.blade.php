@extends('layouts.awal')
@section('title', 'List Status Data Siswa')


@section('content')

	<!-- ==BODY CONTENT== -->
	<nav class="container">
		<!-- ==ROW HEADER== -->
		<div class="row">
			<h2 class="text-center text-primary">SISTEM INFORMASI PEMBAYARAN SPP</h2>
			<hr>
		</div>

		<!-- ==ROW FILTER== -->
		<div class="row">
			<!-- filterbutton -->
			<div class="col-md-1"><button type="button" class="btn btn-danger">Filter By</button></div>

			<!-- filterbutton -->
			<div class="col-md-4">
				<!-- filtertahun -->
				<div class="btn-group">
					<button type="button" class="btn btn-primary">Tahun</button>
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('admin/filter/all') }}">Pilih Tahun Angkatan</a></li>
						@foreach($filtertahun as $dtahun)
					    <li><a href="{{ url('admin/filter/'.$dtahun->angkatan) }}">{{ $dtahun->angkatan }}</a></li>
					    @endforeach
					</ul>
				</div>	

				<!-- filter kelas -->
				<div class="btn-group">
					<button type="button" class="btn btn-primary">Kelas</button>
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('admin/filter/all') }}">Pilih kelas siswa</a></li>
						@foreach($filterkelas as $dkelas)
					    <li><a href="{{ url('admin/filter/'.$angkatan.'/'.$dkelas->kelas) }}">{{ $dkelas->kelas }}</a></li>
					    @endforeach
					</ul>
				</div>	

				<!-- filter nama kelas -->
				<div class="btn-group">
					<button type="button" class="btn btn-primary">Nama Kelas</button>
					<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<li><a href="{{ url('admin/filter/all') }}">Pilih kelas siswa</a></li>
						@foreach($filternamakelas as $nkelas)
					    <li><a href="{{ url('admin/filter/'.$angkatan.'/'.$kelasAll.'/'.$nkelas->nama_kelas) }}">{{ $nkelas->nama_kelas }}</a></li>
					    @endforeach
					</ul>
				</div>	
			</div>	
		</div>	

		<!-- ==keterangan filter== -->
		<div class="row">
			<div class="col-md-6"><h5>*Urutan filter : tahun angkatan / kelas / nama kelas</h5></div>
		</div>

		</br>
		<!-- ==ROW TABEL== -->
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
	                        <th>Tahun angatan</th>
	                        <th class="hide-print">Opsi</th>
	                    </tr>
	                </thead>
	            </table>
	        </div> <!-- //DATATABLES -->
		</div><!-- //ROW TABEL-->
	</nav> <!-- //BODY CONTENT -->



@push('jslib')

<script>
		// Datatable View
	var datatable =
	$('#datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{ url("admin/filter/".$angkatan."/".$kelasAll."/".$namakelas."/getdata") }}',
		columns: [
			{ data: 'rownum', name: 'rownum', searchable: false },
			{ data: 'NISN', name: 'NISN' },
			{ data: 'nama', name: 'nama' },
			{ data: 'kelas', name: 'kelas' },	
			{ data: 'nama_kelas', name: 'nama_kelas' },
			{ data: 'angkatan', name: 'angkatan' },	
			{ data: 'opsi', name: 'opsi', sortable: false, searchable: false },
		],
		order: [ [0, 'desc'] ]		
	});

	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	    $('#tahunfilter').val('{{ $angkatan }}');
	});
	$('#tahunfilter').change(function() {
		var tahunnya = $('#tahunfilter').val();
		document.location = '{{ url("admin/filter") }}' + '/' + tahunnya;
	})
</script>
@endpush

@endsection
