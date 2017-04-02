@extends('layouts.awal')
@section('title', 'Export Data')


@section('content')

	

		<nav class="container">
			<div class="row">
				<h2 class="text-center text-primary">EXPORT DATA SISWA</h2>
				<hr>
			</div>

			<!-- ==ROW FORM== -->
			<div class="row">
				<!-- FORM TAMBAH DATA SISWA -->
				<form class="form-horizontal" role="form"  method="post" action="{{ URL::to('admin/excel/export2') }}" enctype="multipart/form-data">
				    {!! csrf_field() !!}
				    <!-- Text input-->
				    <input type="hidden" name="id" value="">

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="nama">Kelas</label>
						<div class="col-md-6">
							<select name="kelas" class="form-control" id="kelas">
								<option >kelas</option>
								@foreach ($kelas as $kelas)
								<option value="{{ $kelas['id'] }}"> {{ $kelas['kelas'] }} / {{ $kelas['tahun'] }}</option>
								@endforeach
							</select>
						</div>
				    </div>

					<!-- Text submit -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="nama">&nbsp;</label> 
						<div class="col-sm-6 btn-group">
							<input name="submit" class="col-sm-6 btn btn-primary" id="focusedInput" type="submit" value="Export">
							<input class="col-sm-6 btn btn-default" id="focusedInput" type="reset" value="reset">
						</div>
					</div>

				</form>
				<!-- //FORM TAMBAH DATA SISWA -->
			</div>
			<!-- //ROW FORM -->

@push('jslib')
@endpush

@endsection
