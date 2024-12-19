<?php

namespace App\Http\Controllers;

use App\Models\FtthDismantle;
use App\Models\FtthIb;
use App\Models\FtthMt;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        {
            // Ambil parameter filter (default: bulanan)
            $filter = $request->input('filter', 'monthly');
            $startDate = null;
            $endDate = Carbon::now();

            // Tentukan rentang waktu berdasarkan filter
            if ($filter === 'daily') {
                $startDate = Carbon::today();
            } elseif ($filter === 'weekly') {
                $startDate = Carbon::now()->startOfWeek();
            } elseif ($filter === 'monthly') {
                $startDate = Carbon::now()->startOfMonth();
            }

            // Hitung data berdasarkan rentang waktu
            $ftth_ib = FtthIb::whereBetween('created_at', [$startDate, $endDate])->count();
            $ftth_mt = FtthMt::whereBetween('created_at', [$startDate, $endDate])->count();
            $ftth_dismantle = FtthDismantle::whereBetween('created_at', [$startDate, $endDate])->count();

            // Kirim data ke view

            return view('dashboard', compact('ftth_ib', 'ftth_dismantle', 'ftth_mt', 'filter'));
        }
    }
}
