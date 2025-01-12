<?php

namespace App\Http\Controllers;

use App\Models\DataDistribusiTool;
use App\Models\DataPengembalianTool;
use App\Models\DataPengembalianToolsGa;
use App\Models\Employee;
use App\Models\ToolIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class KembaliToolGA_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $loginId = Auth::user()->id;
        $loginEmail = Auth::user()->email;

        $dtLog = Employee::where('email',$loginEmail)
                ->select('nik_karyawan','nama_karyawan')
                ->first();

        return view('vTool.kembaliTool_GA',['dtlog' => $dtLog]);
    }

    public function getDataKembaliGA(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('data_pengembalian_tools_gas')->orderBy('tgl_kembali', 'DESC')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-kembaliGA" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-kembaliGA mb-0" >Detail</a>';
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

    public function getDetailKembaliGA(Request $request)
    {
        // dd($request->all());
        $datas = DB::table('data_pengembalian_tools_gas')
            ->where('id', $request->filDisId)->first();

        return response()->json($datas);
    }

    public function getRawTool(Request $request)
    {

        $dataDis = DB::table('tool_ikrs')
            ->where('status_distribusi', '=', 'Stock')
            ->whereNotIn('posisi', ['Dikembalikan ke GA'])
            ->orderBy('nama_barang')
            ->get();

        return response()->json(['dataDis' => $dataDis]);
    }

    public function simpanPengembalianGA(Request $request)
    {
        $login = Auth::user()->name;
        $loginMail = Auth::user()->email;
        $loginid = Auth::user()->id;

        $brg_id = $request->namaToolid;
        $pengembali = explode("|", $request->nikPengembalian);
        $nikPengembali = $pengembali[0];
        $namaPengembali = $pengembali[1];

        if ($request->hasFile('fotoKembaliTool')) {
            $fileFoto = $request->file('fotoKembaliTool');
            $file = $fileFoto->hashName();
            $request->file('fotoKembaliTool')->move(public_path('storage/image-pengembalianGA'), $file);
        } else {
            $file = 'foto-blank.jpg';
        }

        $simpanPengembalian = DataPengembalianToolsGa::create([
            'tgl_pengadaan' => $request['tglPengadaan'],
            'tgl_kembali' => $request['tglPengembalian'],
            'barang_id' => $request['namaToolid'],
            'nama_barang' => $request['namaTool'],
            'merk_barang' => $request['merk'],
            'kondisi' => $request['kondisi'],
            'satuan' => $request['satuan'],
            'kode_aset' => $request['kodeAset'],
            'kode_ga' => $request['kodeGA'],
            'spesifikasi' => $request['spesifikasi'],
            'status_pengembalian' => $request['statPengembalian'],
            'keterangan' => $request['keterangan'],
            'nik_pengembalian' => $nikPengembali,
            'nama_pengembalian' => $namaPengembali,
            'foto_kembali' => $file,
            'login_id' => $loginid,
            'login' => $login,
        ]);

        if ($simpanPengembalian) {

            $toolDis = ToolIkr::find($brg_id);
            $toolDis->update([
                'status_distribusi' => "Return GA",
                'kondisi' => $request['kondisi'],
                'posisi' => "Dikembalikan ke GA"
            ]);
        }

        return redirect()->route('dataKembaliToolGA')->with(['success' => 'Data tersimpan.']);
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
