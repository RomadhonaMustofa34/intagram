@extends('layouts.app')

@section('content')

<style>
    /* Profil Section */
    .profile-card {
        background: linear-gradient(135deg, #007bff, rgb(29, 29, 29));
        color: white;
    }

    .profile-picture {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .profile-bio {
        font-style: italic;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Tombol Tambahkan Feed */
    .add-feed {
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
        transition: transform 0.3s, background 0.3s;
    }

    .add-feed:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #e9ecef, #dee2e6);
    }

    .add-feed-icon {
        font-size: 3rem;
        color: #007bff;
        font-weight: bold;
    }

    /* Feed Section */
    .feed-scroll {
        max-height: 550px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #007bff #f1f1f1;
    }

    .feed-scroll::-webkit-scrollbar {
        width: 8px;
    }

    .feed-scroll::-webkit-scrollbar-thumb {
        background-color: #007bff;
        border-radius: 10px;
    }

    .feed-card {
        border: none;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .feed-card:hover {
        transform: scale(1.03);
        box-shadow: 0px 6px 15px rgba(0, 0, 0, 0.2);
    }

    .feed-media {
        height: 200px;
        object-fit: cover;
        border-top-left-radius: 0.25rem;
        border-top-right-radius: 0.25rem;
    }

    .feed-caption {
        font-size: 0.95rem;
        font-weight: 500;
    }

    .feed-date {
        font-size: 0.85rem;
        color: #6c757d;
    }

    .feed-actions a,
    .feed-actions button {
        padding: 0.25rem 0.75rem;
        font-size: 0.8rem;
        border-radius: 20px;
    }

    .btn-outline-primary:hover {
        background-color: #007bff;
        color: white;
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
    }
</style>

<div class="feed-scroll">
    <!-- Profil Section -->
    <div class="card shadow-lg border-0 mb-5 profile-card text-center">
        <div class="card-body">
            <!-- Foto Profil -->
            <div class="mb-4">
                @if ($user->profile_picture)
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                        alt="Foto Profil" 
                        class="rounded-circle profile-picture">
                @else
                    <img src="https://via.placeholder.com/150" 
                        alt="Foto Default" 
                        class="rounded-circle profile-picture">
                @endif
            </div>
            <!-- Username -->
            <h3 class="profile-name">{{ $user->name }}</h3>
            <!-- Bio -->
            <p class="profile-bio">{{ $user->bio ?? 'Belum ada bio yang ditulis.' }}</p>
        </div>
    </div>

    <!-- Tambahkan Feed -->
    <div class="text-center mb-4">
        <a href="/feed/create" class="d-inline-block text-decoration-none">
            <div class="d-flex align-items-center justify-content-center add-feed rounded-circle shadow-lg"
                style="width: 100px; height: 100px; cursor: pointer;">
                <span class="add-feed-icon" style="font-size: 2rem;">+</span>
            </div>
            <p class="mt-2 text-primary font-weight-bold">Upload Feed</p>
        </a>
    </div>

    <!-- Feed Section -->
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><b>Feed Foto & Video</b></h5>
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($feeds as $feed)
                    <div class="col-md-4 mb-4 d-flex align-items-stretch">
                        <div class="card feed-card w-100">
                            <!-- Media -->
                            @if (Str::contains($feed->media, ['.mp4', '.mov']))
                                <video controls class="w-100 feed-media">
                                    <source src="{{ asset('storage/' . $feed->media) }}" type="video/mp4">
                                    Browser Anda tidak mendukung pemutaran video.
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $feed->media) }}" 
                                    alt="Media Feed" 
                                    class="img-fluid feed-media">
                            @endif
                            <!-- Caption and Details -->
                            <div class="p-3 text-center">
                                <p class="feed-caption mb-1">{{ $feed->caption }}</p>
                                <small class="feed-date">Diunggah pada {{ $feed->created_at->format('d M Y') }}</small>
                            </div>
                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-around pb-3 feed-actions">
                                <a href="{{ route('feed.edit', $feed->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                <form action="{{ route('feed.destroy', $feed->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus feed ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted w-100">Belum ada unggahan.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
