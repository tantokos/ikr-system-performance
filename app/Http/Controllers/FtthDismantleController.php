<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class FtthDismantleController extends Controller
{
    public function index()
    {
        return view('ftth-dismantle.index');
    }

    public function getFtthDismantle(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        $datas = DB::table('data_ftth_dismantle_oris')->orderBy('visit_date', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('visit_date',[$startDt, $endDt]);
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

    public function getDetailFtthDismantle(Request $request)
    {
        $assignId = $request->filAssignId;
        $datas = DB::table('data_ftth_dismantle_oris as d')
            ->where('d.id', $assignId)->first();
        $callsign_tims = DB::table('callsign_tims')->get();
        $callsign_leads = DB::table('callsign_leads')->get();


        // Mengirimkan response JSON
        return response()->json([
            'data' => $datas,
            'callsign_tims' => $callsign_tims,
            'callsign_leads' => $callsign_leads,
        ]);

    }

    public function getMaterialFtthDismantle(Request $request)
    {
        try {
            // Ambil assignId dari request
            $assignId = $request->filAssignId;

            // Ambil data dari tabel 'data_ftth_dismantle_oris' berdasarkan assignId
            $datas = DB::table('data_ftth_dismantle_oris as d')->where('d.id', $assignId)->first();

            // Jika tidak ditemukan, kembalikan respons error
            if (!$datas) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found',
                ], 404);
            }

            // Ambil nomor WO berdasarkan assignId
            $wo_no = DB::table('data_ftth_dismantle_oris')->where('id', $assignId)->value('no_wo');

            // Ambil data material berdasarkan nomor WO
            $ftth_ib_material = DB::table('ftth_dismantle_materials')
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
}
