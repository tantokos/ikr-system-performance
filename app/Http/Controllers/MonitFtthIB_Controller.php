<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DataAssignTim;
use App\Models\Employee;
use App\Models\FtthIb;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MonitFtthIB_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('monitoringWo.monit_ftth_ib');
    }

    public function getDataIBOris(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        $datas = DB::table('data_ftth_ib_oris')->orderBy('tgl_ikr', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('no_wo', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id', $request->filcustId);
            }
            if($request->filtypeWo != null) {
                $datas = $datas->where('type_wo', $request->filtypeWo);
            }
            if($request->filarea != null) {
                $b = explode("|", $request->filarea);
                $br = $b[1];
                $datas = $datas->where('branch', $br);
            }
            if($request->filleaderTim != null) {
                $lt = explode("|", $request->filleaderTim);
                $ld = $lt[1];
                $datas = $datas->where('leader', $ld);
            }
            if($request->filcallsignTimid != null) {
                $fct = explode("|", $request->filcallsignTimid);
                $ct = $fct[1];
                $datas = $datas->where('callsign', $ct);
            }
            if($request->filteknisi != null) {
                $ftk = explode("|", $request->filteknisi );
                $nikTk = $ftk[0];
                $datas = $datas->where('tek1_nik', $nikTk)
                                ->orWhere('tek2_nik', $nikTk)
                                ->orWhere('tek3_nik', $nikTk)
                                ->orWhere('tek4_nik', $nikTk);
            }
            if($request->filcluster != null) {
                $datas = $datas->where('cluster', $request->filcluster);
            }
            if($request->filfatCode != null) {
                $datas = $datas->where('kode_fat', $request->filfatCode);
            }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time', $request->filslotTime);
            }

            $datas = $datas->get();

        if ($request->ajax()) {



            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('nama_cust', function ($nm) {
                    return Str::title($nm->nama_cust);
                })
                // ->editColumn('type_wo', function ($nm) {
                //     return Str::title($nm->type_wo);
                // })
                // ->editColumn('cluster', function ($nm) {
                //     return Str::title($nm->cluster);
                // })
                // ->editColumn('branch', function ($nm) {
                //     return Str::title($nm->branch);
                // })
                ->addColumn('action', function ($row) {
                    $btn = '
                        <a href="javascript:void(0)"
                        id="detail-assign"
                        data-id="' . $row->id . '"
                        class="btn btn-sm btn-primary detail-assign mb-0">
                        Detail
                        </a>
                        <a href="javascript:void(0)"
                        id="detail-material"
                        data-id="' . $row->id . '"
                        class="btn btn-sm btn-secondary detail-material mb-0">
                        Material
                        </a>';
                    return $btn;
                })

                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }

        // return response()->json($request->ajax());
    }

    public function getDetailWOFtthIB(Request $request)
    {
        $assignId = $request->filAssignId;
        $datas = DB::table('data_ftth_ib_oris as d')
            ->where('d.id', $assignId)->first();
        $callsign_tims = DB::table('callsign_tims')->get();
        $callsign_leads = DB::table('callsign_leads')->get();


        $wo_no = DB::table('data_ftth_ib_oris')->where('id', $assignId)->value('no_wo'); // contoh WO No

        // Mendapatkan data dari database seperti biasa
        $ftth_material = DB::table('ftth_ib_materials')
            ->select(
                'wo_no',
                'installation_date',
                'status_item',
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN description END AS merk_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN sn END AS sn_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%ONT%" THEN mac_address END AS mac_ont_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%STB%" THEN description END AS stb_merk_out'),
                DB::raw('CASE WHEN status_item = "OUT" AND description LIKE "%PRECON%" THEN description END AS precon_out'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%STB%" THEN description END AS stb_merk_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN description END AS merk_ont_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN sn END AS sn_ont_in'),
                DB::raw('CASE WHEN status_item = "IN" AND description LIKE "%ONT%" THEN mac_address END AS mac_ont_in')
            )
            ->where('wo_no', $wo_no)
            ->get()
            ->toArray(); // Konversi hasil query ke array

        // Fungsi untuk menggabungkan data dari beberapa array menjadi satu array
        function mergeFtthMaterials($materials) {
            $result = [];

            foreach ($materials as $material) {
                foreach ($material as $key => $value) {
                    // Jika key belum ada di $result atau nilainya masih null, isi dengan data baru
                    if (!isset($result[$key]) || $result[$key] === null) {
                        $result[$key] = $value;
                    }
                }
            }

            return $result;
        }

        // Gabungkan data ftth_material menjadi satu array
        $mergedMaterial = mergeFtthMaterials($ftth_material);

        // Mengirimkan response JSON
        return response()->json([
            'data' => $datas,
            'callsign_tims' => $callsign_tims,
            'callsign_leads' => $callsign_leads,
            'ftth_material' => $mergedMaterial
        ]);
    }

    public function getMaterialFtthIb(Request $request)
    {
        try {
            // Ambil assignId dari request
            $assignId = $request->filAssignId;

            // Ambil data dari tabel 'data_ftth_ib_oris' berdasarkan assignId
            $datas = DB::table('data_ftth_ib_oris as d')->where('d.id', $assignId)->first();

            // Jika tidak ditemukan, kembalikan respons error
            if (!$datas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found',
                ], 404);
            }

            // Ambil nomor WO berdasarkan assignId
            $wo_no = DB::table('data_ftth_ib_oris')->where('id', $assignId)->value('no_wo');

            // Ambil data material berdasarkan nomor WO
            $ftth_ib_material = DB::table('ftth_ib_materials')
                ->select(

                    'status_item',
                    'item_code',
                    'description',
                    'qty',
                    'sn',
                    'mac_address',
                )
                ->where('wo_no', $wo_no)
                ->get();

            // Kembalikan response dalam format JSON
            return response()->json([
                'success' => true,
                'message' => 'Data retrieved successfully',
                'data' => $ftth_ib_material,
            ], 200);

        } catch (\Exception $e) {
            // Tangani error dan kembalikan respons JSON
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function updateFtthIb(Request $request)
    {
        // dd($request->all());
        $aksesId = Auth::user()->id;
        $akses = Auth::user()->name;
        $id = $request->detId;

        $ftthIb = FtthIb::findOrFail($id);

        $updateFtthIb = $ftthIb->update([
            'type_wo' => $request['woTypeShow'],
            'no_wo' => $request['noWoShow'],
            'no_ticket' => $request['ticketNoShow'],
            'cust_id' => $request['custIdShow'],
            'nama_cust' => $request['custNameShow'],
            'cust_address1' => $request['custAddressShow'],
            'kode_fat' => $request['fatCodeShow'],
            'cluster' => $request['cluster'],
            'branch' => $request['branchShow'],
            'penagihan' => $request['penagihanShow'],
            'tgl_ikr' => $request['tglProgressShow'],
            'slot_time_leader' => $request['slotTimeLeaderShow'],
            'slot_time_apk' => $request['slotTimeAPKShow'],
            'sesi' => $request['sesiShow'],
            'leader' => $request['leaderShow'],
            'teknisi1' => $request['teknisi1Show'],
            'teknisi2' => $request['teknisi2Show'],
            'teknisi3' => $request['teknisi3Show'],
            'status_wo' => $request['statusWo'],
            'tgl_jam_reschedule' => $request['jamReschedule'],
            'tgl_reschedule' => $request['tglReschedule'],
            'reason_status' => $request['reasonStatus'],
            'remarks_teknisi' => $request['remarksTeknisi'],
            'weather' => $request['weatherShow'],
            'checkin_apk' => $request['checkinApkShow'],
            'checkout_apk' => $request['checkoutApkShow'],
            'status_apk' => $request['statusWoApk'],
            'wo_date_apk' => $request['WoDateShow'],
            'ont_merk_out' => $request['ont_merk_out'],
            'ont_sn_out' => $request['snOntOut'],
            'ont_merk_in' => $request['merkOntIn'],
            'ont_mac_in' => $request['macOntIn'],
            'router_sn_out' => $request['snRouterOut'],
            'router_mac_out' => $request['macRouterOut'],
            'router_merk_in' => $request['merkRouterIn'],
            'router_sn_in' => $request['snRouterIn'],
            'router_mac_in' => $request['macRouterIn'],
            'stb_merk_out' => $request['merkStbOut'],
            'stb_sn_out' => $request['snStbOut'],
            'stb_mac_out' => $request['macStbOut'],
            'stb_merk_in' => $request['merkStbIn'],
            'stb_sn_in' => $request['snStbIn'],
            'stb_mac_in' => $request['macStbIn'],
            'precon_out' => $request['kabelPrecon'],
            'leader_id' => $request['leaderidShow'],
            'callsign_id' => $request['callsign_id'],
            'alasan_pending' => $request['alasanPending'],
            'alasan_cancel' => $request['alasanCancel'],
            'is_checked' => $request['is_checked'],
            'login_id' => $aksesId,
            'login' => $akses,
        ]);

        if ($updateFtthIb) {
            return redirect()->route('monitFtthIB')->with(['success' => 'Data tersimpan.']);
        } else {
            return redirect()->route('monitFtthIB')->with(['error' => 'Gagal Simpan Data.']);
        }
    }

    public function getDetailCustId(Request $request)
    {

        $detail_customer = DB::table('v_history_customers')
        ->where('cust_id', $request->cust_id)
        ->get();

        if ($request->ajax()) {

            return DataTables::of($detail_customer)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->cust_id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
