<?php

namespace App\Http\Controllers\FTTX;

use App\Http\Controllers\Controller;
use App\Imports\AssignTeamFttxImport;
use App\Models\DataAssignTimFttx;
use App\Models\ImportAssignTeamFttx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Yajra\DataTables\Facades\DataTables;

class ImportAssignTeamFttxController extends Controller
{
    public function index(Request $request)
    {
        $akses = Auth::user()->name;
        $Leadcallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        $jmlData = DB::table('import_assign_team_fttx')->where('login', '=', $akses)->count('login');

        $callsigns = DB::table('import_assign_team_fttx')
        ->select('callsign', 'wo_type', 'branch_id','branch', DB::raw('count(*) as total_wo'))
        ->groupBy('callsign','wo_type','branch_id', 'branch')
        ->orderBy('branch_id')
        ->orderBy('callsign')
        ->get();


        $pivotData = [];
        $totalFtthNewInstallation = 0;
        $totalFtthMt = 0;
        $totalDismantle = 0;
        $totalFttxIb = 0;
        $totalFttxMt = 0;
        $totalFttx = 0;

        foreach ($callsigns as $item) {
            $area = $item->branch;
            $callsign = $item->callsign;
            $wo_type = $item->wo_type;

            // Inisialisasi array jika belum ada
            if (!isset($pivotData[$callsign])) {
                $pivotData[$callsign] = [
                    'area' => $area,
                    'callsign' => $callsign,
                    'FTTX New Installation' => 0,
                    'FTTX Maintenance' => 0,
                    'Total WO' => 0
                ];
            }

            // Tambahkan nilai total_wo ke type_wo yang sesuai
            $pivotData[$callsign][$wo_type] = $item->total_wo;

            if($wo_type == 'FTTX New Installation'){
                $totalFttxIb += $item->total_wo;
            }

            if($wo_type == 'FTTX Maintenance'){
                $totalFttxMt += $item->total_wo;
            }

            $totalFttx += $item->total_wo;
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
            'totalFttxIb' => $totalFttxIb,
            'totalFttxMt' => $totalFttxMt,
            'totalFttx' => $totalFttx,
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

        $datas = DB::table('import_assign_team_fttx')->where('login', '=', $akses)->get();

        if ($request->ajax()) {

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

    public function simpanImportWoFttx(Request $request)
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

                //get data import assign tim,
                $dtImportAssign = ImportAssignTeamFttx::whereNotNull('callsign')
                    ->select(
                        'no_so',
                        'so_date',
                        'customer_name',
                        'address',
                        'pic_customer',
                        'phone_pic_cust',
                        'wo_type',
                        'product',
                        'remark_ewo',
                        'cid',
                        'segment_sales',
                        'area',
                        'jadwal_ikr',
                        'slot_time_jadwal',
                        'remark_for_ikr',
                        'status_penjadwalan',
                        'vendor',
                        'branch_id',
                        'branch',
                        'leadcall_id',
                        'leadcall',
                        'leader_id',
                        'leader',
                        'callsign_id',
                        'callsign',
                        'tek1_nik',
                        'tim_1',
                        'tek2_nik',
                        'tim_2',
                        'tek3_nik',
                        'tim_3',
                        'tek4_nik',
                        'tim_4',
                        'nopol',
                        'perubahan_slot_time_tele',
                        'checkin',
                        'checkout',
                        'status_wo',
                        'keterangan_wo',
                        'login_id',
                        'login',
                    )
                    ->where('login', $akses)
                    ->get()->toArray();

                //get data callsign tim dari data import assign tim, sebagai acuan untuk update callsign tim di data assign tim
                $dtImportCallsign = ImportAssignTeamFttx::whereNotNull('callsign')
                    ->select(
                        'jadwal_ikr', 'branch', 'leadcall_id', 'leadcall', 'leader_id','leader',
                        'callsign_id', 'callsign', 'tek1_nik', 'tim_1', 'tek2_nik', 'tim_2',
                        'tek3_nik', 'tim_3', 'tek4_nik', 'tim_4', 'login_id','login'
                    )
                    ->where('login', $akses)
                    ->distinct()->get()->toArray();


                if (count($dtImportAssign) > 0) {

                    DB::beginTransaction();

                    try {

                        $doubleAssign = [];

                        foreach ($dtImportAssign as $data) {
                            $cekDoubleAssign = DataAssignTimFttx::where('no_so', $data['no_so'])
                                ->where('jadwal_ikr', $data['jadwal_ikr'])
                                ->first();

                            //update callsign jika wo sudah pernah di import/ sudah ada di data assign tim
                            if ($cekDoubleAssign) {
                                array_push($doubleAssign, $data['no_so']);

                                $updateDtAssign = DataAssignTimFttx::where('no_so', $data['no_so'])->where('jadwal_ikr', $data['jadwal_ikr'])
                                                ->update([
                                                    'slot_time_jadwal' => $data['slot_time_jadwal'],
                                                    'branch_id' => $data['branch_id'],
                                                    'branch' => $data['branch'],
                                                    'leadcall_id' => $data['leadcall_id'],
                                                    'leadcall' => $data['leadcall'],
                                                    'leader_id' => $data['leader_id'],
                                                    'leader' => $data['leader'],
                                                    'callsign_id' => $data['callsign_id'],
                                                    'callsign' => $data['callsign'],
                                                    'tek1_nik' => $data['tek1_nik'],
                                                    'tim_1' => $data['tim_1'],
                                                    'tek2_nik' => $data['tek2_nik'],
                                                    'tim_2' => $data['tim_2'],
                                                    'tek3_nik' => $data['tek3_nik'],
                                                    'tim_3' => $data['tim_3'],
                                                    'tek4_nik' => $data['tek4_nik'],
                                                    'tim_4' => $data['tim_4']
                                                ]);
                            }

                        }

                        //update callsign di data assign tim
                        foreach ($dtImportCallsign as $impCallsign ) {
                            $updateDtCallsign = DataAssignTimFttx::where('jadwal_ikr', $impCallsign['jadwal_ikr'])
                                    ->where('callsign', $impCallsign['callsign'])
                                    ->update(['leadcall_id' => $impCallsign['leadcall_id'],
                                                'leadcall' => $impCallsign['leadcall'],
                                                'leader_id' => $impCallsign['leader_id'],
                                                'leader' => $impCallsign['leader'],
                                                'callsign_id' => $impCallsign['callsign_id'],
                                                'callsign' => $impCallsign['callsign'],
                                                'tek1_nik' => $impCallsign['tek1_nik'],
                                                'tim_1' => $impCallsign['tim_1'],
                                                'tek2_nik' => $impCallsign['tek2_nik'],
                                                'tim_2' => $impCallsign['tim_2'],
                                                'tek3_nik' => $impCallsign['tek3_nik'],
                                                'tim_3' => $impCallsign['tim_3'],
                                                'tek4_nik' => $impCallsign['tek4_nik'],
                                                'tim_4' => $impCallsign['tim_4']
                                            ]);

                        }

                        //get data WO baru dari import assign tim
                        $dtImportAssign2 = ImportAssignTeamFttx::whereNotIn('no_so', $doubleAssign)
                            ->select(
                                'no_so',
                                'so_date',
                                'customer_name',
                                'address',
                                'pic_customer',
                                'phone_pic_cust',
                                'wo_type',
                                'product',
                                'remark_ewo',
                                'cid',
                                'segment_sales',
                                'area',
                                'jadwal_ikr',
                                'slot_time_jadwal',
                                'remark_for_ikr',
                                'status_penjadwalan',
                                'vendor',
                                'branch_id',
                                'branch',
                                'leadcall_id',
                                'leadcall',
                                'leader_id',
                                'leader',
                                'callsign_id',
                                'callsign',
                                'tek1_nik',
                                'tim_1',
                                'tek2_nik',
                                'tim_2',
                                'tek3_nik',
                                'tim_3',
                                'tek4_nik',
                                'tim_4',
                                'nopol',
                                'perubahan_slot_time_tele',
                                'checkin',
                                'checkout',
                                'status_wo',
                                'keterangan_wo',
                                'login_id',
                                'login',
                            )
                            ->whereNotNull('callsign')
                            ->where('login', $akses)
                            ->get()
                            ->toArray();

                        // Insert data yang valid/tidak double ke data_assign_tims
                        DataAssignTimFttx::insert($dtImportAssign2);

                        // Hapus data sementara yang sudah diproses
                        ImportAssignTeamFttx::where('login', $akses) //whereNotIn('no_wo_apk', $doubleAssign)
                            ->delete();

                        DB::commit();

                        // Cek apakah ada duplikasi
                        // if (count($doubleAssign) > 0) {
                        //     $warningMessage = 'Beberapa No WO sudah ada di assign tim: ' . implode(', ', $doubleAssign);
                        //     return redirect()->route('assignTim')
                        //         ->with(['success' => 'Data tersimpan sebagian.'. $warningMessage])
                        //         ->with(['warning' => $warningMessage]);
                        // } else {
                        //     return redirect()->route('assignTim')
                        //         ->with(['success' => 'Data tersimpan.']);
                        // }

                        return redirect()->route('fttx-assign-team')
                                ->with(['success' => 'Data tersimpan.']);
                    } catch (\Exception $e) {

                        DB::rollBack();
                        // dd($kdArea);
                        return redirect()->route('fttx.import.assign-team')
                            ->with(['error' => 'Gagal Simpan Data: ' . $e->getMessage()]);
                    }
                } else {
                    return redirect()->route('fttx.import.assign-team')
                        ->with(['error' => 'Data WO tidak ada assign tim.']);
                }
                break;

            case 'batal':
                $importedData = DB::table('import_assign_team_fttx')->where('login', $akses)
                    ->delete();
                // ImportAssignTeamFttx::where('login', $akses)->delete();
                return redirect()->route('fttx-assign-team');
                break;
        }
    }
}
