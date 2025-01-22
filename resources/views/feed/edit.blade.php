@extends('layouts.app')

@section('content')

<style>
    /* Card Style */
    .edit-card {
        border: none;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }


    /* Form Style */
    .form-label {
        font-weight: bold;
        color: #495057;
    }

    .form-control {
        border-radius: 0.5rem;
        box-shadow: inset 0px 1px 3px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s, border-color 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0px 0px 5px rgba(0, 123, 255, 0.5);
    }

    .btn-primary {
        background: linear-gradient(135deg, #007bff, #6610f2);
        border: none;
        transition: background 0.3s, transform 0.2s;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #6610f2, #007bff);
        transform: scale(1.05);
    }

    .btn-primary:focus {
        box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5);
    }
</style>

<!-- Form Edit Section -->
<div class="card edit-card shadow-lg border-0 mb-5">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Edit Foto/Video</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('feed.update', $feed->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- Current Media Preview -->
            <div class="mb-4 text-center">
                @if (Str::contains($feed->media, ['.mp4', '.mov']))
                    <video controls class="rounded shadow" style="width: 100%; max-width: 300px; height: auto;">
                        <source src="{{ asset('storage/' . $feed->media) }}" type="video/mp4">
                        Browser Anda tidak mendukung pemutaran video.
                    </video>
                @else
                    <img src="{{ asset('storage/' . $feed->media) }}" alt="Media Lama" 
                         class="rounded shadow" 
                         style="width: 100%; max-width: 300px; height: auto;">
                @endif
            </div>

            <!-- File Upload -->
            <div class="mb-3">
                <label for="media" class="form-label">Ganti Foto/Video</label>
                <input type="file" name="media" id="media" 
                       class="form-control" 
                       accept="image/jpeg,image/png,image/jpg,video/mp4,video/quicktime">
                <small class="form-text text-muted">Kosongkan jika tidak ingin mengganti media.</small>
            </div>

            <!-- Caption -->
            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <textarea name="caption" id="caption" 
                          class="form-control" rows="3" 
                          placeholder="Tambahkan caption untuk unggahan Anda">{{ $feed->caption }}</textarea>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-4">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@endsection
