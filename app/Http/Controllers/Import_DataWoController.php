<?php

namespace App\Http\Controllers;

use App\Imports\AssignWoImport;
use App\Models\DataAssignTim;
use App\Models\Employee;
use App\Models\ImportAssignTim;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class Import_DataWoController extends Controller
{
    public function index(Request $request)
    {
        $akses = Auth::user()->name;
        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $jmlData = DB::table('import_assign_tims')->where('login', '=', $akses)->count('login');

        return view('assign.import-DataWO', ['branches' => $branches, 'leadCallsign' => $Leadcallsign, 'akses' => $akses, 'brImport' => $request->brImport]);
    }

    public function importProsesDataWo(Request $request)
    {

        if ($request->hasFile('fileDataWO')) {

            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->name;

            Excel::import(new AssignWoImport($akses), request()->file('fileDataWO'));

            return back();
        }
    }

    public function getDataImportWo(Request $request)
    {

        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_assign_tims')->where('login', '=', $akses)->orderBy('fat_code')->get();
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

    public function getDetailImport(Request $request)
    {
        // dd($request->all());
        $wo_id = $request->filWoId;
        $datas = DB::table('import_assign_tims as d')
            ->where('d.id', $wo_id)->first();

        $tim = Employee::whereIn('posisi', ['Installer', 'Maintenance'])
            ->select('nik_karyawan', 'nama_karyawan')
            ->orderBy('nama_karyawan')
            ->get();

        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $callTim = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim_id', 'callsign_tim')->distinct()
            ->orderBy('callsign_tim')->get();

        return response()->json(['data' => $datas, 'tim' => $tim, 'LeadCall' => $Leadcallsign, 'callTim' => $callTim]);
    }

    public function simpanImportWo(Request $request)
    {
        $akses = Auth::user()->name;

        switch ($request->input('action')) {

            case 'simpan':

                if ($request->branchImport) {
                    $branchRq = explode('|', $request->branchImport);
                    $branchId = $branchRq[0];
                    $branch = $branchRq[1];
                } else {
                    $branch = "";
                }

                $dtImportAssign = ImportAssignTim::whereNotNull('callsign')
                    ->select(
                        'batch_wo',
                        'tgl_ikr',
                        'slot_time',
                        'jenis_wo',
                        'wo_no',
                        'ticket_no',
                        'wo_date',
                        'cust_id',
                        'name',
                        'cust_phone',
                        'cust_mobile',
                        'address',
                        'area',
                        'wo_type',
                        'fat_code',
                        'fat_port',
                        'remarks',
                        'vendor_installer',
                        'ikr_date',
                        'time',
                        'branch_id',
                        'branch',
                        'leadcall_id',
                        'leadcall',
                        'leader_id',
                        'leader',
                        'callsign_id',
                        'callsign',
                        'tek1_nik',
                        'teknisi1',
                        'tek2_nik',
                        'teknisi2',
                        'tek3_nik',
                        'teknisi3',
                        'tek4_nik',
                        'teknisi4',
                        'login_id',
                        'login'
                    )
                    ->where('branch', $branch)
                    ->where('login', $akses)
                    ->get()->toArray();

                $simpanImportWo = DataAssignTim::insert($dtImportAssign);

                if ($simpanImportWo) {
                    return redirect()->route('assignTim')->with(['success' => 'Data tersimpan.']);
                    ImportAssignTim::where('login', '=', $akses)->delete();
                } else {
                    return redirect()->route('assignTim')->with(['error' => 'Gagal Simpan Data.']);
                }

                break;

            case 'batal':
                ImportAssignTim::where('login', '=', $akses)->delete();
                return redirect()->route('assignTim');

                break;
        }
    }


    public function updateImportWo(Request $request)
    {
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $imp_id = $request->detId;

        if ($request->branchShow) {
            $ReqBranch = explode('|', $request->branchShow);
            $branchId = $ReqBranch[0];
            $branchNm = $ReqBranch[1];
        }

        if ($request->LeadCallsignShow) {
            $ReqLeadCall = explode('|', $request->LeadCallsignShow);
            $leadCallId = $ReqLeadCall[0];
            $leadCall = $ReqLeadCall[1];
            $leaderId = $ReqLeadCall[2];
            $leader = $ReqLeadCall[3];
        } else {
            $leadCallId = $request->LeadCallsignShow;
            $leadCall = $request->LeadCallsignShow;
            $leaderId = $request->leaderidShow;
            $leader = $request->leaderShow;
        }

        if ($request->teknisi1Show) {
            $ReqTek1 = explode('|', $request->teknisi1Show);
            $tek1Nk = $ReqTek1[0];
            $tek1 = $ReqTek1[1];
        } else {
            $tek1Nk = $request->teknisi1Show;
            $tek1 = $request->teknisi1Show;
        }

        if ($request->teknisi2Show) {
            $ReqTek2 = explode('|', $request->teknisi2Show);
            $tek2Nk = $ReqTek2[0];
            $tek2 = $ReqTek2[1];
        } else {
            $tek2Nk = $request->teknisi2Show;
            $tek2 = $request->teknisi2Show;
        }

        if ($request->teknisi3Show) {
            $ReqTek3 = explode('|', $request->teknisi3Show);
            $tek3Nk = $ReqTek3[0];
            $tek3 = $ReqTek3[1];
        } else {
            $tek3Nk = $request->teknisi3Show;
            $tek3 = $request->teknisi3Show;
        }

        if ($request->teknisi4Show) {
            $ReqTek4 = explode('|', $request->teknisi4Show);
            $tek4Nk = $ReqTek4[0];
            $tek4 = $ReqTek4[1];
        } else {
            $tek4Nk = $request->teknisi4Show;
            $tek4 = $request->teknisi4Show;
        }

        if ($request->callsignTimidShow) {
            $ReqCallsign = explode('|', $request->callsignTimidShow);
            $callsignId = $ReqCallsign[0];
            $callsign = $ReqCallsign[1];
        } else {
            $callsignId = $request->callsignTimidShow;
            $callsign = $request->callsignTimidShow;
        }

        $dataImport = ImportAssignTim::findOrFail($imp_id);

        $updateImportWo = $dataImport->update([
            'batch_wo' => $request['sesiShow'],
            'tgl_ikr' => $request['tglProgressShow'],
            'slot_time' => $request['slotTimeShow'],
            'jenis_wo' => $request['jenisWoShow'],
            'branch_id' => $branchId,
            'branch' => $branchNm,
            'leadcall_id' => $leadCallId,
            'leadcall' => $leadCall,
            'leader_id' => $leaderId,
            'leader' => $leader,
            'callsign_id' => $callsignId,
            'callsign' => $callsign,
            'tek1_nik' => $tek1Nk,
            'teknisi1' => $tek1,
            'tek2_nik' => $tek2Nk,
            'teknisi2' => $tek2,
            'tek3_nik' => $tek3Nk,
            'teknisi3' => $tek3,
            'tek4_nik' => $tek4Nk,
            'teknisi4' => $tek4,
            'login_id' => $aksesId,
            'login' => $akses
        ]);

        if ($updateImportWo) {
            return response()->json(['success' => 'Data tersimpan.', 'brImport' => $request->branchShow]);
        } else {
            return response()->json(['error' => 'Gagal Simpan Data.', 'brImport' => $request->branchShow]);
        }
    }
}
