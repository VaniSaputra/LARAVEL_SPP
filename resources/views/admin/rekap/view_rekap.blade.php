@extends('layouts.awal')
@section('title', 'rekap data')

@section('content')
	
	<!-- ==BODY CONTENT== -->
	<nav class="container">
		<div class="row">
			<h4 class="text-primary">REKAP PEMBAYARAN SPP</h4>
			<h5><b>{{ $tgl1 }}</b> sampai sebelum <b>{{ $tgl2 }}</b> </h5>
			<a href="{{ url('admin/rekap/cetak/'.$tgl1.'/'.$tgl2) }}">
				<button type="button" class="btn btn-primary btn-sm full">
					<span class="glyphicon glyphicon-print"></span> Cetak Semua
				</button>
			</a>
			<hr>
		</div>
		<!-- //ROW HEADER -->

		<!-- ==DATATABLES== -->
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
	            <table id="datatable" class="table table-bordered table-responsive" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                    	<th>Kelas</th>
	                    	<th>Tahun</th>
	                        <th>Nominal Pembayar</th>
	                        <th class="hide-print">Opsi</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	@foreach ($data as $data)
	                	<tr>							
	                		<td>{{ $data->kelas }}</td>
	                		<td>{{ $data->tahun }}</td>
	                		<td> Rp {{ number_format($data->nominal, 0,',','.') }}</td>
	                		<td>
	                			<a href="{{ url('admin/rekap/cetak/'.$data->kelas.'/'.$data->tahun.'/'.$tgl1.'/'.$tgl2) }}">
		                			<button type="button" class="btn btn-default btn-sm">
							          <span class="glyphicon glyphicon-print"></span> Cetak
							        </button>
						        </a>
	                		</td>
	                	</tr>
	                	@endforeach
	                	
	                </tbody>
	            </table>
		    </div>  <!-- //DATATABLES -->

	    </div>
	</nav>


@push('jslib')
@endpush

@endsection
