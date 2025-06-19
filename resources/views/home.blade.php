@extends('layouts.frontend')

@section('title', 'ChoCho News - Berita Terkini dan Terpercaya')

@section('content')
    {{-- Newsflash Ticker --}}
    @if(isset($newsflash) && $newsflash->count() > 0)
    <div class="news-flash p-2 mb-4 d-flex align-items-center">
        <span class="fw-bold px-3 flex-shrink-0">NEWS FLASH</span>
        <div id="news-ticker" class="carousel slide flex-grow-1" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($newsflash as $key => $flash)
                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                    <a href="{{ route('posts.show', $flash->slug) }}" class="text-white text-decoration-none">{{ $flash->title }}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-lg-8">
            @if(isset($headlinePost))
                <div class="card bg-dark text-white mb-4">
                    {{-- Ini adalah gambar latar belakang kartu --}}
                    <img src="{{ $headlinePost->image ? asset('storage/' . $headlinePost->image) : 'https://via.placeholder.com/800x400?text=ChoCho+News' }}" class="card-img" alt="{{ $headlinePost->title }}" style="max-height: 450px; object-fit: cover;">
                    
                    {{-- Ini adalah lapisan teks di atas gambar. Kelas "card-img-overlay" sangat penting --}}
                    <div class="card-img-overlay d-flex flex-column justify-content-end p-4" style="background: linear-gradient(to top, rgba(0,0,0,0.9), transparent);">
                        @if($headlinePost->category)
                        <span class="badge bg-danger mb-2">{{ $headlinePost->category->name }}</span>
                        @endif
                        <h2 class="card-title">
                            <a href="{{ route('posts.show', $headlinePost->slug) }}" class="text-white text-decoration-none stretched-link">{{ $headlinePost->title }}</a>
                        </h2>
                        <p class="card-text"><small>Dibuat {{ $headlinePost->created_at->diffForHumans() }}</small></p>
                    </div>
                </div>
            @else
                <div class="alert alert-info">Belum ada berita utama untuk ditampilkan.</div>
            @endif
        </div>

        <div class="col-lg-4">
            <h4 class="border-bottom pb-2 mb-3">Terbaru</h4>
            @forelse($otherPosts as $item)
                <div class="d-flex align-items-center post-card">
                    <img src="{{ $item->image ? asset('storage/' . $item->image) : 'https://via.placeholder.com/150?text=ChoCho' }}" alt="{{ $item->title }}" style="width: 100px; height: 80px; object-fit: cover;" class="me-3 rounded">
                    <div>
                        <h6><a href="{{ route('posts.show', $item->slug) }}" class="text-dark text-decoration-none">{{ $item->title }}</a></h6>
                        <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            @empty
                <p>Belum ada berita lainnya.</p>
            @endforelse
        </div>
    </div>
@endsection