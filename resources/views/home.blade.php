@extends('layouts.app')

@section('title', 'Home Page')

@section('content')
<div class="container">
    <h1>Welcome to the Photo Gallery</h1>
    @if (Auth::check())    
    <div class="row">
        @forelse($photos as $photo)
            <div class="col-md-4 mt-4">
                <div class="foto-container">
                    <a href="{{ Storage::url($photo->lokasi_file) }}" data-lightbox="gallery-{{ $loop->index }}" data-title="{{ $photo->judul_foto }}">
                        <img src="{{ Storage::url($photo->lokasi_file) }}" class="img-fluid foto-thumbnail" width="100%" height="225">
                    </a>
                    <h5 class="foto-title">
                        <a href="{{ route('foto.show', $photo->foto_id) }}">{{ $photo->judul_foto }}</a>
                    </h5>
                    <p class="foto-album">Album: {{ $photo->album->nama_album }}</p>
                </div>
            </div>
        @empty
            <p>No photos to display.</p>
        @endforelse
    </div>
    @else
    <div class="row">
        <p>Login First.</p>
    </div>
    @endif
</div>
@endsection