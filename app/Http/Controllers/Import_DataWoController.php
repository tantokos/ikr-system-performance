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

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            Excel::import(new AssignWoImport($akses), request()->file('fileDataWO'));

            return back()->with(['success' => 'Import Work Order berhasil.']);
        }
    }

    public function getDataImportWo(Request $request)
    {

        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_assign_tims')->where('login', '=', $akses)->orderBy('fat_code_apk')->get();
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

                if ($request->branchShow) {
                    $branchRq = explode('|', $request->branchShow);
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
                        'type_wo',
                        'no_wo_apk',
                        'no_ticket_apk',
                        'wo_date_apk',
                        'cust_id_apk',
                        'name_cust_apk',
                        'cust_phone_apk',
                        'cust_mobile_apk',
                        'address_apk',
                        'area_cluster_apk',
                        'wo_type_apk',
                        'fat_code_apk',
                        'fat_port_apk',
                        'remarks_apk',
                        'vendor_installer_apk',
                        'ikr_date_apk',
                        'time_apk',
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
                    // ->where('branch', $branch)
                    ->where('login', $akses)
                    ->get()->toArray();

                // dd($dtImportAssign);

                if (count($dtImportAssign) > 0) {
                    $doubleAssign = [];

                    foreach ($dtImportAssign as $data) {
                        $cekDoubleAssign = DataAssignTim::where('no_wo_apk', $data['no_wo_apk'])
                            ->where('tgl_ikr', $data['tgl_ikr'])
                            ->first();

                        if ($cekDoubleAssign) {
                            array_push($doubleAssign, $cekDoubleAssign->wo_no);
                        }
                    }

                    $dtImportAssign2 = ImportAssignTim::whereNotIn('no_wo_apk', $doubleAssign)
                    ->select(
                        'batch_wo',
                        'tgl_ikr',
                        'slot_time',
                        'type_wo',
                        'no_wo_apk',
                        'no_ticket_apk',
                        'wo_date_apk',
                        'cust_id_apk',
                        'name_cust_apk',
                        'cust_phone_apk',
                        'cust_mobile_apk',
                        'address_apk',
                        'area_cluster_apk',
                        'wo_type_apk',
                        'fat_code_apk',
                        'fat_port_apk',
                        'remarks_apk',
                        'vendor_installer_apk',
                        'ikr_date_apk',
                        'time_apk',
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
                        'login',
                    )
                        ->whereNotNull('callsign')
                        ->where('login', $akses)
                        ->get()
                        ->toArray();

                    // dd($dtImportAssign2);

                    DB::beginTransaction();

                    try {
                        // Insert ke data_assign_tims
                        DataAssignTim::insert($dtImportAssign2);

                        // Insert ke data_ftth_mt_oris
                        foreach ($dtImportAssign2 as $data) {
                            DB::table('data_ftth_mt_oris')->insert([
                                'sesi' => $data['batch_wo'],
                                'tgl_ikr' => $data['tgl_ikr'],
                                'type_wo' => $data['type_wo'],
                                'no_wo' => $data['no_wo_apk'],
                                'no_ticket' => $data['no_ticket_apk'],
                                'wo_date_apk' => $data['wo_date_apk'],
                                'cust_id' => $data['cust_id_apk'],
                                'nama_cust' => $data['name_cust_apk'],
                                'cust_address1' => $data['address_apk'],
                                'cluster' => $data['area_cluster_apk'],
                                'wo_type_apk' => $data['wo_type_apk'],
                                'kode_fat' => $data['fat_code_apk'],
                                'type_maintenance' => $data['remarks_apk'],
                                'slot_time_leader' => $data['slot_time'],
                                'slot_time_apk' => $data['time_apk'],
                                'branch_id' => $data['branch_id'],
                                'branch' => $data['branch'],
                                'leadcall_id' => $data['leadcall_id'],
                                'leadcall' => $data['leadcall'],
                                'leader_id' => $data['leader_id'],
                                'leader' => $data['leader'],
                                'callsign_id' => $data['callsign_id'],
                                'callsign' => $data['callsign'],
                                'tek1_nik' => $data['tek1_nik'],
                                'teknisi1' => $data['teknisi1'],
                                'tek2_nik' => $data['tek2_nik'],
                                'teknisi2' => $data['teknisi2'],
                                'tek3_nik' => $data['tek3_nik'],
                                'teknisi3' => $data['teknisi3'],
                                'tek4_nik' => $data['tek4_nik'],
                                'teknisi4' => $data['teknisi4'],
                            ]);
                        }

                        // Hapus data dari ImportAssignTim
                        ImportAssignTim::whereNotIn('no_wo_apk', $doubleAssign)
                            ->where('login', $akses)
                            ->delete();

                        DB::commit();

                        if (count($doubleAssign) > 0) {
                            return redirect()->route('importDataWo')
                                ->with(['success' => 'Sebagian Data tersimpan. Cek data assign WO yang sama']);
                        } else {
                            return redirect()->route('assignTim')
                                ->with(['success' => 'Data tersimpan.']);
                        }
                    } catch (\Exception $e) {
                        DB::rollBack();
                        return $e->getMessage();
                        return redirect()->route('importDataWo')
                            ->with(['error' => 'Gagal Simpan Data: ' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->route('importDataWo')
                        ->with(['error' => 'Data WO tidak ada assign tim.']);
                }
                break;

            case 'batal':
                ImportAssignTim::where('login', $akses)->delete();
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
            'type_wo' => $request['jenisWoShow'],
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
