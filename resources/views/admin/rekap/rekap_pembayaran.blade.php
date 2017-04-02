@extends('layouts.awal')
@section('title', 'Rekap Data')


@section('content')

	<nav class="container">
		<!-- ROW HEADER -->
		<div class="row">
			<h4 class="text-primary">REKAP PEMBAYARAN SPP</h4>
			<hr>
		</div>
		<!-- //ROW HEADER -->

		<!-- ==ROW FORM== -->
		<div class="row">
			<form class="form-horizontal" role="form" method="post" action="{{ url('admin/rekap/cari') }}">
				{!! csrf_field() !!}
			    <div class="col-sm-4">
			    	<label class="control-label">Dari  :</label>
					<input id="datepicker1" name="tgl1" type="text" placeholder="1995-09-24 (Contoh 24 September 1995)" class="form-control input-md" required="" />
			    </div>
			    <div class="col-sm-4">
			    	<label class="control-label">Sampai sebelum  :</label>
			    	<input id="datepicker2" name="tgl2" type="text" placeholder="1995-09-24 (Contoh 24 September 1995)" class="form-control input-md" required="" />
			    </div>
			    <div class="col-sm-1">
			    	<label class="col-sm-2 control-label">&nbsp;</label>
			    	<input name="submit" class="form-control btn btn-primary" id="focusedInput" type="submit" value="cari">
			    </div>
		    </form>
		</div>
	</nav>


@push('jslib')
<script type="text/javascript">
	// Datepicker BS 3
      $('#datepicker1').datetimepicker({
        viewMode: 'days',
        format: 'YYYY-MM-DD'
      }); 

     // Datepicker BS 3
      $('#datepicker2').datetimepicker({
        viewMode: 'days',
        format: 'YYYY-MM-DD'
      }); 
</script>
@endpush

@endsection
