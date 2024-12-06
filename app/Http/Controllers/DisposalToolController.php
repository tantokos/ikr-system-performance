<?php

namespace App\Http\Controllers;

use App\Models\DataDisposalTool;
use App\Models\ToolIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Employee;

class DisposalToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('vTool.disposal_tool');
    }

    public function getSelectToolDisposal(Request $request)
    {
        $tool = DB::table('data_pengembalian_tools_gas as p')
            ->join('tool_ikrs as t','p.barang_id','=','t.id')
            ->where('t.status_distribusi', 'Not Distributed')
            ->where('t.posisi','Dikembalikan ke GA')
            ->select('t.id', 't.nama_barang', 't.merk_barang', 't.satuan', 't.spesifikasi', 'p.tgl_kembali', 't.kondisi', 't.kode_aset', 't.kode_ga', 'p.foto_kembali')
            ->orderBy('t.nama_barang')->get();

        return response()->json($tool);
    }

    public function simpanDisposal(Request $request)
    {
        $login = Auth::user()->name;
        $loginid = Auth::user()->id;

        $brg_id = $request->namaToolid;

        if ($request->hasFile('fotoToolDisposal')) {
            $fileFoto = $request->file('fotoToolDisposal');
            $file = $fileFoto->hashName();
            $request->file('fotoToolDisposal')->move(public_path('storage/image-disposal'), $file);
        } else {
            $file = 'default-150x150.png';
        }

        DB::beginTransaction();
        try {

            $simpan = DataDisposalTool::create([
                'no_disposal' => $request['noDisposal'],
                'tgl_disposal' => $request['tglDisposal'],
                'tool_id' => $request['namaToolid'],
                'foto_disposal' => $file,
                'login_id' => $loginid,
                'login' => $login,
            ]);

            if ($simpan) {
                $toolDis = ToolIkr::find($brg_id);
                $toolDis->update([
                    'status_distribusi' => "Not Distributed",
                    'posisi' => "Disposal"
                ]);
            }

            DB::commit();
            return redirect()->route('disposalTool')->with(['success' => 'Data tersimpan.']);

        } catch (\Exception $e) {
            DB::rollBack();

            if($file != 'default-150x150.png'){
                File::delete(public_path('storage/image-disposal/' . $file));
            }

            return redirect()->route('disposalTool')->with('error','Gagal menyimpan data: ' . $e->getMessage());

        }
        
    }

    public function getDataDisposal(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('data_disposal_tools as d')
                ->join('data_pengembalian_tools_gas as p','d.tool_id','=','p.barang_id')
                ->join('tool_ikrs as t','d.tool_id','=','t.id')
                ->select('d.id','d.tgl_disposal','d.no_disposal','d.tool_id','p.foto_kembali as foto_kembali_ga','d.foto_disposal', 
                        't.nama_barang', 't.merk_barang', 't.satuan', 't.spesifikasi', 't.kondisi', 't.kode_aset', 't.kode_ga')
                ->orderBy('d.tgl_disposal', 'DESC')->get();


            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-disposal" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-disposal mb-0" >Detail</a>';
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

    public function getDetailDisposal(Request $request)
    {
        // dd($request->all());
        $email_login = Auth::user()->email;
        $akses = Auth::user()->akses;
        // $data_login = Employee::where('email', $email_login)->first();

        $datas = DB::table('data_disposal_tools as d')
            ->join('data_pengembalian_tools_gas as p','d.tool_id','=','p.barang_id')
            ->join('tool_ikrs as t','d.tool_id','=','t.id')
            ->select('d.id','d.tgl_disposal','d.no_disposal','d.tool_id','p.foto_kembali as foto_kembali_ga','d.foto_disposal', 
                    'p.tgl_kembali',
                    't.nama_barang', 't.merk_barang', 't.satuan', 't.spesifikasi', 't.kondisi', 't.kode_aset', 't.kode_ga')
            ->where('d.id', $request->filDisId)
            ->orderBy('d.tgl_disposal', 'DESC')->first();

        return response()->json($datas);
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
