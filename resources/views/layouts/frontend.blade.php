<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Judul halaman akan dinamis, dengan judul default jika tidak diset --}}
    <title>@yield('title', 'ChoCho News - Berita Terkini dan Terpercaya')</title>

    {{-- Bootstrap 5 CSS dari CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    {{-- Font dari Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&family=Lato:wght@400;700&display=swap" rel="stylesheet">

    {{-- Kustomisasi CSS --}}
    <style>
        body {
            font-family: 'Lato', sans-serif;
        }
        h1, h2, h3, h4, h5, h6, .navbar-brand-custom {
            font-family: 'Merriweather', serif;
        }
        .news-flash { 
            background-color: #d92128; 
            color: white; 
        }
        .footer { 
            background-color: #212529; 
            color: white; 
            padding: 2rem 0; 
        }
        .post-card { 
            margin-bottom: 1.5rem; 
        }
        .navbar-brand-custom { 
            font-weight: bold; 
            font-size: 2rem; 
        }
    </style>

    {{-- Slot untuk CSS tambahan dari halaman spesifik --}}
    @stack('styles')
</head>
<body>

    {{-- Header dengan Judul Website --}}
    <header class="border-bottom">
        <div class="container py-3">
            <div class="d-flex justify-content-center align-items-center">
                <a href="{{ route('home') }}" class="navbar-brand-custom text-dark text-decoration-none">ChoCho News</a>
            </div>
        </div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm sticky-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link fw-bold" href="/">HOME</a></li>
                
                {{-- Loop melalui semua kategori dari database --}}
                @if(isset($categories))
                    @foreach($categories as $category)
                        <li class="nav-item">
                            {{-- Buat link dinamis ke halaman kategori --}}
                            <a class="nav-link" href="{{ route('posts.category', $category->slug) }}">
                                {{-- Ubah nama kategori menjadi huruf besar --}}
                                {{ strtoupper($category->name) }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
            </div>
        </div>
    </nav>

    {{-- Konten Utama dari setiap halaman akan dirender di sini --}}
    <main class="container mt-4">
        @yield('content')
    </main>

    {{-- Footer Website --}}
    <footer class="footer mt-5">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} ChoCho News. All Rights Reserved.</p>
        </div>
    </footer>

    {{-- Bootstrap 5 dan Popper.js dari CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Slot untuk Javascript tambahan dari halaman spesifik --}}
    @stack('scripts')
</body>
</html>