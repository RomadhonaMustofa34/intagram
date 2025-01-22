@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-lg border-0">
            <div class="card-header bg-primary text-white text-center">
                <h4 class="mb-0">Edit Profil</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Notifikasi Sukses atau Error -->
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Foto Profil -->
                    <div class="mb-4 text-center">
                        @if ($user->profile_picture)
                            <img src="{{ asset('storage/' . $user->profile_picture) }}" 
                                alt="Foto Profil" 
                                class="rounded-circle shadow mb-3" 
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/150" 
                                alt="Foto Profil Default" 
                                class="rounded-circle shadow mb-3" 
                                style="width: 150px; height: 150px; object-fit: cover;">
                        @endif
                        <br>
                        <label for="profile_picture" class="form-label">Ubah Foto Profil</label>
                        <input type="file" name="profile_picture" id="profile_picture" class="form-control">
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label"><b>Nama</b></label>
                        <input type="text" name="name" id="name" class="form-control" 
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <!-- Bio -->
                    <div class="mb-3">
                        <label for="bio" class="form-label"><b>Bio</b></label>
                        <textarea name="bio" id="bio" class="form-control" rows="3">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <!-- Tombol Simpan -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg px-3">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
