<?php

namespace App\Http\Controllers;

use App\Models\DataDistribusiTool;
use App\Models\DataPengembalianTool;
use App\Models\ToolIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KembaliToolController extends Controller
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


        return view('vTool.kembali_tool', ['leadCallsign' => $LeadDistribusi]);
    }

    public function getDataKembali(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('data_pengembalian_tools')->orderBy('tgl_kembali', 'DESC')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-kembali" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-kembali mb-0" >Detail</a>';
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

    public function getDetailKembali(Request $request)
    {
        // dd($request->all());
        $datas = DB::table('data_pengembalian_tools')
            ->where('id', $request->filDisId)->first();

        return response()->json($datas);
    }

    public function getRawDistribusi(Request $request)
    {

        $dataDis = DB::table('data_distribusi_tools')
            ->where('leadcall_id', $request->filLeadId)
            ->where('status_kembali', '=', 'Belum dikembalikan')
            ->get();

        $dataLead = DB::table('data_distribusi_tools')
            ->where('leadcall_id', $request->filLeadId)
            ->where('status_kembali', '=', 'Belum dikembalikan')->first();

        $listTim = DB::table('data_distribusi_tools')->where('leadcall_id', $request->filLeadId)
            ->select('callsign_tim_id', 'callsign_tim', 'nik_tim1', 'teknisi1', 'nik_tim2', 'teknisi2', 'nik_tim3', 'teknisi3')->distinct()->get();

        return response()->json(['dataDis' => $dataDis, 'callLead' => $dataLead, 'listTim' => $listTim]);
    }

    public function simpanPengembalian(Request $request)
    {
        $login = Auth::user()->name;
        $loginid = Auth::user()->id;

        $brg_id = $request->namaToolid;

        if ($request->hasFile('fotoKembaliTool')) {
            $fileFoto = $request->file('fotoKembaliTool');
            $file = $fileFoto->hashName();
            $request->file('fotoKembaliTool')->move(public_path('storage/image-pengembalian'), $file);
        } else {
            $file = 'foto-blank.jpg';
        }

        $simpanPengembalian = DataPengembalianTool::create([
            'id_dis' => $request['disId'],
            'tgl_kembali' => $request['tglPengembalian'],
            'tgl_distribusi' => $request['tglDistribusi'],
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
            'status_pengembalian' => "Pengembalian ke SPV",
            'keterangan' => $request['keterangan'],
            'foto_kembali' => $file,
            'login_id' => $loginid,
            'login' => $login,
        ]);

        if ($simpanPengembalian) {

            $dataDis = DataDistribusiTool::findOrFail($request->disId);
            $dataDis->update([
                'status_kembali' => "Sudah dikembalikan"

            ]);

            $toolDis = ToolIkr::find($brg_id);
            $toolDis->update([
                'status_distribusi' => "Stock",
                'kondisi' => $request['kondisi'],
                'posisi' => "Stock Branch"
            ]);
        }

        return redirect()->route('dataKembaliTool')->with(['success' => 'Data tersimpan.']);
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
