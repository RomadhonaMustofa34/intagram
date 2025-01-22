@extends('layouts.app')

@section('content')

<style>
    /* Global Style */
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Header Section */
    .archive-header {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        color: white;
        padding: 1.5rem;
        border-radius: 0.5rem;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    .archive-header h2 {
        font-weight: bold;
    }

    /* Filter Form */
    .filter-form input {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        transition: border-color 0.3s;
    }

    .filter-form input:focus {
        border-color: #2575fc;
        box-shadow: 0px 0px 5px rgba(37, 117, 252, 0.5);
    }

    .filter-form button {
        background: linear-gradient(135deg, #6a11cb, #2575fc);
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 0.5rem;
        transition: transform 0.2s, background 0.3s;
    }

    .filter-form button:hover {
        background: linear-gradient(135deg, #2575fc, #6a11cb);
        transform: scale(1.05);
    }

    /* Table Scroll */
    .table-container {
        max-height: 440px; /* Maximum height for scrolling */
        overflow-y: auto; /* Scroll vertically if content overflows */
        border: 1px solid #dee2e6; /* Optional: Border for better visibility */
        border-radius: 0.5rem;
    }

    /* Table */
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .table th {
        background-color: #2575fc;
        color: white;
        border: none;
        font-weight: bold;
        text-align: center;
    }

    .table td {
        background-color: #f8f9fa;
        border: none;
        vertical-align: middle;
        text-align: center;
        padding: 1rem;
    }

    .table img, .table video {
        border-radius: 0.5rem;
        box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }

    /* Buttons */
    .export-button {
        background: linear-gradient(135deg, #7027e5, #181e88);
        color: white;
        border: none;
        padding: 0.5rem 1.5rem;
        font-weight: bold;
        border-radius: 0.5rem;
        transition: transform 0.2s, background 0.3s;
    }

    .export-button:hover {
        background: linear-gradient(135deg, #0e075c, #251181);
        transform: scale(1.05);
    }

    /* Scrollbar Styling */
    .table-container::-webkit-scrollbar {
        width: 8px;
    }

    .table-container::-webkit-scrollbar-thumb {
        background-color: #6a11cb;
        border-radius: 10px;
    }

    .table-container::-webkit-scrollbar-track {
        background-color: #f1f1f1;
    }
</style>

<div class="container mt-5 table-container">
    <!-- Header -->
    <div class="archive-header text-center mb-4">
        <h2>Archive Post</h2>
        <p>Kelola dan unduh arsip unggahan Anda dengan mudah.</p>
    </div>

    <!-- Filter Form -->
    <form action="{{ route('archive.index') }}" method="GET" class="filter-form mb-4">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="date" name="start_date" class="form-control" 
                    value="{{ request('start_date') }}" placeholder="Start Date">
            </div>
            <div class="col-md-4">
                <input type="date" name="end_date" class="form-control" 
                    value="{{ request('end_date') }}" placeholder="End Date">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <!-- Export Buttons -->
    <div class="text-end mb-3">
        <a href="{{ route('archive.download', ['format' => 'pdf'] + request()->all()) }}" class="export-button">
            Download PDF
        </a>
    </div>

    <!-- Data Table with Scroll -->
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th>Media</th>
                    <th>Tanggal Post</th>
                    <th>Caption</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($feeds as $feed)
                    <tr>
                        <td>
                            @if (Str::contains($feed->media, ['.mp4', '.mov']))
                                <video controls style="width: 100px; height: auto;">
                                    <source src="{{ asset('storage/' . $feed->media) }}" type="video/mp4">
                                </video>
                            @else
                                <img src="{{ asset('storage/' . $feed->media) }}" 
                                    alt="Media" style="width: 100px; height: auto;">
                            @endif
                        </td>
                        <td>{{ $feed->created_at->format('d M Y') }}</td>
                        <td>{{ $feed->caption }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
