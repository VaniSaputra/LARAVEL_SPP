
@extends('layouts.awal')
@section('title', 'Kelas')


@section('content')

	<!-- ==BODY CONTENT== -->
	<nav class="container">
		<!-- ==ROW HEADER== -->
		<div class="row">
			<h2 class="text-center text-primary">
				Manage Kelas Siswa 
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
							<form class="form-horizontal" role="form" method="post" action="{{ url('admin/kelas/addData') }}">
							   {!! csrf_field() !!}

								<!-- Text input-->
								<div class="form-group">
									<label class="col-md-4 control-label" for="nama">Kelas</label>
									<div class="col-md-6">
										<select name="kelas" class="form-control" id="sel1">
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
										<select name="nama_kelas" class="form-control" id="kelas" required>
											<option >Nama kelas</option>
											@foreach($kelas_siswas as $kelas)
												<option value="{{ $kelas }}">{{ $kelas }}</option>
											@endforeach
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
	                        <th>Kelas</th>
	                        <th>Nama Kelas</th>	                                     
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
		ajax: '{{ url("admin/kelas/getdata") }}',
		columns: [
			{ data: 'rownum', name: 'rownum', searchable: false },
			{ data: 'kelas', name: 'kelas' },
			{ data: 'nama_kelas', name: 'nama_kelas' },
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
