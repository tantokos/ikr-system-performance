<?php

namespace App\Http\Controllers;

use App\Imports\ImportFtthDismantle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ImportFtthDismantleController extends Controller
{
    public function index()
    {
        $akses = Auth::user()->name;
        $leadCallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $jmlData = DB::table('import_ftth_dismantle');

        return view('ftth-dismantle.import_ftth_dismantle', compact('akses', 'leadCallsign', 'branches', 'jmlData'));
    }

    public function importProsesFtthDismantle(Request $request)
    {
        if ($request->hasFile('fileDataWO')) {

            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            Excel::import(new ImportFtthDismantle($akses), request()->file('fileDataWO'));

            return back()->with(['success' => 'Import FTTH Dismantle berhasil.']);

        }

    }
}
