@extends('layouts.app')

@section('title', 'Fotos')

@section('content')
    <div class="container">
        <h1>Fotos</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                @auth
                    <a href="{{ route('foto.create') }}" class="btn btn-primary mb-3">Tambah Foto</a>
                @endauth
            </div>
        </div>
        <div class="row">
            @foreach ($fotos as $foto)
                <div class="col-md-4 mb-4">
                    <div class="foto-container">
                        <a href="{{ Storage::url($foto->lokasi_file) }}" data-lightbox="gallery-{{ $loop->index }}"
                            data-title="{{ $foto->judul_foto }}">
                            <img src="{{ Storage::url($foto->lokasi_file) }}" class="img-fluid foto-thumbnail"
                                alt="{{ $foto->judul_foto }}">
                        </a>
                        <h5 class="foto-title">
                            <a href="{{ route('foto.show', $foto->foto_id) }}">{{ $foto->judul_foto }}</a>
                        </h5>
                        <p class="foto-album">Album: {{ $foto->album->nama_album }}</p> <!-- Tampilkan nama album -->
                        <p class="foto-user">Uploaded by: {{ $foto->user->name }}</p> <!-- Tampilkan nama user -->
                        @if ($foto->deskripsi_foto)
                            <div class="foto-description">{{ $foto->deskripsi_foto }}</div>
                        @endif
                        <div class="row justify-content-center my-1">
                            <form class="mb-0" method="POST" action="{{ route('foto.destroy', $foto->foto_id) }}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
