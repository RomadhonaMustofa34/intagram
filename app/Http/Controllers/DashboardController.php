<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Cek apakah user sudah login
        if (Auth::check()) {
            // Tampilkan halaman dashboard
            return view('dashboard');
        }

        // Jika tidak login, redirect ke halaman login
        return redirect()->route('login')->with('error', 'You need to login first.');
    }
}
