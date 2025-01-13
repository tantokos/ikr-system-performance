<?php

namespace App\Http\Controllers\FTTX;

use App\Http\Controllers\Controller;
use App\Imports\AssignTeamFttxImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Yajra\DataTables\Facades\DataTables;

class ImportAssignTeamController extends Controller
{
    public function index(Request $request)
    {
        $akses = Auth::user()->name;
        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $jmlData = DB::table('import_assign_tims')->where('login', '=', $akses)->count('login');

        $callsigns = DB::table('import_assign_tims')
        ->select('callsign', 'branch_id','branch', 'type_wo', DB::raw('count(*) as total_wo'))
        ->groupBy('callsign', 'type_wo','branch_id', 'branch')
        ->orderBy('branch_id')
        ->orderBy('callsign')
        ->get();


        $pivotData = [];
        $totalFtthNewInstallation = 0;
        $totalFtthMt = 0;
        $totalDismantle = 0;
        $totalFttxIb = 0;

        foreach ($callsigns as $item) {
            $area = $item->branch;
            $callsign = $item->callsign;
            $type_wo = $item->type_wo;

            // Inisialisasi array jika belum ada
            if (!isset($pivotData[$callsign])) {
                $pivotData[$callsign] = [
                    'area' => $area,
                    'callsign' => $callsign,
                    'FTTH New Installation' => 0,
                    'FTTH Maintenance' => 0,
                    'FTTH Dismantle' => 0,
                    'FTTX New Installation' => 0,
                    'FTTX Maintenance' => 0,
                    'Total WO' => 0
                ];
            }

            // Tambahkan nilai total_wo ke type_wo yang sesuai
            $pivotData[$callsign][$type_wo] = $item->total_wo;

            if($type_wo == 'FTTH New Installation'){
                $totalFtthNewInstallation += $item->total_wo;
            }

            if($type_wo == 'FTTH Maintenance'){
                $totalFtthMt += $item->total_wo;
            }

            if($type_wo == 'FTTH Dismantle'){
                $totalDismantle += $item->total_wo;
            }

            if($type_wo == 'FTTX New Installation'){
                $totalFttxIb += $item->total_wo;
            }

            // Tambahkan ke total WO
            $pivotData[$callsign]['Total WO'] += $item->total_wo;
        }

        // return $pivotData;
        return view('fttx.assign-team.import', [
            'branches' => $branches,
            'leadCallsign' => $Leadcallsign,
            'akses' => $akses,
            'brImport' => $request->brImport,
            'callsigns' => $callsigns,
            'pivotData' => $pivotData,
            'totalFtthNewInstallation' => $totalFtthNewInstallation,
            'totalFtthMt' => $totalFtthMt,
            'totalDismantle' => $totalDismantle,
            'totalFttxIb' => $totalFttxIb,
        ]);
    }

    public function import()
    {
        $headings = (new HeadingRowImport())->toArray('users.xlsx');
    }

    public function importProsesDataSo(Request $request)
    {
        if ($request->hasFile('fileDataSO')) {
            $request->validate([
                'fileDataSO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            try {
                Excel::import(new AssignTeamFttxImport($akses), $request->file('fileDataSO'));

                return back()->with(['success' => 'Import Assign Team FTTX berhasil.']);
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                // dd($failures);
                $errorMessages = [];
                foreach ($failures as $failure) {
                    // dd($failure->values()[$failure->attribute()]);
                    $errorMessages[] = "Baris " . $failure->row() . " (" . $failure->attribute() . ") = " . "'" . $failure->values()[$failure->attribute()] . "'. ". implode(', ', $failure->errors());
                }

                return back()->with(['error' => 'Kesalahan validasi: ' . implode('<br>', $errorMessages)]);
            } catch (\Exception $e) {

                return back()->with(['error' => 'Kesalahan: ' . $e->getMessage()]);
            }
        }

        return back()->with(['error' => 'Tidak ada file yang diunggah.']);
    }

    public function getImportSoFttx(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_assign_team_fttx')->where('login', '=', $akses)->get();
            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-importWo" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-importWo mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }
}
