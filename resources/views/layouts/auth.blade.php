<!doctype html>
<html lang="en">
  <head>
  	<title>SmartClinic</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="{{ asset('/assets/auth/css/style.css') }}" rel="stylesheet">
	</head>

	<body class="img js-fullheight" style="background-image: url({{ asset('assets/auth/images/background.jpg') }});">
        @yield('content')
	</body>

    <script src="{{ asset('/assets/auth/js/jquery.min.js') }}"></script>
    <script src="{{ asset('/assets/auth/js/popper.js') }}"></script>
    <script src="{{ asset('/assets/auth/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/auth/js/main.js') }}"></script>
</html>

