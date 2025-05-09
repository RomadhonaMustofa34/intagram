@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5>Komentar</h5>
        </div>
        <div class="card-body">
            <div class="mb-4 text-center">
                @if(Str::contains($feed->media, ['.mp4', '.mov']))
                    <video controls class="w-100" style="max-width: 600px;">
                        <source src="{{ asset('storage/' . $feed->media) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                @else
                    <img src="{{ asset('storage/' . $feed->media) }}" alt="Media Feed" class="img-fluid" style="max-width: 600px;">
                @endif
                <p class="mt-2">{{ $feed->caption }}</p>
            </div>

            <h5 class="text-primary mb-3">Komentar ({{ $feed->comments->count() }})</h5>

            @forelse($feed->comments as $comment)
                <div class="comment mb-4 p-3 bg-light rounded shadow-sm">
                    <div class="d-flex align-items-center mb-2">
                        <div class="avatar mr-2">
                            @if($comment->user->profile_picture)
                                <img src="{{ asset('storage/' . $comment->user->profile_picture) }}" alt="Foto Profil" class="rounded-circle" style="width: 40px; height: 40px;">
                            @else
                                <img src="https://via.placeholder.com/40" alt="Foto Profil" class="rounded-circle">
                            @endif
                        </div>
                        <strong class="mr-2">{{ $comment->user->name }}</strong>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                    <p class="mb-0">{{ $comment->comment }}</p>
                </div>
            @empty
                <p class="text-muted">Belum ada komentar.</p>
            @endforelse

            <!-- Tambahkan Komentar -->
            <form action="{{ route('feed.storeComment', $feed->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="form-group">
                    <textarea name="comment" class="form-control" placeholder="Tambahkan komentar..." rows="3" required></textarea>
                </div>
               <div class="d-flex justify-content-between mt-3">
    <button type="submit" class="btn btn-success btn-lg px-4">Kirim Komentar</button>
    <a href="{{ route('feed.index') }}" class="btn btn-warning btn-lg px-4">Batal</a>
</div>

            </form>
        </div>
    </div>
</div>
@endsection
