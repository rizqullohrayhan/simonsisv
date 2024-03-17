<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>SIMONSI</title>
    <!-- Favicon -->
    <link href="{{ asset('assets/img/logo.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('findash/assets/css/bootstrap.min.css') }}">
    <!-- Typography CSS -->
    <link rel="stylesheet" href="{{ asset('findash/assets/css/typography.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('findash/assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ asset('findash/assets/css/responsive.css') }}">
    <!-- Full calendar -->
    <link href='{{ asset('findash/assets/fullcalendar/core/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('findash/assets/fullcalendar/daygrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('findash/assets/fullcalendar/timegrid/main.css') }}' rel='stylesheet' />
    <link href='{{ asset('findash/assets/fullcalendar/list/main.css') }}' rel='stylesheet' />
    <link rel="stylesheet" href="{{ asset('findash/assets/css/flatpickr.min.css') }}">
    <link rel="" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js">
    <script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <!-- page html to pdf -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        .form-control {
            border: 1px solid #aaaaaa7d
        }

        .scroll-card {
            max-height: 300px;
            overflow-y: auto;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            border: 1px solid #447d92;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            border: 1px solid #4a8495;
            background-color: white;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, white), color-stop(100%, #dcdcdc));
            background: -webkit-linear-gradient(top, white 0%, #dcdcdc 100%);
            background: -moz-linear-gradient(top, white 0%, #dcdcdc 100%);
            background: -ms-linear-gradient(top, white 0%, #dcdcdc 100%);
            background: -o-linear-gradient(top, white 0%, #dcdcdc 100%);
            background: linear-gradient(to bottom, #7ecdc5 0%, #4a8495 100%);
        }

        button.dt-button,
        div.dt-button,
        a.dt-button,
        input.dt-button {
            color: white;
            white-space: nowrap;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.1);
            background: linear-gradient(to bottom, rgb(72 131 149) 0%, rgb(124 203 196) 100%);
        }

        button.dt-button:hover,
        div.dt-button:hover,
        a.dt-button:hover,
        input.dt-button:hover {
            color: rgb(124 203 196);
            white-space: nowrap;
            overflow: hidden;
            background-color: rgba(0, 0, 0, 0.1);
            background: linear-gradient(to bottom, rgb(72 131 149) 0%, rgb(124 203 196) 100%);
        }
    </style>
</head>

<body class="sidebar-main" style="background-image: url('findash/assets/images/wave.svg');background-repeat:no-repeat">