<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('/assets/admin/img/apple-icon.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('/assets/admin/img/favicon.png') }}">
        <title>SmartClinic</title>
        <!-- Fonts and icons -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
        <!-- FullCalendar -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
        <!-- Bootstrap 4 -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
        <!-- Nucleo Icons -->
        <link href="{{ asset('/assets/admin/css/nucleo-icons.css') }}" rel="stylesheet" />
        <link href="{{ asset('/assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />
        <link href="{{ asset('/assets/admin/css/custom.css') }}" rel="stylesheet" />
        <!-- Font Awesome Icons -->
        <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
        <link href="{{ asset('/assets/admin/css/nucleo-svg.css') }}" rel="stylesheet" />
        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('/assets/admin/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
        <!-- Toastr -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <!-- Select -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>

    <body class="g-sidenav-show bg-gray-100">
        <div class="min-height-300 bg-primary position-absolute w-100"></div>
        @include('admin.includes.sidebar')
        <main class="main-content position-relative border-radius-lg ">
            <!-- Navbar -->
            @include('admin.includes.header')
            <!-- End Navbar -->
            @yield('content')
        </main>
        @include('admin.includes.footer')
    </body>
    
    <!-- Core JS Files -->
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js" integrity="sha512-tWHlutFnuG0C6nQRlpvrEhE4QpkG1nn2MOUMWmUeRePl4e3Aki0VB6W1v3oLjFtd0hVOtRQ9PHpSfN6u6/QXkQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Popper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!-- Bootstrap 4 -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->
    <!-- Select -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <!-- Local Js -->
    <script src="{{ asset('/assets/admin/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('/assets/admin/js/custom.js') }}"></script>
    <!-- FullCalendar -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script>
        // var ctx1 = document.getElementById("chart-line").getContext("2d");

        // var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

        // gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
        // gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
        // gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
        // new Chart(ctx1, {
        // type: "line",
        // data: {
        //     labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        //     datasets: [{
        //     label: "Mobile apps",
        //     tension: 0.4,
        //     borderWidth: 0,
        //     pointRadius: 0,
        //     borderColor: "#5e72e4",
        //     backgroundColor: gradientStroke1,
        //     borderWidth: 3,
        //     fill: true,
        //     data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
        //     maxBarThickness: 6

        //     }],
        // },
        // options: {
        //     responsive: true,
        //     maintainAspectRatio: false,
        //     plugins: {
        //     legend: {
        //         display: false,
        //     }
        //     },
        //     interaction: {
        //     intersect: false,
        //     mode: 'index',
        //     },
        //     scales: {
        //     y: {
        //         grid: {
        //         drawBorder: false,
        //         display: true,
        //         drawOnChartArea: true,
        //         drawTicks: false,
        //         borderDash: [5, 5]
        //         },
        //         ticks: {
        //         display: true,
        //         padding: 10,
        //         color: '#fbfbfb',
        //         font: {
        //             size: 11,
        //             family: "Open Sans",
        //             style: 'normal',
        //             lineHeight: 2
        //         },
        //         }
        //     },
        //     x: {
        //         grid: {
        //         drawBorder: false,
        //         display: false,
        //         drawOnChartArea: false,
        //         drawTicks: false,
        //         borderDash: [5, 5]
        //         },
        //         ticks: {
        //         display: true,
        //         color: '#ccc',
        //         padding: 20,
        //         font: {
        //             size: 11,
        //             family: "Open Sans",
        //             style: 'normal',
        //             lineHeight: 2
        //         },
        //         }
        //     },
        //     },
        // },
        // });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="{{ asset('/assets/admin/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
    @yield('scripts')
</html>