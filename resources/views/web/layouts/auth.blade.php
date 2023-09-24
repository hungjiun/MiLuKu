<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Base Meta Tags --}}
    <meta charset="utf-8">
    {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>
        @yield('title', config('miluku.title', 'MiLuKu'))
    </title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('web_assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{asset('web_assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('web_assets/dist/css/adminlte.min.css')}}">

    <!-- ================== page-css ================== -->
    @yield('page-css')
    <!-- ================== /page-css ================== -->
</head>

<body class="hold-transition login-page" style="height: 50vh;">

    @yield('content')

    <!-- jQuery -->
    <script src="{{asset('web_assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('web_assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('web_assets/dist/js/adminlte.min.js')}}"></script>

    <!-- ================== page-js ================== -->
    @yield('page-js')
    <!-- ================== /page-js ================== -->

    <!-- ================== inline-js ================== -->
    @yield('inline-js')
    <!-- ================== /inline-js================== -->

</body>
</html>
