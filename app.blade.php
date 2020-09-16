<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>@yield('pageheader')</title>
    <link rel="shortcut icon" type="image/png" href="{{ url('/surveys/public/img/favicon.png') }}">
    <!-- stili -->
    <link href="{{ url('/') }}/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
    @yield('htmlheadassets')
	<style>
		.offcanvas-header { display:none; }
		@media (max-width: 992px) {
			.offcanvas-header{ display: block; }
			.navbar-collapse {
				position: fixed;
				top:0;
				bottom: 0;
				left: 100%;
				width: 100%;
				padding-right: 1rem;
				padding-left: 1rem;
				overflow-y: auto;
				visibility: hidden;
				background-color: black;
				transition: visibility .2s ease-in-out, -webkit-transform .2s ease-in-out;
				z-index: 10;
			}
			.navbar-collapse.show {
				visibility: visible;
				transform: translateX(-100%);
			}
		}
		.menu-size {
			min-width: 35px;
		}
		.bg-lightblue {
			background-color: #9DF9EF;
		}
		.bg-menu {
			background-color: #4ABDAC;
		}
		.menu {
			background-color: #f1f1f1;
			border: none;
			outline: none;
			cursor: pointer;
			font-size: 14px;
		}
		.active, .menu:hover {
			background-color: #666;
			color: white;
			display: inline-block;
			box-shadow: 0 6px 6px rgba(0,0,0,0.25), 0 8px 8px rgba(0,0,0,0.22);
		}
		.shade {
			box-shadow: 0 3px 3px rgba(0,0,0,0.25), 0 4px 4px rgba(0,0,0,0.22);
		}
	</style>
</head>
<body class="bg-light">
	@include('layouts/menu')
	<div class="container-fluid pb-3">
		<div class="row">
			<div class="col pb-3 pt-3" id="pageContent">
				@include('layouts/alerts')
				<!-- content -->
				<main class="py-2">
					@yield('content')
				</main>
				<!-- end content -->
			</div>
		</div>

		<hr>

		<div class="container-fluid">
		    <div class="row">
		        <small class="text-muted">
		            <div class="col-lg-12">
	                    <p class="muted pull-right">© 2020. All rights reserved.</p>
		            </div>
		        </small>
		    </div>
		</div>
	</div>
    <!-- ekmaskripti -->
    <script src="{{ url('/') }}/assets/jquery/jquery.js"></script>
	<script src="{{ url('/') }}/assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- skriptiem kurus vajag laded pec vajadzibas -->
	<script>
		$("[data-trigger]").on("click", function() {
			var trigger_id =  $(this).attr('data-trigger');
			$(trigger_id).toggleClass("show");
			$('body').toggleClass("offcanvas-active");
		});

		// close button 
		$(".btn-close").click(function(e) {
			$(".navbar-collapse").removeClass("show");
			$("body").removeClass("offcanvas-active");
		});
	</script>
    @yield('htmlbodyassets')
</body>
</html>
