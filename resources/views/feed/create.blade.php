@extends('layouts.app')

@section('content')

<style>
    /* Card Style */
    .upload-card {
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

<!-- Form Upload Section -->
<div class="card upload-card shadow-lg border-0 mb-5">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Upload Foto/Video</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('feed.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- File Upload -->
            <div class="mb-3">
                <label for="media" class="form-label">Pilih Foto/Video</label>
                <input type="file" name="media" id="media" 
                    class="form-control" 
                    accept="image/jpeg,image/png,image/jpg,video/mp4,video/quicktime" required>
            </div>
            <!-- Caption -->
            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <textarea name="caption" id="caption" 
                    class="form-control" rows="3" 
                    placeholder="Tambahkan caption untuk unggahan Anda"></textarea>
            </div>
            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg px-4">Upload</button>
            </div>
        </form>
    </div>
</div>

@endsection
