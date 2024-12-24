<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\FtthIb;
use App\Models\FtthMt;
use Illuminate\Http\Request;
use App\Models\FtthDismantle;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $filter = $request->input('filter', 'daily');
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

        return view('dashboard', compact('ftth_ib', 'ftth_dismantle', 'ftth_mt', 'filter'));
    }

    public function getFtthData(Request $request)
    {
        // Define the models and their respective result keys

        $models = [
            'App\Models\FtthIb' => 'ftth_ib',
            'App\Models\FtthMt' => 'ftth_mt',
            'App\Models\FtthDismantle' => 'ftth_dismantle',
        ];

        // Fetch filter parameter
        $filter = request('filter', 'daily');

        // Determine the date format and grouping based on the filter
        switch ($filter) {
            case 'daily':
                $dateFormat = 'DATE(created_at)';
                $groupBy = DB::raw('DATE(created_at)');
                break;
            case 'weekly':
                $dateFormat = 'WEEK(created_at)';
                $groupBy = DB::raw('WEEK(created_at)');
                break;
            case 'monthly':
            default:
                $dateFormat = 'MONTH(created_at)';
                $groupBy = DB::raw('MONTH(created_at)');
                break;
        }

        // Initialize the response data
        $responseData = [
            'status' => true,
            'code' => 200,
            'results' => []
        ];

        // Fetch data for each model
        foreach ($models as $model => $key) {
            $responseData['results'][$key] = $model::select(
                DB::raw("$dateFormat as dateKey"),
                DB::raw('count(*) as total')
            )
            ->groupBy($groupBy)
            ->get();
        }

        // Return JSON response
        return response()->json($responseData, 200);
    }

}
