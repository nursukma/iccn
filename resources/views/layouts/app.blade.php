<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    <title>ICCN - Indonesia Creative Cities Network</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('page-style')
</head>

<body>
    <div class="wrapper">
        <div class="fixed-top">
            <nav class="navbar navbar-expand-md navbar-light topbar static-top shadow">
                <div class="container">
                    <a class="navbar-brand text-white" href="/home">
                        Logo ICCN
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon text-white"></span>
                      </button>
                    <div id="navigation" class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="navbar-item">
                                <a class="nav-link text-white active" aria-current="page" href="#">Beranda</a>
                            </li>
                            <li class="navbar-item">
                                <a class="nav-link text-white" aria-current="page" href="#">Organisasi</a>
                            </li>
                            <li class="navbar-item">
                                <a class="nav-link text-white" aria-current="page" href="#">Program</a>
                            </li>
                            <li class="navbar-item">
                                <a class="nav-link text-white" aria-current="page" href="#">Berita</a>
                            </li>
                            <li class="navbar-item">
                                <a class="nav-link text-white" aria-current="page" href="#">Kontak</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>

        <main>
            @yield('content')
        </main>

        @include('partials.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    @yield('page-script')
</body>

</html>