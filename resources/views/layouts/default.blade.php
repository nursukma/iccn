<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Custom fonts for this template-->
    <link href="{{ asset('build/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('build/assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

    {{-- Form Editor Quill --}}
    <link href="{{ asset('build/assets/vendor/quill/quill.snow.css') }}" rel="stylesheet">
    <link href="{{ asset('build/assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet">

    {{-- Datatables --}}
    {{-- <link href="{{ asset('build/assets/vendor/datatables/jquery.dataTables.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('build/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

    <title>Admin Page</title>
    @yield('page-style')
</head>

<body id="page-top">
    <div id="wrapper">
        @include('partials.sidebar')

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('partials.topbar')

                <div class="container-fluid">
                    @yield('content')

                    <!-- Scroll to Top Button-->
                    <a class="scroll-to-top rounded" href="#page-top">
                        <i class="fas fa-angle-up"></i>
                    </a>
                </div>
            </div>

            @include('partials.footer')
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('build/assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('build/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('build/assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('build/assets/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('build/assets/vendor/chart.js/Chart.min.js') }}"></script>

    <script src="{{ asset('build/assets/vendor/quill/quill.min.js') }}"></script>

    {{-- datatables --}}
    {{-- <script src="{{ asset('build/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('build/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script> --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    @yield('page-script')

</body>

</html>
