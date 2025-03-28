<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\DataAssignTim;
use App\Models\DataFtthMtFotoapk;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class MonitFotoFtthMT_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('monitoringFotoAPK.monitFoto_ftth_mt');
    }

    
    public function getMonitFotoFtthMT(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('data_ftth_mt_fotoapks')
                // ->where('branch', 'Jakarta Timur')
                // ->whereMonth('tgl_ikr', '9')
                // ->select(
                //     'id',
                //     'tgl_ikr',
                //     'no_wo',
                //     'wo_date_apk',
                //     'cust_id',
                //     'nama_cust',
                //     'kode_fat',
                //     'type_wo',
                //     'kode_fat',
                //     'cluster',
                //     'branch',
                //     'slot_time_leader',
                //     'callsign',
                //     'leader',
                //     'teknisi1',
                //     'teknisi2',
                //     'teknisi3',
                //     'status_wo'
                // )
                ->orderBy('tgl_ikr', 'DESC')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('name', function ($nm) {
                    return Str::title($nm->name);
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
                    <a href="javascript:void(0)" id="detail-validasi" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-validasi mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }

        // return response()->json($request->ajax());
    }

    public function getDetailFotoFtthMT(Request $request)
    {
        // dd($request);
        $assignId = $request->filAssignId;
        $datas = DB::table('data_ftth_mt_fotoapks as d')
            ->where('d.id', $assignId)->first();

        return response()->json(['data' => $datas]);
    }

    public function saveValidasi(Request $request)
    {
        $detId = $request->detId;
        $dataValidasi = DataFtthMtFotoapk::find($detId);

        $dataValidasi->update([
            'val_material' => $request->valMaterial,
        'val_sn_mac' => $request->valSnMac,
        'val_rootcause' => $request->valRootCause,
        'val_input_foto' => $request->valfoto,
        'val_ttd' => $request->valTtd,
        'cek_fat' => $request->cekFat,
        'cek_marker' => $request->cekMarker,
        ]);

        return back()->with(['success' => true, 'message' => 'Data berhasil di update.']);
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
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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
