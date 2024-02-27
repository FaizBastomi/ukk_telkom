@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="foto-detail">
                    <img src="{{ Storage::url($foto->lokasi_file) }}" class="img-fluid" alt="{{ $foto->judul_foto }}">
                    <h3 class="mt-3">{{ $foto->judul_foto }}</h3>
                    <p>{{ $foto->deskripsi_foto }}</p>

                    <div class="badge badge-primary">Uploaded by: {{ $foto->user->name }}</div>
                    <div class="badge badge-secondary">Album: {{ $foto->album->nama_album }}</div>
                    <!-- Tampilkan jumlah komentar -->
                    <div class="badge badge-info">{{ $foto->komentars->count() }} komentar</div>
                </div>
                <!-- Bagian menampilkan komentar -->
                <div class="card text-left mt-1">
                    <div class="card-header">
                        <div class="row ml-1 justify-content-between">
                            <h4 class="mb-0">Komentar</h4>
                            <form action="{{ route('like.toggle') }}" method="POST">
                                @csrf
                                <input type="hidden" name="foto_id" value="{{ $foto->foto_id }}">
                                <button type="submit" class="btn btn-sm text-danger">
                                    <i class="{{ $foto->likes->contains('user_id', auth()->id()) ? 'fas' : 'far' }} fa-heart"></i>
                                    Like | {{ $foto->likes->count() }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        @forelse($foto->komentars as $komentar)
                            <div class="row ml-1">
                                <p class="mb-0 mr-auto"><b>{{ $komentar->user->name }}:</b> {{ $komentar->isi_komentar }}
                                </p>
                                <p class="mr-1 text-muted">{{ $komentar->created_at->diffForHumans() }}</p>
                                @if ($komentar->user->id == auth()->id())
                                    <div class="dropdown mr-1">
                                        <button class="btn btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <form method="POST" action="{{ route('komentar.destroy', $komentar->komentar_id) }}" id="hapus-komentar">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn dropdown-item text-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <p>Belum ada komentar.</p>
                        @endforelse
                    </div>
                    <!-- Formulir untuk menambah komentar baru -->
                    @if (Auth::check())
                        <form action="{{ route('komentar.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="foto_id" value="{{ $foto->foto_id }}">
                            <div class="form-group ml-4 mr-2">
                                <textarea name="isi_komentar" class="form-control" rows="3" placeholder="Tambahkan komentar..." required></textarea>
                                <div class="row justify-content-end mr-0">
                                    <button type="submit" class="btn btn-primary mt-1">Kirim Komentar</button>
                                </div>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
