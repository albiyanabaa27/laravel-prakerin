<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Egames - Gaming Magazine Template</title>

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('/asset/egames/img/core-img/MyVG-Icon.ico') }}">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="{{ asset('/asset/egames/style.css') }}">

</head>
<body>

@include('layouts.frontend.header')
@include('layouts.frontend.contentdashboard')
@include('layouts.frontend.footer')

<!-- ##### All Javascript Script ##### -->
    <!-- jQuery-2.2.4 js -->
    <script src="/asset/egames/js/jquery/jquery-2.2.4.min.js"></script>
    <!-- Popper js -->
    <script src="/asset/egames/js/bootstrap/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="/asset/egames/js/bootstrap/bootstrap.min.js"></script>
    <!-- All Plugins js -->
    <script src="/asset/egames/js/plugins/plugins.js"></script>
    <!-- Active js -->
    <script src="/asset/egames/js/active.js"></script>
</body>

</html>
