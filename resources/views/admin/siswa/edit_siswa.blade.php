@extends('layouts.awal')
@section('title', 'Edit Siswa')


@section('content')

	<!-- ==BODY CONTENT== -->
	<nav class="container">
		<!-- ==ROW HEADER== -->
		<div class="row">
			<h3 class="text-center text-primary">Edit Data Siswa</h3>
			<hr>
		</div>
		<!-- //ROW HEADER -->

		<!-- ==BODY HEADER== -->
		<div class="modal-body">
			<!-- FORM TAMBAH DATA SISWA -->
			<form class="form-horizontal" role="form" method="post" action="{{ url('admin/siswa/edit') }}">
			    {!! csrf_field() !!}
			    <!-- Text input-->
			    <input type="hidden" name="id" value="{{ $siswa->id }}">

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="kontingen_pilih">NIS</label>  
					<div class="col-md-6">
						<input  name="NISN" type="text" placeholder="nomor induk siswa" class="form-control input-md" required="" value="{{ $siswa->NISN }}"> 
					</div>
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Nama Siswa</label>  
					<div class="col-md-6">
						<input name="nama" type="text" placeholder="Nama Lengkap Siswa" class="form-control input-md" required="" value="{{ $siswa->nama }}">
					</div>            
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Jenis Kelamin</label>
					<div class="col-md-6">
						<select name="jk" class="form-control" id="jk">
							<option>Jenis kelamin</option>
							<option value="L">L</option>
							<option value="P">P</option>
						</select>
					</div>
			    </div>

			    <!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Tempat, Tanggal Lahir</label>  
					<div class="col-md-3">
						<input name="tempat_lahir" type="text" placeholder="tempat lahir Siswa" class="form-control input-md" required="" value="{{ $siswa->tempat_lahir }}">
					</div> 
					<div class="col-sm-3">
				        <input id="datepicker" name="tgl_lahir" type="text" placeholder="1995-07-28 (Contoh 28 Juli 1995)" class="form-control input-md" required="" value="{{ $siswa->tgl_lahir }}" />
				     </div>       
				</div>

				 <!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Alamat Rumah</label> 
					<div class="col-md-2">
						<input name="dusun" type="text" placeholder="dusun" class="form-control input-md" required="" value="{{ $siswa->dusun }}">
					</div> 
					<div class="col-md-2">
						<input name="RT" type="number" placeholder="RT 1" class="form-control input-md" required="" value="{{ $siswa->RT }}">
					</div>  
					<div class="col-md-2">
						<input name="RW" type="number" placeholder="RW 1" class="form-control input-md" required="" value="{{ $siswa->RW }}">
					</div>           
				</div>

				 <!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">&nbsp;</label>  
					<div class="col-md-6">
						<input name="alamat" type="text" placeholder="alamat" class="form-control input-md" required="" value="{{ $siswa->alamat }}">
						 <span class="help-block">* (dusun,Rt/Rw,kecamatan)</span>
					</div>         
				</div>

				 <!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">No. KPS</label>  
					<div class="col-md-6">
						<input name="KPS" type="number" placeholder="Nomer KPS" class="form-control input-md" value="{{ $siswa->KPS }}">
					</div>            
				</div>

				 <!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Nama Ayah & Ibu</label>  
					<div class="col-md-3">
						<input name="data_ayah" type="text" placeholder="nama ayah" class="form-control input-md" required="" value="{{ $siswa->data_ayah }}">
					</div>
					<div class="col-md-3">
						<input name="data_ibu" type="text" placeholder="nama ibu" class="form-control input-md" required="" value="{{ $siswa->data_ibu }}">
					</div>               
				</div>

				<!-- Text input-->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">Kelas, angkatan</label>
					<div class="col-md-3">
						<select name="kelas_id" class="form-control" id="kelas_id">
						<option >kelas</option>
						@foreach($kelas as $dkelas)
							<option value="{{ $dkelas['id'] }}">{{ $dkelas['kelas'] }} - {{ $dkelas['nama_kelas'] }} </option>
						@endforeach
						</select>
					</div>
					<div class="col-md-3">
						<input name="angkatan" type="text" placeholder="*contoh(2017-2018)" class="form-control input-md" required="" value="{{ $siswa->angkatan }}">
					</div> 
			    </div>
			    
				<!-- Text submit -->
				<div class="form-group">
					<label class="col-md-4 control-label" for="nama">&nbsp;</label> 
					<div class="col-sm-6 btn-group">
						<input name="submit" class="col-sm-6 btn btn-primary" id="focusedInput" type="submit" value="simpan">
						<input class="col-sm-6 btn btn-default" id="focusedInput" type="reset" value="reset">
					</div>
				</div>
			</form>
			<!--/ FORM TAMBAH DATA SISWA -->
		</div>
		<!-- //BODY HEADER//-->	
	</nav>
	<!-- ==BODY CONTENT== -->


@push('jslib')
<!-- tanggal/datepicker -->
<script type="text/javascript">
	// Datepicker BS 3
      $('#datepicker').datetimepicker({
        viewMode: 'days',
        format: 'YYYY-MM-DD'
      }); 

     // Set Edited Value
     $('#jk').val('{{ $siswa->jk }}');
     $('#kelas_id').val('{{ $siswa->kelas_id }}');
</script>
@endpush

@endsection
