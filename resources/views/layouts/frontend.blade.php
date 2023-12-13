<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>SmartClinic</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Free HTML Templates" name="keywords">
        <meta content="Free HTML Templates" name="description">

        <!-- Favicon -->
        <link href="{{ asset('/assets/frontend/img/favicon.ico') }}" rel="icon">

        <!-- Google Web Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Rubik:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Icon Font Stylesheet -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

        <!-- FullCalendar -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />

        <!-- Libraries Stylesheet -->
        <link href="{{ asset('/assets/frontend/lib/owlcarousel/assets/frontend/owl.carousel.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/frontend/lib/animate/animate.min.css') }}" rel="stylesheet">

        <!-- Customized Bootstrap Stylesheet -->
        <link href="{{ asset('/assets/frontend/css/bootstrap.min.css') }}" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="{{ asset('/assets/frontend/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/assets/frontend/css/custom.css') }}" rel="stylesheet">
    </head>

    <body>
        @include('frontend.includes.header')
        @include('frontend.includes.navbar')
        @yield('content')
        @include('frontend.includes.footer')
    </body>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('/assets/frontend/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/lib/counterup/counterup.min.js') }}"></script>
    <script src="{{ asset('/assets/frontend/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <!-- FullCalendar -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- Template Javascript -->
    <script src="{{ asset('/assets/frontend/js/main.js') }}"></script>
    <script src="{{ asset('/assets/frontend/js/custom.js') }}"></script>
    @yield('scripts')
</html>