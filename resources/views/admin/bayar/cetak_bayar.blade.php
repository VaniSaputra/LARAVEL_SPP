<?php 
	function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {
        if (trim ($timestamp) == '')
        {
                $timestamp = time ();
        }
        elseif (!ctype_digit ($timestamp))
        {
            $timestamp = strtotime ($timestamp);
        }
        # remove S (st,nd,rd,th) there are no such things in indonesia :p
        $date_format = preg_replace ("/S/", "", $date_format);
        $pattern = array (
            '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
            '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
            '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
            '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
            '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
            '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
            '/April/','/June/','/July/','/August/','/September/','/October/',
            '/November/','/December/',
        );
        $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
            'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
            'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
            'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
            'Oktober','November','Desember',
        );
        $date = date ($date_format, $timestamp);
        $date = preg_replace ($pattern, $replace, $date);
        $date = "{$date} {$suffix}";
        return $date;
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>cetak Data</title>

  <style tyle="text/css">

	   @media screen
	   {
	       div {
				padding: 10px 30px 20px 30px;
	       }

	   @media screen, print
	   {
	      p {font-size:10pt}
	   }

		table.css, td.css, th {    
		    border: 1px solid #ddd;
		    text-align: left;
		}

	  table.css {
		    border-collapse: collapse;
		    width: 100%;
		    padding: 0px 5px 0px 20px;
		}

		th.css, td.css {
		    padding: 8px;
		}
		p{
			font-family:verdana;
			font-size: 50%;
		}
  </style>

</head>
<body>

<div class="container">
	<table border="0">
	   <tr>
	    <td><img src="{!! URL::asset('bootstrap/images/kop.jpg') !!}" class="img-responsive" style="width:100%" alt="Image"></td>
	  </tr>
	</table>
	<center><b> BUKTI PEMBAYARAN TRANSAKSI </b></center>
	<small>&nbsp;</small>
  	<table border="0">
		   <tr>
			    <td style="padding: 4px 25px;">NISN</td>
			    <td>:</td>
			    <td style="padding: 5px 10px;">{{ $siswa->NISN }}</td>
			    <td style="padding: 5px 60px;">&nbsp;</td>
			    <td style="padding: 5px 10px;">Kelas</td>
			    <td>:</td>
			    <td style="padding: 5px 10px;">{{ $kelas->kelas }} - {{ $kelas->nama_kelas }}</td>
		  </tr>
		  <tr>
			    <td style="padding: 5px 25px;">Nama</td>
			    <td>:</td>
			    <td style="padding: 5px 10px;">{{ $siswa->nama }}</td>
			    <td style="padding: 5px 60px;">&nbsp;</td>
			    <td style="padding: 5px 10px;">Tahun Angkatan</td>
			    <td>:</td>
			    <td style="padding: 5px 10px;">{{ $siswa->angkatan }}</td>
		  </tr>
	</table>
	<small>&nbsp;</small>
	<table class="css">
		  <tr>
		    <th class="css">ID</th>
		    <th class="css">Jenis Pembayaran</th>
		    <th class="css">Jumlah Pembayaran</th>
		    <th class="css">Tanggal Pembayaran</th>
		    <th class="css">Petugas</th>
		  </tr>
		@foreach($pembayaran as $bayar)
		  <tr>
		    <td class="css">{{ $bayar->id }}</td>
		    <td class="css">{{ $bayar->nama }}</td>
    		<td class="css">Rp {{ number_format($bayar->nominal, 0,',','.') }},00</td>
    		<td class="css">{{ indonesian_date($bayar->created_at, 'l, j F Y', '') }}</td>
    		<td class="css">{{ $bayar->name }}</td>
		  </tr>
		 @endforeach

	</table>
	<br>
	<table border="0">
		   <tr>
		    <td style="padding: 0px 220px 0px 0px;"></td>
		    <td style="padding: 0px 220px 0px 0px;"></td>
		    <td align="center">{{ indonesian_date($dt, 'l, j F Y', '') }} <br> Petugas,</td>
		  </tr>
		  <tr>
		    <td  style="padding: 25px;"></td>
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

</body>
</html>





