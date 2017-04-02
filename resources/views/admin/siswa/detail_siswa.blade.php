@extends('layouts.awal')
@section('title', 'Detail Siswa')


@section('content')
	<!-- ==BODY CONTENT== -->
	<nav class="container">
		<!-- ==ROW HEADER== -->
		<div class="row">
			<h3 class="text-center text-primary">Detail Data Siswa</h3>
			<hr>
		</div>
		<!-- //ROW HEADER -->

		<!-- ==TABLES== -->
		<div class="col-md-8 col-md-offset-2">
            <table id="datatable" class="table table-bordered table-responsive" cellspacing="0" width="100%">
                <tbody>
                    <tr>
                    	<th class="col-md-3">NIS</th>
                    	<td>{{ $siswa->NISN }}</td>
                    </tr>
                	<tr>
                		<th>Nama</th>
                		<td>{{ $siswa->nama }}</td>
                	</tr>
                	<tr>
                		<th>Jenis Kelamin</th>
                		<td>{{ $siswa->jk }}</td>
                	</tr>
                	<tr>
                		<th>Tempat,Tangggal Lahir</th>
                		<td>{{ $siswa->tempat_lahir }}, {{ date('d F Y', strtotime($siswa->tgl_lahir)) }}</td>
                	</tr>
                	<tr>
                		<th>Alamat</th>
                		<td>{{ $siswa->dusun }},Rt {{ $siswa->RT }}/{{ $siswa->RW }}, {{ $siswa->alamat }}</td>
                	</tr>
                    <tr>
                        <th>Nama Ayah</th>
                        <td>{{ $siswa->data_ayah }}</td>
                    </tr>
                    <tr>
                        <th>Nama Ibu</th>
                        <td>{{ $siswa->data_ibu}}</td>
                    </tr>
                	<tr>
                		<th>kelas</th>
                		<td>{{ $kelas->kelas}} - {{ $kelas->nama_kelas}} | {{ $siswa->angkatan}}</td>	
                	</tr>
                </tbody>
            </table>
	    </div> 
	    <!-- //TABLES -->
	</nav>
	<!-- //BODY CONTENT -->


@push('jslib')
@endpush
<!-- tanggal/datepicker -->
<script type="text/javascript">
     // Set Edited Value
     $('#kelas_id').val('{{ $siswa->kelas_id }}');
</script>
@endsection
