<?php

namespace App\Http\Controllers;

use App\Models\DataDistribusiTool;
use App\Models\ToolIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('vTool.data_Tool');
    }

    public function getDataTool(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('tool_ikrs')->orderBy('nama_barang')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-tool" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-tool mb-0" >Detail</a>';
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

    public function simpanTool(Request $request)
    {

        if ($request->kode_aset != '-') {
            $request->validate([
                'kodeAset' => 'unique:tool_ikrs,kode_aset',
            ]);
        }

        if ($request->kode_ga != '-') {
            $request->validate([
                'kodeGA' => 'unique:tool_ikrs,kode_ga',
            ]);
        }


        $request->validate([
            'namaTool' => 'required',
            'merk' => 'required',
            'kondisi' => 'required',
            'satuan' => 'required',
        ]);


        $login = Auth::user()->name;


        if ($request->hasFile('fotoTool')) {
            $fileFoto = $request->file('fotoTool');
            $file = $fileFoto->hashName();
            $request->file('fotoTool')->move(public_path('storage/image-tool'), $file);
        } else {
            $file = 'default-150x150.png';
        }

        ToolIkr::create([
            'nama_barang' => $request['namaTool'],
            'merk_barang' => $request['merk'],
            'spesifikasi' => $request['spesifikasi'],
            'kode_aset' => $request['kodeAset'],
            'kode_ga' => $request['kodeGA'],
            'kondisi' => $request['kondisi'],
            'satuan' => $request['satuan'],
            'jumlah' => 0,
            'kategori' => 'Tools',
            'tgl_pengadaan' => $request['tglPenerimaan'],
            'foto_barang' => $file,
            'login' => $login,

        ]);

        return redirect()->route('dataTool')->with(['success' => 'Data tersimpan.']);
    }

    public function showDetailTool(Request $request)
    {
        $detTool = DB::table('tool_ikrs')->where('id', $request->filToolId)
            ->first();

        return response()->json($detTool);
    }

    public function getRiwayatTool(Request $request)
    {

        $idTool = $request->tid;

        if ($request->ajax()) {

            // $dtRw = DataDistribusiTool::where('barang_id', $idTool)->get();
            $dtRw = DB::table('v_history_tools')->where('barang_id', $idTool)->get();

            return DataTables::of($dtRw)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="dis-detail" data-id="' . $row->id . '|' . $row->kategori .  '" class="btn btn-sm btn-primary detail-tool mb-0" >Detail</a>';
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

    public function getDataShowTool(Request $request)
    {
        //
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
