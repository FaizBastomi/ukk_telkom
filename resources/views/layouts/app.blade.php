<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Galeri Foto')</title>
    <!-- Lightbox CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 5rem;
        }

        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }

        .foto-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin-bottom: 20px;
            transition: transform .2s;
            /* Animation */
        }

        .foto-container:hover {
            transform: scale(1.05);
            /* (110% zoom - Feel free to change it) */
            box-shadow: 0 4px 8px rgba(0, 0, 0, .05);
        }

        .foto-thumbnail {
            width: 100%;
            height: 200px;
            /* Adjust the height of the images */
            object-fit: cover;
            /* Make the images cover the area */
        }

        .foto-title {
            font-size: 18px;
            color: #007bff;
            margin-top: 15px;
        }

        .foto-description {
            background-color: #f8f9fa;
            padding: 10px;
            margin-top: 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .foto-title a {
            color: #000;
            /* Warna default dari judul */
            text-decoration: none;
            /* Menghilangkan garis bawah */
            transition: color 0.3s;
            /* Membuat transisi warna halus */
        }

        .foto-title a:hover {
            color: #800000;
            /* Warna maroon saat hover */
            cursor: pointer;
            /* Mengubah cursor menjadi tangan */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="{{ route('home') }}">Photo Gallery</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('albums.index') }}">Album</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('foto.index') }}">Foto</a>
                    </li>
                @endif
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item">
                    <a href="{{ route('auth.signupForm') }}" class="nav-link">Signup</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('auth.loginForm') }}" class="nav-link">Login</a>
                </li>
                @endguest
                <li>
                    @if (Auth::check())
                        <form method="post" action="{{ route('auth.logout') }}" style="display:none;" id="logout-form">
                            @csrf
                        </form>
                        <a class="nav-link" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit()">
                            Logout
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
    <main role="main" class="container">
        <div class="starter-template">
            @yield('content')
        </div>
    </main>
    <!-- jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Lightbox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
