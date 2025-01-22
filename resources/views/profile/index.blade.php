@extends('layouts.app')

@section('content')

<style>
    /* Profil Section */
    .profile-card {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
        border: none;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
    }

    .profile-picture {
        width: 150px;
        height: 150px;
        object-fit: cover;
        border: 5px solid white;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
    }

    .profile-name {
        font-size: 1.8rem;
        font-weight: bold;
    }

    .profile-bio {
        font-style: italic;
        color: rgba(255, 255, 255, 0.8);
    }

    /* Tombol Edit */
    .btn-edit {
        background: linear-gradient(135deg, #007bff, #6610f2);
        color: white;
        border: none;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .btn-edit:hover {
        transform: scale(1.05);
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #6610f2, #007bff);
    }

    .btn-edit i {
        margin-right: 5px;
    }
</style>

<div class="container mt-5">
    <!-- Profil Section -->
    <div class="card profile-card text-center">
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

            <!-- Tombol Edit -->
            <a href="{{ route('profile.edit') }}" class="btn btn-edit btn-lg px-4">
                <i class="fas fa-edit"></i> Edit Profil
            </a>
        </div>
    </div>
</div>

@endsection
