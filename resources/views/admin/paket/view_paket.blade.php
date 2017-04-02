
@extends('layouts.awal')
@section('title', 'Kelas')


@section('content')

	<!-- ==BODY CONTENT== -->
	<nav class="container">
		<!-- ==ROW HEADER== -->
		<div class="row">
			<h2 class="text-center text-primary">
				Manage Paket
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
					<span class="glyphicon glyphicon-plus"></span>
				</button>
			</h2>

			<!-- ==MODAL ADD SISWA== -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<!-- ==MODAL HEADER== -->
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Masukan kelas</h4>
						</div> <!-- //MODAL HEADER -->

						<!-- ==MODAL BODY== -->
						<div class="modal-body">
							<!-- FORM TAMBAH DATA SISWA -->
							<form class="form-horizontal" role="form" method="post" action="{{ url('admin/paket/addData') }}">
							   {!! csrf_field() !!}

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Nama Pembayaran</label>
									<div class="col-md-6">
										<input name="nama" type="text" placeholder="jenis Pembayaran" class="form-control input-md" required="">
									</div>  
							    </div>

							    <!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Nominal</label>
									<div class="col-md-6">
										<input id="nominal" name="nominal" type="text" placeholder="nominal pembayaran(Rp)" class="form-control input-md" required="">
									</div>  
							    </div>

							    <!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Tipe pembayaran</label>
									<div class="col-md-6">
										<select name="tipe" class="form-control">
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
										<select name="keterangan" class="form-control">
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
										<input name="submit" class="col-sm-6 btn btn-primary" id="focusedInput" type="submit" value="kirim">
										<input class="col-sm-6 btn btn-default" id="focusedInput" type="reset" value="reset">
									</div>
								</div>
							</form> <!--/ FORM TAMBAH DATA SISWA -->
						</div> <!-- //MODAL BODY -->

						<!-- ==MODAL FOOTER== -->
						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div><!-- //MODAL FOOTER -->
					</div>
				</div>
			</div> <!-- //MODAL BODY-->	
			<hr>
		</div>
		<!-- //ROW -->

		<!-- ==DATATABLES== -->
		<div class="row">
			<div class="col-md-12 table-responsive">
	            <table id="datatable" class="table table-bordered" cellspacing="0" width="100%">
	                <thead>
	                    <tr>
	                        <th>No</th>
	                        <th>Nama Pembayaran</th>
	                        <th>Nominal</th>	
	                        <th>Tipe pembayaran</th>
	                        <th>keterangan</th>                                     
	                        <th class="hide-print">Opsi</th>
	                    </tr>
	                </thead>
	            </table>
	        </div> 
		</div>
		<!-- //DATATABLES -->
	</nav>
	<!-- //BODY CONTENT -->


@push('jslib')
<script>
	// Datatable View
	var datatable =
	$('#datatable').DataTable({
		processing: true,
		serverSide: true,
		ajax: '{{ url("admin/paket/getdata") }}',
		columns: [
			{ data: 'rownum', name: 'rownum', searchable: false },
			{ data: 'nama', name: 'nama' },
			{ data: 'nominal', name: 'nominal' },
			{ data: 'tipe', name: 'tipe' },
			{ data: 'keterangan', name: 'keterangan' },
			{ data: 'opsi', name: 'opsi' },
		],
		order: [ [0, 'desc'] ]
	});

	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();   
	});

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
