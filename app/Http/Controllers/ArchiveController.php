<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FeedsExport;
use PDF;

class ArchiveController extends Controller
{
    public function index(Request $request)
    {
        // Filter berdasarkan tanggal
        $query = Feed::query();
        if ($request->start_date) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $feeds = $query->where('user_id', auth()->id())->latest()->get();
        return view('archive.index', compact('feeds'));
    }

    public function download(Request $request)
{
    // Filter data berdasarkan tanggal
    $query = Feed::query();
    if ($request->start_date) {
        $query->whereDate('created_at', '>=', $request->start_date);
    }
    if ($request->end_date) {
        $query->whereDate('created_at', '<=', $request->end_date);
    }

    $feeds = $query->where('user_id', auth()->id())->latest()->get();

    // Generate PDF menggunakan data feeds
    $pdf = PDF::loadView('archive.pdf', compact('feeds'));

    // Mengembalikan file PDF untuk diunduh
    return $pdf->download('feeds.pdf');
}

}
