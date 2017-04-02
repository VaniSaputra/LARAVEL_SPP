@extends('layouts.awal')
@section('title', 'Edit Kelas')


@section('content')
	<!-- ==BODY CONTENT== -->
	<nav class="container">
		<!-- ==ROW HEADER== -->
		<div class="row">
			<h3 class="text-center text-primary">Edit Data Kelas</h3>
			<hr>
		</div>
		<!-- ///ROW HEADER -->
		<!-- ==ROW FORM== -->
		<div class="row">
			<!-- FORM TAMBAH DATA SISWA -->
			<!-- FORM TAMBAH DATA SISWA -->
			<form class="form-horizontal" role="form" method="post" action="{{ url('admin/paket/edit') }}">
			    {!! csrf_field() !!}
			    <!-- Text input-->
			    <input type="hidden" name="id" value="{{ $paket->id }}">

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Nama Pembayaran</label>
					<div class="col-md-6">
						<input name="nama" type="text" placeholder="jenis Pembayaran" class="form-control input-md" required="" value="{{ $paket->nama }}">
					</div>  
			    </div>

			    <!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Nominal</label>
					<div class="col-md-6">
						<input id="nominal" name="nominal" type="text" placeholder="nominal pembayaran(Rp)" class="form-control input-md" required="" value="{{ $paket->nominal }}">
					</div>  
			    </div>

			    <!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Tipe pembayaran</label>
					<div class="col-md-6">
						<select id="tipe" name="tipe" class="form-control">
								<option >pilih tipe keterangan</option>
								<option value="sekali">sekali</option>
								<option value="perbulan">perbulan</option>
						</select>
					</div>
			    </div>

			   <!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Keterangan</label>
					<div class="col-md-6">
						<select id="keterangan" name="keterangan" class="form-control">
								<option >pilih keterangan</option>
								<option value="semua">semua</option>
								<option value="khusus kelas 7">khusus kelas 7</option>
								<option value="khusus kelas 8">khusus kelas 8</option>
								<option value="khusus kelas 9">khusus kelas 9</option>
						</select>
					</div>
			    </div>

				<!-- Text submit -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">&nbsp;</label> 
					<div class="col-sm-6 btn-group">
						<input name="submit" class="col-sm-6 btn btn-primary" id="focusedInput" type="submit" value="update">
						<input class="col-sm-6 btn btn-default" id="focusedInput" type="reset" value="reset">
					</div>
				</div>

			</form>
		</div>
		<!-- //ROW FORM -->
	</nav>
	<!-- //BODY CONTENT -->





@push('jslib')
<script type="text/javascript">
 	//value tipe pembayaran
 	 $('#tipe').val('{{ $paket->tipe }}');
 	 // value keterangan
 	 $('#keterangan').val('{{ $paket->keterangan }}');
     // Auto Ubah Number ke Currency Format saat diketik, dengan numeralJS
	$('#nominal').keyup(function() {
		var nomi 			= $('#nominal').val();
		var nominumeral 	= numeral(nomi).format('0,0');
		// 1000
		$('#nominal').val(nominumeral);
		// var myNumeral2 = numeral('1,000');
		// var value2 = myNumeral2.value();
	})	
</script>
@endpush

@endsection
