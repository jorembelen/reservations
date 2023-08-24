
<!DOCTYPE html>
<html lang="en">

<head>

	  <!-- CSRF Token -->
	  <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('title')</title>

	<link rel="canonical" href="pages-blank.html" />
	<link rel="shortcut icon" href="img/favicon.ico">

	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&amp;display=swap" rel="stylesheet">
	<link rel="canonical" href="https://appstack.bootlab.io/tables-datatables-responsive.html" />
	<link rel="canonical" href="https://appstack.bootlab.io/forms-advanced-inputs.html" />
	<link rel="canonical" href="https://appstack.bootlab.io/charts-chartjs.html" />
	<!-- Choose your prefered color scheme -->
	 <link href="/assets/css/light.css" rel="stylesheet">
	 <link href="/css/prevent.css" rel="stylesheet" />
	 <link href="/assets/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">
	<link href="/assets/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">

    @livewireStyles
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left">
	<div class="wrapper">

        @include('includes.sidebar')

		<div class="main">

            @include('includes.navbar')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">@yield('title')</h1>

						@yield('content')
						@include('sweetalert::alert')
						@include('scripts.toastr')

				</div>
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">

						<div class="col-6 text-right">
							<p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
								by: <a target="_blank" href="https://joreb.net/">JOREB </a>(RCLCD-IT)</p>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>



    <script src="/assets/js/app.js"></script>
    <script src="/js/prevent.js"></script>
             <!-- Laravel Javascript Validation -->
             <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
             {!! JsValidator::formRequest('App\Http\Requests\ReservationStoreRequest', '#res-create'); !!}
             {!! JsValidator::formRequest('App\Http\Requests\RoomStoreRequest', '#room-create'); !!}
             {!! JsValidator::formRequest('App\Http\Requests\UserStoreRequest', '#user-create'); !!}
             {!! JsValidator::formRequest('App\Http\Requests\UserUpdateRequest', '#user-update'); !!}

    <script>
		document.addEventListener("DOMContentLoaded", function() {
			// Datatables Responsive
			$("#datatables-reponsive").DataTable({
				responsive: true
			});
		});
	</script>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Select2
			$(".select2").each(function() {
				$(this)
					.wrap("<div class=\"position-relative\"></div>")
					.select2({
						// placeholder: "Select value",
						dropdownParent: $(this).parent()
					});
			})

		});
	</script>
		<script>
			document.addEventListener("DOMContentLoaded", function() {
				// Datatables with Buttons
				var datatablesButtons = $("#datatables-buttons").DataTable({
					responsive: true,
					lengthChange: !1,
					buttons: ["copy", "print"]
				});
				datatablesButtons.buttons().container().appendTo("#datatables-buttons_wrapper .col-md-6:eq(0)");
			});
		</script>
<script>

	$(function() {

		// run on change for the selectbox

		$( "#payables_frm" ).change(function() {
			witnessDivs();
		});

		// handle the updating of the duration divs
		function witnessDivs() {
			// hide all form-duration-divs
			$('.frm-div').hide();

			  // for Leave
			var witKey = $( "#payables_frm option:selected" ).val();
			$('#select'+witKey).show();

		}

		// run at load, for the currently selected div to show up
		witnessDivs();

	});

	</script>

@yield('script')

@stack('js')

@livewireScripts
</body>

</html>
