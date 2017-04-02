@extends('layouts.awal')
@section('title', 'Input Pembayaran')


@section('content')

	<!--==BODY CONTENT==-->
	<nav class="container">
		<!-- ==ROW HEADER== -->
		<div class="row">
			<h4 class="text-center text-primary">INPUT PEMBAYARAN SPP</h4>
			<hr>
		</div>
		<!-- //ROW HEADER -->

		<!-- ==ROW BODY== -->
		<div class="row text-center ">
			<!-- ==FORM PEMBAYARAN== -->
			<form class="form-horizontal" role="form" method="post" action="{{ url('admin/bayar/input') }}">
			{!! csrf_field() !!}
					<!-- text input -->
	            	<input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="nama">NISN Siswa</label>  
						<div class="col-md-6">
							<input  name="NISN" type="text" class="form-control input-md" value="{{ $siswa->NISN }}" disabled=""> 
						</div>            
					</div>
					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="nama">Nama Siswa</label>  
						<div class="col-md-6">
							<input name="" type="text" class="form-control input-md" value="{{ $siswa->nama }}" disabled=""> 
						</div>            
					</div>

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="nama">Kelas Siswa</label>  
						<div class="col-md-6">
							<input name="" type="text" class="form-control input-md" value="{{ $kelas->kelas }} - {{ $kelas->nama_kelas }} / {{ $siswa->angkatan }}" disabled=""> 
						</div>            
					</div>

					<!-- Input siswa_id pada pembayaran -->
					<input type="hidden" name="kelas_id" value="{{ $siswa->kelas_id }}">

					<!-- Text input-->
					<div class="form-group">
						<label class="col-md-4 control-label" for="nama">Jenis Pembayaran</label>
						<div class="col-md-6">
							<select name="paket_id" class="form-control" id="sel1">
							<option >Paket siswa</option>
								@foreach($paket as $pakets)
								<option value="{{ $pakets->id }}">{{ $pakets->nama }} - Rp {{ number_format($pakets->nominal, 0,',','.') }} ( <span>{{ $pakets->keterangan }}</span> )</option>
							@endforeach
							</select>
						</div>
				    </div>

					<!-- Text submit -->
					<div class="form-group">
						<label class="col-md-4 control-label" for="nama">&nbsp;</label> 
						<div class="col-sm-6 btn-group">
							<input name="submit" class="col-sm-6 btn btn-primary" id="focusedInput" type="submit" value="bayar">
							<input class="col-sm-6 btn btn-default" id="focusedInput" type="reset" value="reset">
						</div>
					</div>
			 </form>
			 <!-- //FORM PEMBAYARAN -->
			 <hr>
		</div>
		<!-- //ROW BODY-->

		<!-- ROW CETAK -->
		<div class="row">
			<div class="col-md-9"></div>
			<a href="{{ url('admin/bayar/cetakAll/'.$siswa->id) }}" data-toggle="tooltip" title="Cetak All">
				<button type="button" class="btn btn-info btn-sm">
					<span class="glyphicon glyphicon-print"></span> Cetak Semua
				</button>
			</a>
		</div>
		<div class="row">
		<br>
		</div>
		<!-- //ROW CETAK -->

		<!-- ==DATATABLES== -->
		<div class="col-md-10 col-md-offset-1">
            <table id="datatable" class="table table-bordered table-responsive" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    	<th>#idBayar</th>
                    	<th>Tgl Bayar</th>
                        <th>Jenis Pembayaran</th>
                        <th>Nominal</th>
                        <th>Petugas</th>
                        <th>Opsi</th>
                        <!-- <th class="hide-print">Opsi</th> -->
                    </tr>
                </thead>
                <tbody>
                	@foreach($pembayaran as $bayar)
                	<?php                 		
                		$bayar_nama 	=  $bayar->nama;
                		if($bayar->idpaket == 10) {
                			$bayar_nama = $bayar->nama . ' (Bulan ke-'.$spp7.')';
                			$spp7--;
                		}
                		else if($bayar->idpaket == 11) {
                			$bayar_nama = $bayar->nama . ' (Bulan ke-'.$spp8.')';
                			$spp8--;
                		}
                		else if($bayar->idpaket == 12) {
                			$bayar_nama = $bayar->nama . ' (Bulan ke-'.$spp9.')';
                			$spp9--;
                		}
                		else if($bayar->idpaket == 8) {
                			$bayar_nama = $bayar->nama . ' (Bulan ke-'.$ekskul.')';
                			$ekskul--;
                		}
                		else if($bayar->idpaket == 9) {
                			$bayar_nama = $bayar->nama . ' (Bulan ke-'.$les.')';
                			$les--;
                		}
                		 
                	?>
                	<tr>
                		<td>{{ $bayar->id }}</td>
                		<td>{{ $bayar_nama }}</td>
                		<td>Rp {{ number_format($bayar->nominal, 0,',','.')  }}</td>
                		<td>{{ date('l, d F Y', strtotime($bayar->created_at )) }}</td>
                		<td>{{ $bayar->name }} </td>
                		<td>
                			<a href="{{ url('admin/bayar/cetakId/'.$siswa->id.'/'.$bayar->id) }}">
		                		<button type="button" class="btn btn-info" data-toggle="tooltip" title="Delete">
						          <span class="glyphicon glyphicon-print"></span> Cetak
						        </button>
					        </a>
					        &nbsp;
                			<a href="{{ url('admin/bayar/delete/'.$bayar->id) }}" onclick="return confirm('Hapus Pembyaran: {{$bayar->nama}}')" data-toggle="tooltip" title="Hapus">
		                		<button type="button" class="btn btn-default btn-sm btn-danger">
						          <span class="glyphicon glyphicon-trash"></span> Hapus
						        </button>
					        </a>
                		</td>
                	</tr>
                	@endforeach
                </tbody>
            </table>
	    </div> 
	    <!-- //DATATABLES -->
	</nav>
	<!-- //BODY CONTENT -->


@push('jslib')
<script type="text/javascript">	

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
<script type="text/javascript">
    $('#jenis').autocomplete({
        source: '{!! url("autocomplete") !!}',
        minlenght:1,
        autoFocus:true,
        select:function(e,ui){
        	alert(ui);
       }
    });
</script>
@endpush

@endsection
