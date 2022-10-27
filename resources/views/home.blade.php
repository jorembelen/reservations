
<!DOCTYPE html>
<html lang="en">

<head>

	  <!-- CSRF Token -->
	  <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Calendar</title>

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
</head>

<body data-theme="light" data-layout="fluid" data-sidebar-position="left" data-sidebar-behavior="compact">
	<div class="wrapper">


		<div class="main">
            <!-- Image and text -->
            <nav class="navbar navbar-light bg-light">
                <form class="form-inline">
                  <a href="/login" class="btn btn-outline-primary" type="button">Login</a>
                </form>
              </nav>

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">Calendar</h1>



    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div id="fullcalendar" class="app-fullcalendar"></div>
                </div>
            </div>
        </div>



@include('includes.calendar')

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

</body>

</html>
