@extends('layouts.frontend')

@section('title', $post->title)

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        
        <h1 class="mb-3" style="font-family: 'Merriweather', serif;">{{ $post->title }}</h1>

        <div class="text-muted mb-4">
            @if($post->category)
                <span class="badge bg-danger me-2">{{ $post->category->name }}</span>
            @endif
            Dipublikasikan pada {{ $post->created_at->format('d F Y, H:i') }} WIB
        </div>

        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="img-fluid rounded mb-4 w-100" alt="{{ $post->title }}">
        @endif

        <div class="fs-5" style="line-height: 1.8;">
            {!! $post->content !!}
        </div>
        
        <hr class="my-5">
        
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">&larr; Kembali ke Halaman Utama</a>
        
    </div>
</div>
@endsection