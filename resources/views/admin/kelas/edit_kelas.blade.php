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
			<!-- //FORM TAMBAH DATA SISWA -->
			<form class="form-horizontal" role="form" method="post" action="{{ url('admin/kelas/edit') }}">
			    {!! csrf_field() !!}
			    <!-- Text input-->
			    <input type="hidden" name="id" value="{{ $kelas->id }}">

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Kelas</label>
					<div class="col-md-6">
						<select name="kelas" class="form-control" id="kelas">
							<option >kelas</option>
							<option value="VII">VII</option>
							<option value="VIII">VIII</option>
							<option value="IX">IX</option>
						</select>
					</div>
			    </div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Nama Kelas</label>
					<div class="col-md-6">
						<select name="nama_kelas" class="form-control" id="nama_kelas">
							<option >Nama kelas</option>
							<option value="A">A</option>
							<option value="B">B</option>
							<option value="C">C</option>
							<option value="D">D</option>
							<option value="E">E</option>
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
			<!-- //FORM TAMBAH DATA SISWA -->
		</div>
		<!-- //ROW FORM -->
	</nav>
	<!-- //BODY CONTENT -->





@push('jslib')
<script type="text/javascript">
	// autokomplete
     $('#kelas').val('{{ $kelas->kelas }}');

     $('#nama_kelas').val('{{ $kelas->nama_kelas }}');
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
