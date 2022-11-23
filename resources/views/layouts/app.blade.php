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
    <nav class="navbar navbar-expand-md navbar-light topbar static-top shadow fixed-top">
        <div class="navbar-header mb-0">
            <a class="navbar-brand" href="/home">
                <img src="..\img\iccn.png" alt="Logo">
            </a>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigation"
            aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon">
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="navbar-item active">
                    <a class="nav-link text-white" aria-current="page" href="/home">Beranda</a>
                </li>
                <li class="navbar-item ">
                    <a class="nav-link text-white" aria-current="page" href="/organisasi">Organisasi</a>
                </li>
                <li class="navbar-item ">
                    <a class="nav-link text-white" aria-current="page" href="#">Program</a>
                </li>
                <li class="navbar-item ">
                    <a class="nav-link text-white" aria-current="page" href="/berita">Berita</a>
                </li>
                <li class="navbar-item ">
                    <a class="nav-link text-white" aria-current="page" href="#">Kontak</a>
                </li>
            </ul>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    @include('partials.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    @yield('page-script')
</body>

</html>