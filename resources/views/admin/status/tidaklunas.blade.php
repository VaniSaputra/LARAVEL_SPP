@extends('layouts.awal')
@section('title', 'Tidak Lunas')


@section('content')

	<!-- DATATABLES -->
	<nav class="container">
		<div class="row">
			<h2 class="text-center text-primary">SISTEM INFORMASI PEMBAYARAN SPP</h2>
			<h2 class="text-center text-primary">	
			<hr>
		</div> 
		<!-- //ROW -->
		<div class="row">
			<h4 class="text-primary">        
		        <button type="button" class="btn btn-danger">Filter By</button>
		        <div class="btn-group">
					 <a href="{{ url('admin/list/lunas') }}"> <button type="button" class="btn btn-primary">Lunas</button> </a>
				</div>
				<div class="btn-group">
					 <a href="{{ url('admin/list/tidaklunas') }}"> <button type="button" class="btn btn-primary">Belum Lunas</button> </a>
				</div>
				<div class="btn-group">
					 <a href="{{ url('admin/list/kosong') }}"> <button type="button" class="btn btn-primary">Tidak Bayar</button> </a>
				</div>

		    </h4> 
			<div class="col-md-12 table-responsive">
	            <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>NISN</th>
	                        <th>Nama</th>
	                        <th>Kelas</th>
	                        <th>tahun</th>
	                        <th>Tagihan</th>
	                        <th>Pembayaran</th>
	                        <th>Status</th>
	                        <th class="hide-print">Opsi</th>
	                    </tr>
	                </thead>
	            </table>
	        </div> 
	        <!-- /DATATABLES -->
		</div>
	</nav>



@push('jslib')

<script>
	// Datatable View
	var datatable =
	$('#datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{ url("admin/status/tidaklunas") }}',
		columns: [
			{ data: 'rownum', name: 'rownum', searchable: false },
			{ data: 'nis', name: 'nis' },
			{ data: 'nama', name: 'nama' },
			{ data: 'kelas', name: 'kelas' },	
			{ data: 'tahun', name: 'tahun' },	
			{ data: 'tagihan', name: 'tagihan' },
			{ data: 'total', name: 'total' },
			{ data: 'status', name: 'status' },
			{ data: 'opsi', name: 'opsi' },
		],
		order: [ [0, 'desc'] ]
	});
</script>
<script>
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();   
	});
</script>
@endpush

@endsection
