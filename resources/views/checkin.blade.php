<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v4.2.1
* @link https://coreui.io
* Copyright (c) 2022 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->
<html lang="en">

<head>
	<base href="./">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
	<meta name="author" content="Łukasz Holeczek">
	<meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
	<title>Redeem Ticket</title>
	<link rel="apple-touch-icon" sizes="57x57" href="assets/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="assets/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="assets/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="assets/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="assets/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="assets/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="assets/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="assets/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="assets/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
	<link rel="manifest" href="assets/favicon/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="assets/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<!-- Vendors styles-->
	<link rel="stylesheet" href="{{ url('css/simplebar.css') }}">
	<link rel="stylesheet" href="{{ url('css/simplebar2.css') }}">
	<!-- Main styles for this application-->
	<link href="{{ url('css/style.css') }}" rel="stylesheet">
	<!-- We use those styles to show code examples, you should remove them in your application.-->
	<link rel="stylesheet" href="{{ url('css/prism.css') }}">
	<link href="{{ url('css/examples.css') }}" rel="stylesheet">
	<style>
		.swal2-popup {
			font-size: 1.4rem !important;
			font-family: cursive !important;
		}

		.swal2-popup .btn,
		.swal2-popup .swal2-confirm {
			width: 100%;
		}

		.swal2-popup .swal2-success-circular-line-left,
		.swal2-popup .swal2-success-circular-line-right,
		.swal2-popup .swal2-success-fix {
			background-color: transparent !important;
		}

		.swal2-backdrop-show {
			background-size: cover !important;
		}

		body {
			width: 100%;
			height: 100%;
			background: url('../../images/bg.png');
			center top no-repeat;
			background-size: cover;
			position: relative;
		}

		p {
			margin: 0;
			padding: 0;
		}

		.bungkus-total {
			background-color: white;
			width: 149px;
			text-align: center;
			padding: 5px;
			border-radius: 15px;
		}

		.form-floating {

			position: relative;
		}

		.form-floating>.form-control {
			padding: 1rem 0.735rem;
		}

		.form-floating>.form-control,
		.form-floating>.form-select {
			height: calc(3.5rem + 2px);
			line-height: 1.25;
		}

		.form-control {
			display: block;
			width: 100%;
			padding: 0.469rem 0.735rem;
			font-size: 0.9375rem;
			font-weight: 400;
			line-height: 1.4;
			color: #677788;
			background-color: #fff;
			background-clip: padding-box;
			border: 1px solid #d4d8dd;
			-webkit-appearance: none;
			-moz-appearance: none;
			appearance: none;
			border-radius: 0.25rem;
			transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		}

		.form-floating>label {
			width: auto !important;
			position: absolute;
			top: 0;
			left: 0;
			height: 100%;
			padding: 1rem 0.735rem;
			pointer-events: none;
			border: 1px solid transparent;
			transform-origin: 0 0;
			transition: opacity 0.2s ease-in-out, transform 0.2s ease-in-out;
		}

		label {
			display: inline-block;
		}
	</style>
</head>

<!-- <body style="background-image:url('images/bg.png');"> -->

<form action="" id="form-voucher">
	<div class="min-vh-100 d-flex flex-row align-items-center">
		<div class="container">
			<div class="row justify-content-center opacity-0">
				<div class="col-md-6">
					<div class="card p-4">
						<div class="row">

						</div>

						<input class="form-control mb-3" id="voucher" name="voucher" size="16" type="text" placeholder=""
							autofocus autocomplete="off">
						<button class="btn btn-info" style="width:100%" type="submit" autofocus="false">Search</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<!-- CoreUI and necessary plugins-->
<script src="{{ url('js/coreui.bundle.min.js') }}"></script>
<script src="{{ url('js/simplebar.min.js') }}"></script>
<script src="{{ url('js/sweetalert2@11.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>

<script>
	setInterval(() => {
		document.getElementById("voucher").focus();
	}, 500);
	$('#form-voucher').on('submit', function(e) {
		e.preventDefault();
		var data = getJSON("{{ route('barcode_checkin') }}", {
			_token: '{{ csrf_token() }}',
			voucher: $('#voucher').val()
		});

		if (data.meta.code != 200) {
			Swal.fire(
				'Gagal',
				data.meta.message,
				'error'
			)
			Swal.fire({
				title: 'ID Not Found',
				text: data.meta.message,
				icon: 'error',
				showConfirmButton: false,
				showCloseButton: true,

				background: 'rgba(255,255,255,0)',
				backdrop: `
					rgba(0,0,123,0.4)
					url("/images/bgerror.png")
				`,
				color: '#000',
				showCloseButton: false,
				timer: 2000,
			})

		} else {
			Swal.fire({
				title: data.meta.message,
				showCloseButton: false,
				showConfirmButton: false,
				icon: data.meta.message == 'Success' ? 'success' : 'warning',
				// timer: 3000,
				background: 'rgba(255,255,255,2)',
				backdrop: `
						rgba(0,0,123,0.4)
						url("/images/bg2.png")
						`,

				color: '#000',
				html: `
					<div class="row mt-4 m-0 p-0">
							<div class="col-12">
								<div class="form-floating">
									<input type="text" class="form-control" id="nama_lengkap" placeholder="John Doe"
										aria-describedby="nama_lengkapHelp" value="${data.data.name}" disabled>
									<label for="nama_lengkap">Name</label>
								</div>
								<div class="form-floating mt-4">
									<input type="text" class="form-control" id="phone" placeholder="John Doe"
										aria-describedby="phoneHelp" value="${data.data.phone}" disabled>
									<label for="phone">Phone</label>
								</div>
							</div>
							<div class="col-12">
								<div class="form-floating">
									<input type="text" class="form-control" id="email" placeholder="John Doe"
										aria-describedby="emailHelp" value="${data.data.email}" disabled>
									<label for="email">Email</label>
								</div>
								<div class="form-floating mt-4">
									<input type="text" class="form-control" id="category" placeholder="John Doe"
										aria-describedby="categoryHelp" value="${data.data.category_name}" disabled>
									<label for="category">Area Kursi</label>
								</div>
							</div>
						</div>
						`,
				confirmButtonText: 'Redeem E-Ticket',
			}).then((result) => {
				if (result.isConfirmed) {
					var data = getJSON("{{ route('barcode_checkin') }}", {
						_token: '{{ csrf_token() }}',
						id: id
					});

					Swal.fire({
						timer: 2000,
						icon: 'success',
						title: data.meta.message,
						showConfirmButton: false,
						background: 'rgba(255,255,255,0.4)',
						backdrop: `
							rgba(0,0,123,0.4)
							url("/images/bg2.png")
						`,
						color: '#000'
					})
				}
				$('#voucher').val('');
				$('#voucher').focus();
			});
		}
		$('#voucher').focus();
		$('#voucher').val('');
		document.getElementById("voucher").focus();
	});
	document.getElementById("voucher").focus();

	$(".swal2-modal").css('background-color', '#000'); //Optional changes the color of the sweetalert 
	$(".swal2-container.in").css('background-color', 'rgba(43, 165, 137, 0.45)'); //changes the color of the overlay
	function getJSON(url, data, type = 'POST') {
		return JSON.parse($.ajax({
			type: type,
			url: url,
			data: data,
			dataType: 'json',
			global: false,
			async: false,
			success: function(msg) {

			}
		}).responseText);
	}
</script>

</body>

</html>
