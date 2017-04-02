<!DOCTYPE html>
<html lang="en">
<head>
  <title>@yield('title') - SMP MUHAMMADYAH 1 SURAKARTA</title>
  @include('includes.css')
  <style>
  	#isikonten {
  		min-height: 500px;
  	}
  </style>
  @stack('csslib')  
</head>
  <body data-spy="scroll" data-offset="0" data-target="#theMenu">
  		<!-- NAVBAR -->
		<nav class="navbar navbar-default" >
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <a class="navbar-brand" href="{{ url('menu') }}">SMP 1 MUHAMMADYAH</a>
		    </div>
		    <ul class="nav navbar-nav">
		        
				@if (!empty($halaman) && $halaman == 'awal')
	            	<li class="active"><a href="{{ url('menu') }}">Home</a></li>
	            @else
	            	<li><a href="{{ url('menu') }}">Home</a></li>
	            @endif

		    </ul>
		    <ul class="nav navbar-nav navbar-right">
		       <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="glyphicon glyphicon-log-in"></span> {{ Auth::user()->name }}<b class="caret"></b>
					</a>
					<ul class="dropdown-menu">
					    <li><a href="#"><span class="glyphicon glyphicon-user"> </span> {{ Auth::user()->name }}</a></li>
					    <li class="divider"></li>
					    <li><a href="#"><span class="glyphicon glyphicon-question-sign"> </span> Petunjuk / Bantuan Sistem</a></li>
					    <li class="divider"></li>            
					    <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-out"> </span> Logout</a></li>
					    <!-- <li class="divider"></li> -->
					    <!-- <li><a href="#">Petunjuk</a></li> -->
					</ul>
        		</li>
		    </ul>
		  </div>
		</nav>
		<!-- /NAVBAR -->

	 <div id="isikonten">
		@if (session('pesanwarning'))
			<div class="container">
				<div class="row">
					<div class="alert alert-success">
					    {{ session('pesanwarning') }}
					</div>
				</div>
			</div>
		@endif

			@yield('content')
	</div>
	<!-- FOOTER -->
	<br>
    <div id="footer" style="background-color: #F5F6F6;">
      <div class="container">
        <br>
        <p class="text-muted">&copy; 2016 Sistem Informasi Pembayaran SPP. 
        <span class="pull-right">Navigasi Sistem : 
          <a href="#">Pusat Informasi</a> -
          <a href="#>">Bantuan</a>
        </span>
        <br>
          <small>Create By : 
                  <a href="https://github.com/vanisaputra">Vani A.D.S</a>
          </small>
        </p>        
      </div>
    </div>
    <!-- /FOOTER -->
   @include('includes.js')
   @stack('jslib')
</body>
</html>
