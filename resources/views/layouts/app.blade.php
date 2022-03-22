<!Doctype html>
<html lang="DE">

<head>
    <meta charset="UTF-8">
    <title>Abalo</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/article.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
    <!-- Navigationsleiste -->
    <nav class="navbar-container">
        <!--Logo -->
        <div class="navbar-item">
            <img id="navbarLogo" src="{{ url('/images/logoInverted.jpg') }}" alt="Abalo">
        </div>
        <!-- Buttons -->
        <div class="navbar-item">
            <a class="btn btn-light" href="/home">Startseite</a>
        </div>
        <div class="navbar-item">
            <a class="btn btn-light" href="/articles">Articles</a>
        </div>

        @if (!Auth::guest())
            <div class="navbar-item">
                <a class="btn btn-light" href="/logout">Log out</a>
            </div>
        @else
            <div class="navbar-item">
                <a class="btn btn-light" href="/showLogin">login</a>
            </div>
        @endif
    </nav>
    <!-- Ende Navbar -->
    @yield('content')
</body>

</html>
