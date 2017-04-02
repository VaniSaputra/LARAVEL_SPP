<!DOCTYPE html>
<html>
<head>
	<title></title>

  <style tyle="text/css">

	   @media screen
	   {
	       div {
				padding: 20px 40px 20px 40px;
	       }
	   }

	   @media print
	   {

	   }
	   @media screen, print
	   {
	      p {font-size:10pt}
	   }

		table.border, td.border, th {    
		    border: 1px solid #ddd;
		    text-align: left;
		}

	  table.border {
		    border-collapse: collapse;
		    width: 100%;
		}

		th, td {
		    padding: 15px;
		}
		th {
			background-color: #3EBAC0;
		}

		p{
			font-family:verdana;
			font-size: 80%;
		}
  </style>

</head>
<body>

<div class="container">
  <h3>Transkip Pembayaran SPP</h3>   
  	<p>Tanggal Rekap : {{ $tgl1 }} sampai {{ $tgl2 }}  </p>
	<table class="border">
		  <tr>
		    <th>Kelas</th>
		    <th>Tahun Ajaran</th>
		     <th>Total Pembayaran</th>
		  </tr>
		  @foreach ($data as $data)
		  <tr>
		    <td class="border">{{ $data->kelas }}</td>
		    <td class="border">{{ $data->tahun }}</td>
		    <td class="border">Rp {{ number_format($data->nominal, 0,',','.') }},00</td>
		  </tr>
		  @endforeach
	</table>
	<table border="0">
		   <tr>
		    <td style="padding: 0px 170px 0px 0px;"></td>
		    <td style="padding: 0px 200px 0px 0px;"></td>
		    <td style="text-align: center;"> {{ $dt }} <br> Petugas,</td>
		  </tr>
		  <tr>
		    <td></td>
		    <td></td>
		    <td></td>
		  </tr>
		  <tr>
		    <td></td>
		    <td></td>
		    <td align="center">( {{ Auth::user()->name }} ) </td>
		  </tr>
	</table>
</div>

   @include('includes.js')
   @stack('jslib')
</body>
</html>





