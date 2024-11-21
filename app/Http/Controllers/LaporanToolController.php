<?php

namespace App\Http\Controllers;

use App\Models\DataPengecekanTool;
use App\Models\ToolIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class LaporanToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $LeadDistribusi = DB::table('data_distribusi_tools')
            ->where('status_kembali', '=', 'Belum dikembalikan')
            ->select('leadcall_id', 'lead_callsign', 'leader_id', 'leader', 'posisi', 'area')
            ->groupBy('leadcall_id', 'lead_callsign', 'leader_id', 'leader', 'posisi', 'area')
            ->orderBy('lead_callsign')->get();

        return view('vTool.laporan_tool', ['leadCallsign' => $LeadDistribusi]);
    }

    public function getDataPengecekan(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('data_pengecekan_tools')->orderBy('tgl_pengecekan', 'DESC')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-cek" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-kembali mb-0" >Detail</a>';
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

    public function getDetailCek(Request $request)
    {
        // dd($request->all());
        $datas = DB::table('data_pengecekan_tools as dc')
            ->leftJoin('data_distribusi_tools as dd', 'dc.id_dis', '=', 'dd.id')
            ->select('dc.*', 'dd.tgl_distribusi')
            ->where('dc.id', $request->filDisId)->first();

        return response()->json($datas);
    }

    public function getRawDistribusi(Request $request)
    {

        $dataDis = DB::table('v_history_tools')
            ->where('leadcall_id', $request->filLeadId)
            ->whereRaw('((kategory="Data Distribusi" and status_kembali="Belum dikembalikan") or kategori="Data Pengecekan"')
            ->get();

        $dataLead = DB::table('data_distribusi_tools')
            ->where('leadcall_id', $request->filLeadId)
            ->where('status_kembali', '=', 'Belum dikembalikan')->first();

        $listTim = DB::table('data_distribusi_tools')->where('leadcall_id', $request->filLeadId)
            ->select('callsign_tim_id', 'callsign_tim', 'nik_tim1', 'teknisi1', 'nik_tim2', 'teknisi2', 'nik_tim3', 'teknisi3')->distinct()->get();

        return response()->json(['dataDis' => $dataDis, 'callLead' => $dataLead, 'listTim' => $listTim]);
    }

    public function simpanPengecekan(Request $request)
    {
        $login = Auth::user()->name;
        $loginid = Auth::user()->id;

        $brg_id = $request->namaToolid;

        if ($request->hasFile('fotoCekTool')) {
            $fileFoto = $request->file('fotoCekTool');
            $file = $fileFoto->hashName();
            $request->file('fotoCekTool')->move(public_path('storage/image-laporan'), $file);
        } else {
            $file = 'foto-blank.jpg';
        }

        $simpanPengecekan = DataPengecekanTool::create([
            'id_dis' => $request['disId'],
            'tgl_pengecekan' => $request['tglPengecekan'],
            'barang_id' => $request['namaToolid'],
            'nama_barang' => $request['namaTool'],
            'merk_barang' => $request['merk'],
            'kondisi' => $request['kondisi'],
            'satuan' => $request['satuan'],
            'kode_aset' => $request['kodeAset'],
            'kode_ga' => $request['kodeGA'],
            'spesifikasi' => $request['spesifikasi'],
            'leadcall_id' => $request['LeadCallsignTim'],
            'lead_callsign' => $request['leadCallsign'],
            'leader_id' => $request['leaderid'],
            'leader' => $request['leaderTim'],
            'posisi' => $request['posisiTim'],
            'callsign_tim_id' => $request['callsignTimid'],
            'callsign_tim' => $request['callsignTim'],
            'area' => $request['areaTim'],
            'nik_tim1' => $request['teknisi1Nk'],
            'teknisi1' => $request['teknisi1'],
            'nik_tim2' => $request['teknisi2Nk'],
            'teknisi2' => $request['teknisi2'],
            'nik_tim3' => $request['teknisi3Nk'],
            'teknisi3' => $request['teknisi3'],
            'nik_tim4' => $request['teknisi4Nk'],
            'teknisi4' => $request['teknisi4'],
            'status_pengecekan' => "Pengecekan Tool",
            'keterangan' => $request['keterangan'],
            'foto_pengecekan' => $file,
            'login_id' => $loginid,
            'login' => $login,
        ]);

        if ($simpanPengecekan) {

            $toolDis = ToolIkr::find($brg_id);
            $toolDis->update([
                // 'status_distribusi' => "Distribusi ke IKR",
                'kondisi' => $request['kondisi']
            ]);
        }

        return redirect()->route('laporanTool')->with(['success' => 'Data tersimpan.']);
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
