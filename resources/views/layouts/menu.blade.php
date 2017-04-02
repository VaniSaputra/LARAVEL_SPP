@extends('layouts.awal')
@section('title', 'Menu')

@section('content')

	<body style="background-color: #f1f1f1">
		<nav class="container" style="padding: 20px;">
			<div class="col-sm-4">
		        <div class="panel panel-primary">
			      	<a href="{{ url('admin/filter/all') }}">
				        <div class="panel-body" align="center">
				        	<img src="{!! URL::asset('bootstrap/images/list.png') !!}" class="img-responsive" style="width:50%" alt="Image">
				        </div>
			        </a>
			        <div class="panel-heading" align="center">Daftar Pembayaran</div>
		        </div>

	    	</div>
		    <div class="col-sm-4"> 
		      <div class="panel panel-primary">
		      		<a href="{{ url('admin/bayar/all') }}">
				        <div class="panel-body" align="center">
				        	<img src="{!! URL::asset('bootstrap/images/bayar.png') !!}"  class="img-responsive" style="width:50%" alt="Image">
				        </div>
			        </a>
			        <div class="panel-heading" align="center">Pembayaran</div>
		      </div>
		    </div>
	    	<div class="col-sm-4">
		        <div class="panel panel-primary">
			      	<a href="{{ url('admin/rekap') }}">
				        <div class="panel-body" align="center">
				        	<img src="{!! URL::asset('bootstrap/images/rekap.png') !!}" class="img-responsive" style="width:50%" alt="Image">
				        </div>
			        </a>
			        <div class="panel-heading" align="center">Rekap Daftar Pembayaran</div>
		        </div>
	    	</div>
		</nav>

		<nav class="container" style="padding: 20px;">
			<div class="col-sm-4">
		        <div class="panel panel-primary">
			      	<a href="{{ url('admin/siswa/all')  }}">
				        <div class="panel-body" align="center">
				        	<img src="{!! URL::asset('bootstrap/images/siswa.png') !!}" class="img-responsive" style="width:50%" alt="Image">
				        </div>
			        </a>
			        <div class="panel-heading" align="center">Daftar Siswa</div>
		        </div>
	    	</div>
		    <div class="col-sm-4"> 
		      <div class="panel panel-primary">
		      		<a href="{{ url('admin/kelas') }}">
				        <div class="panel-body" align="center">
				        	<img src="{!! URL::asset('bootstrap/images/setting.png') !!}"  class="img-responsive" style="width:50%" alt="Image">
				        </div>
			        </a>
			        <div class="panel-heading" align="center">Daftar Kelas</div>
		      </div>
		    </div>
	    	<div class="col-sm-4">
		        <div class="panel panel-primary">
			      	<a href="{{ url('admin/paket') }}">
				        <div class="panel-body" align="center">
				        	<img src="{!! URL::asset('bootstrap/images/petunjuk.png') !!}" class="img-responsive" style="width:50%" alt="Image">
				        </div>
			        </a>
			        <div class="panel-heading" align="center">Petunjuk</div>
		        </div>
	    	</div>
		</nav>

	</body>

@push('jslib')
@endpush

@endsection
