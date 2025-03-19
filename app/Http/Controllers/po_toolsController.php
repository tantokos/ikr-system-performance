<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\DataDistribusiTool;
use App\Models\DataPengecekanTool;
use App\Models\DataPengembalianTool;
use App\Models\DataPo;
use App\Models\DataPoDetail;
use App\Models\Employee;
use App\Models\ToolApprove;
use App\Models\ToolIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

use function PHPUnit\Framework\isNull;

class po_toolsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mail = Auth::user()->email;
        $can = Auth::user()->akses;
        $akses = Auth::user()->name;

        $login = Employee::where('email', $mail)
                ->leftJoin('branches', 'employees.branch_id','=','branches.id')
                ->select('nik_karyawan', 'nama_karyawan','departement','posisi','nama_branch','email')
                ->first();
        
        //get data karyawaan approval 1
        $loginApp1 = Employee::where('app1',"1")
                ->where('status_active','Aktif')->first();

        //get data karyawan approval 2
        $loginApp2 = Employee::where('app2',"1")
                ->where('status_active','Aktif')->first();

        $branch = Branch::select('id','nama_branch')
                ->whereNotIn('nama_branch', ['Apartemen','Underground'])
                ->get();
        
        $posisi = DB::table('tool_ikrs')
                ->select(DB::raw('
                    (case when posisi not in ("Supervisor","Dikembalikan ke GA","Disposal") then "Tim" 
                        else posisi end) as posisiTool'))
                ->distinct()->get();

        $callsign = DB::table('callsign_tims')
                ->select('callsign_tim')
                ->distinct()->get();

        $namaTool = DB::table('tool_name')
                ->distinct()->orderBy('nama_tool')->get();
        

        return view('vTool.po_tool',
                ['login' => $login, 'loginApp1' => $loginApp1, 
                'loginApp2' => $loginApp2,'branch' => $branch,
                'posisi' => $posisi, 'callsign' => $callsign, 'namaTool' => $namaTool, 'can' => $can, 'akses' => $akses]);
    }

    public function simpanPoTool(Request $request)
    {
        
        $login = $request->picInput;
        // dd(!empty($request->brg_id));
        $request->validate([
            'noPengajuan' => ['required', 'unique:data_pos,no_pengajuan'],
            'brg_id' => 'required',
        ],
        [
            'brg_id.required' => "Tidak ada data Tool di list"
        ]);

        // if (count($request->brg_id) > 0) {
        if(!empty($request->brg_id)) {

            DB::beginTransaction();

            try {

                // dd($request->all());
                $dataPurchase = DataPo::create([
                    'no_pengajuan' => strtoupper($request->noPengajuan),
                    'tgl' => $request->tgl,
                    'cost_center' => $request->costCenter,
                    'branch' => $request->branch,
                    'category' => $request->category,
                    'no_vendor' => $request->noVendor,
                    'login' => $login
                ]);

                if ($dataPurchase) {

                    for ($x = 0; $x < count($request->brg_id); $x++) {
                        $listProd = explode("|", $request->brg_id[$x]);
                        // dd($listProd);
                        $detailPurchase = DataPoDetail::create([
                            'no_pengajuan' => strtoupper($request->noPengajuan),
                            'br_id' => $x + 1,
                            // 'tool_id', 
                            'nama_br' => $listProd[0],
                            'merk_br' => $listProd[1],
                            'satuan_br' => $listProd[2],
                            'spesifikasi_br' => $listProd[3],
                            'qty' => $listProd[4],
                            'harga' => $listProd[5],
                            'login' => $login
                        ]);
                    }
                }

                DB::commit();
                return back()->with('success', "Data Tersimpan");
            
            } catch (\Throwable $th) {
                DB::rollBack();
                return back()->with('error', $th->getMessage());
            }
        } else {
            return back()->with('error', "Tidak ada data Tool");
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
