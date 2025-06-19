@extends('layouts.frontend')

{{-- Judul halaman akan menampilkan nama kategori --}}
@section('title', 'Kategori: ' . $category->name)

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mb-4 border-bottom pb-2">
                Berita Kategori: <span class="text-danger">{{ $category->name }}</span>
            </h1>
        </div>
    </div>

    <div class="row">
        @forelse($posts as $post)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ $post->title }}" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <p class="card-text text-muted flex-grow-1">{{ Str::limit(strip_tags($post->content), 100) }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-primary mt-auto stretched-link">Baca Selengkapnya</a>
                    </div>
                    <div class="card-footer text-muted">
                        <small>{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    Belum ada berita di dalam kategori ini.
                </div>
            </div>
        @endforelse
    </div>

    {{-- Tampilkan link paginasi --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $posts->links() }}
    </div>
</div>
@endsection