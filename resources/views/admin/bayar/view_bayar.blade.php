@extends('layouts.awal')
@section('title', 'Bayar')


@section('content')

	<!-- ==BODY CONTENT == -->
	<nav class="container">
		<!-- ==ROW HEADER== -->
		<div class="row">
			<h3 class="text-center text-primary">PEMBAYARAN SPP</h3>
			<hr>
		</div>
		<!-- //ROW HEADER -->

		<!-- =ROW FILTER== -->
		<div class="row">
			<div class="col-md-1"><button type="button" class="btn btn-danger">Filter By</button></div>
			<div class="btn-group">
				<button type="button" class="btn btn-primary">Tahun</button>
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
					<li><a href="{{ url('admin/bayar/all') }}">Pilih Tahun Angkatan</a></li>
					@foreach($filtertahun as $dtahun)
				    <li><a href="{{ url('admin/bayar/'.$dtahun->angkatan) }}">{{ $dtahun->angkatan }}</a></li>
				    @endforeach
				</ul>
			</div>	
		</div></br>
		<!-- /ROW FILTER -->

		<!-- =DATATABLES -->
		<div class="row">
			<div class="col-md-12 table-responsive">
	            <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>NISN</th>
	                        <th>Nama</th>
	                        <th>Kelas</th>
	                        <th>Tahun</th>
	                        <th class="hide-print">Opsi</th>
	                    </tr>
	                </thead>
	            </table>
	        </div> 
		</div>
			        <!-- /DATATABLES -->
	</nav>
	<!-- //BODY CONTENT -->

@push('jslib')
<script>
	// Datatable View
	var datatable =
	$('#datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{ url("admin/bayar/".$angkatan."/getdata") }}',
		columns: [
			{ data: 'rownum', name: 'rownum', searchable: false },
			{ data: 'NISN', name: 'NISN' },
			{ data: 'nama', name: 'nama' },
			{ data: 'kelas', name: 'kelas' },	
			{ data: 'angkatan', name: 'angkatan' },	
			{ data: 'opsi', name: 'opsi' },
		],
		order: [ [0, 'desc'] ]
	});
	// tooltip
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	    $('#tahunfilter').val('{{ $angkatan }}');
	});
	// filter
	$('#tahunfilter').change(function() {
		var tahunnya = $('#tahunfilter').val();
		document.location = '{{ url("admin/bayar") }}' + '/' + tahunnya;
	})
</script>
@endpush

@endsection
