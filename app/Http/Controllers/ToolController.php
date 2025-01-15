<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\DataDistribusiTool;
use App\Models\DataPengecekanTool;
use App\Models\DataPengembalianTool;
use App\Models\Employee;
use App\Models\ToolApprove;
use App\Models\ToolIkr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mail = Auth::user()->email;
        $can = Auth::user()->akses;

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
        

        return view('vTool.data_Tool',
                ['login' => $login, 'loginApp1' => $loginApp1, 
                'loginApp2' => $loginApp2,'branch' => $branch,
                'posisi' => $posisi, 'callsign' => $callsign, 'namaTool' => $namaTool, 'can' => $can]);
    }


    public function getCallsignBranch(Request $request)
    {
        $branch = $request->branch;

        $dtCallsign = DB::table('v_detail_callsign_tim')
            ->select('callsign_tim');

        if($branch !="ALL"){
            $dtCallsign = $dtCallsign->where('nama_branch',$branch);
        }

        $dtCallsign = $dtCallsign->orderBy('callsign_tim')->get();

        return response()->json($dtCallsign);

    }

    
    public function getRekapTool(Request $request)
    {
        // $RekapTool = DB::table('v_rekap_tool')->get();
        $RekapTool = DB::table('tool_ikrs')
                ->select(
                        DB::raw('(case posisi 
                                    when "Supervisor" then posisi
                                    when "Stock Branch" then posisi
                                    when "Dikembalikan ke GA" then posisi
                                    when "Disposal" then posisi
                                    else "Tim"
                                end) as posisiTool, 
                                count(if(kondisi="Baik",1,null)) as baik,
                                count(if(kondisi="Rusak",1,null)) as rusak,
                                count(if(kondisi="Hilang",1,null)) as hilang'))
                ->groupBy('posisiTool'); //->get();

        if($request->filBranch != "ALL"){
            $RekapTool = $RekapTool->where('branch_penerima',$request->filBranch);
        }

        if($request->filNamaTool != "ALL") {
            $RekapTool = $RekapTool->where('nama_barang', $request->filNamaTool);
        }

        if($request->filPosisi != "ALL"){
            if($request->filPosisi == "Tim") {
                $RekapTool = $RekapTool->whereNotIn('posisi',["Stock Branch","Dikembalikan ke GA","Disposal"]);
            } else {
                $RekapTool = $RekapTool->where('posisi',$request->filPosisi);
            }
            
        }
        if($request->filKondisi != "ALL"){
            $RekapTool = $RekapTool->where('kondisi',$request->filKondisi);
        }
        if($request->filCallsign != "ALL"){
            $RekapTool = $RekapTool->where('posisi',$request->filCallsign);
        }
        if($request->filApprove1 != "ALL"){
            $RekapTool = $RekapTool->where('approve1',$request->filApprove1);
        }
        if($request->filApprove2 != "ALL"){
            $RekapTool = $RekapTool->where('approve2',$request->filApprove2);
        }

        $RekapTool = $RekapTool->get();

        return response()->json($RekapTool);
    }


    public function getDataTool(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('tool_ikrs')->orderBy('nama_barang'); //->get();
        
        if($request->filBranch != "ALL"){
            $datas = $datas->where('branch_penerima',$request->filBranch);
        }

        if($request->filNamaTool != "ALL") {
            $datas = $datas->where('nama_barang', $request->filNamaTool);
        }

        if($request->filPosisi != "ALL"){
            if($request->filPosisi == "Tim") {
                $datas = $datas->whereNotIn('posisi',["Stock Branch","Dikembalikan ke GA","Disposal"]);
            } else {
                $datas = $datas->where('posisi',$request->filPosisi);
            }
            
        }
        if($request->filKondisi != "ALL"){
            $datas = $datas->where('kondisi',$request->filKondisi);
        }
        if($request->filCallsign != "ALL"){
            $datas = $datas->where('posisi',$request->filCallsign);
        }
        if($request->filApprove1 != "ALL"){
            $datas = $datas->where('approve1',$request->filApprove1);
        }
        if($request->filApprove2 != "ALL"){
            $datas = $datas->where('approve2',$request->filApprove2);
        }

        $datas = $datas->get();


        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('app1', function ($approve1) {
                    if($approve1->approve1 == "Submited") {
                        $ap1 = '
                        <span id="detail-app1" data-id="' . $approve1->id . '" class="badge text-bg-warning text-xs" style="cursor:pointer">' . $approve1->approve1 . '</span>';
                    }elseif($approve1->approve1 == "Reject") {
                        $ap1 = '
                        <span id="detail-app1" data-id="' . $approve1->id . '" class="badge text-bg-danger text-xs" style="cursor:pointer">' . $approve1->approve1 . '</span>';
                    }elseif($approve1->approve1 == "Approved") {
                        $ap1 = '
                        <span id="detail-app1" data-id="' . $approve1->id . '" class="badge text-bg-success text-xs" style="cursor:pointer">' . $approve1->approve1 . '</span>';
                    }else {
                        $ap1 = $approve1->approve1;
                    }

                    return $ap1;
                })
                ->addColumn('app2', function ($approve2) {
                    if($approve2->approve2 == "Submited") {
                        $ap2 = '
                        <span id="detail-app2" data-id="' . $approve2->id . '" class="badge text-bg-warning text-xs" style="cursor:pointer">' . $approve2->approve2 . '</span>';
                    }elseif($approve2->approve2 == "Reject") {
                        $ap2 = '
                        <span id="detail-app2" data-id="' . $approve2->id . '" class="badge text-bg-danger text-xs" style="cursor:pointer">' . $approve2->approve2 . '</span>';
                    }elseif($approve2->approve2 == "Approved") {
                        $ap2 = '
                        <span id="detail-app2" data-id="' . $approve2->id . '" class="badge text-bg-success text-xs" style="cursor:pointer">' . $approve2->approve2 . '</span>';
                    }else {
                        $ap2 = $approve2->approve2;
                    }

                    return $ap2;
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-tool" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-tool mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action','app1','app2'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function getDetailRekap_click(Request $request)
    {
        // $RekapTool = DB::table('v_rekap_tool')->get();
        $click = explode("|",$request->filClick);
        $clickPosisi = $click[0];
        $clickKondisi = $click[1];
        $filBranch = $click[2];
        $filNamaTool = $click[3];
        $filCallsign = $click[4];
        $filApprove1 = $click[5];
        $filApprove2 = $click[6];

        if($clickKondisi == "Subtotal"){
            $branchList = DB::table('tool_ikrs')->select(DB::raw('branch_penerima, departement, count(*) as jml'))
                    // ->where('posisi', $clickPosisi)
                    // ->where('kondisi', $clickKondisi)
                    ->groupBy('branch_penerima','departement')->orderBy('jml','DESC');

            $RekapTool = DB::table('tool_ikrs')->select(DB::raw('nama_barang, count(*) as jml'))
                // ->where('posisi', $clickPosisi)
                // ->where('kondisi', $clickKondisi)
                ->groupBy('nama_barang')->orderBy('jml','DESC'); //->get();
        
            $RekapToolBranch = DB::table('tool_ikrs')->select(DB::raw('branch_penerima, departement, nama_barang, count(*) as jml'))
                // ->where('posisi', $clickPosisi)
                // ->where('kondisi', $clickKondisi)
                ->groupBy('branch_penerima', 'departement', 'nama_barang')->orderBy('jml','DESC'); //->get();

            $listTool = DB::table('tool_ikrs');
                // ->where('posisi', $clickPosisi)
                // ->where('kondisi', $clickKondisi);
                // ->groupBy('nama_barang'); //->get();
        } else {

            $branchList = DB::table('tool_ikrs')->select(DB::raw('branch_penerima, departement, count(*) as jml'))
                    // ->where('posisi', $clickPosisi)
                    ->where('kondisi', $clickKondisi)
                    ->groupBy('branch_penerima','departement')->orderBy('jml','DESC');

            $RekapTool = DB::table('tool_ikrs')->select(DB::raw('nama_barang, count(*) as jml'))
                // ->where('posisi', $clickPosisi)
                ->where('kondisi', $clickKondisi)
                ->groupBy('nama_barang')->orderBy('jml','DESC'); //->get();
        
            $RekapToolBranch = DB::table('tool_ikrs')->select(DB::raw('branch_penerima, departement, nama_barang, count(*) as jml'))
                // ->where('posisi', $clickPosisi)
                ->where('kondisi', $clickKondisi)
                ->groupBy('branch_penerima','departement', 'nama_barang')->orderBy('jml','DESC'); //->get();

            $listTool = DB::table('tool_ikrs')
                // ->where('posisi', $clickPosisi)
                ->where('kondisi', $clickKondisi);
                // ->groupBy('nama_barang'); //->get();
        }
        
        if($clickPosisi=="Tim"){
            $branchList = $branchList->whereNotIn('posisi',['Stock Branch','Dikembalikan ke GA','Disposal']);
            $RekapTool = $RekapTool->whereNotIn('posisi',['Stock Branch','Dikembalikan ke GA','Disposal']);
            $RekapToolBranch = $RekapToolBranch->whereNotIn('posisi',['Stock Branch','Dikembalikan ke GA','Disposal']);
            $listTool = $listTool->whereNotIn('posisi',['Stock Branch','Dikembalikan ke GA','Disposal']);
        } else {
            $RekapTool = $RekapTool->where('posisi', $clickPosisi);
            $RekapToolBranch = $RekapToolBranch->where('posisi', $clickPosisi);
            $branchList = $branchList->where('posisi', $clickPosisi);
            $listTool = $listTool->where('posisi', $clickPosisi);
        }

        if($filBranch != "ALL"){
            $RekapTool = $RekapTool->where('branch_penerima',$filBranch);
            $RekapToolBranch = $RekapToolBranch->where('branch_penerima',$filBranch);
            $branchList = $branchList->where('branch_penerima',$filBranch);
            $listTool = $listTool->where('branch_penerima',$filBranch);
        }

        if($filNamaTool != "ALL") {
            $RekapTool = $RekapTool->where('nama_barang', $filNamaTool);
            $RekapToolBranch = $RekapToolBranch->where('nama_barang', $filNamaTool);
            $branchList = $branchList->where('nama_barang', $filNamaTool);
            $listTool = $listTool->where('nama_barang', $filNamaTool);
        }

        if($filCallsign != "ALL"){
            $RekapTool = $RekapTool->where('posisi',$filCallsign);
            $RekapToolBranch = $RekapToolBranch->where('posisi',$filCallsign);
            $branchList = $branchList->where('posisi',$filCallsign);
            $listTool = $listTool->where('posisi',$filCallsign);
        }
        if($filApprove1 != "ALL"){
            $RekapTool = $RekapTool->where('approve1',$filApprove1);
            $RekapToolBranch = $RekapToolBranch->where('approve1',$filApprove1);
            $branchList = $branchList->where('approve1',$filApprove1);
            $listTool = $listTool->where('approve1',$filApprove1);
        }
        if($filApprove2 != "ALL"){
            $RekapTool = $RekapTool->where('approve2',$filApprove2);
            $RekapToolBranch = $RekapToolBranch->where('approve2',$filApprove2);
            $branchList = $branchList->where('approve2',$filApprove2);
            $listTool = $listTool->where('approve2',$filApprove2);
        }

        $RekapTool = $RekapTool->get();
        $RekapToolBranch = $RekapToolBranch->get();
        $branchList = $branchList->get();
        $listTool = $listTool->get();

        return response()->json(['rekapTool' => $RekapTool, 'rekapToolBranch' => $RekapToolBranch, 'branchList' => $branchList, 'listTool' => $listTool]);
    }

    public function simpanTool(Request $request)
    {

        if ($request->kodeAset != '-') {
            if (Str::upper($request->kodeAset) != "NO CODING") {
                // dd($request->kodeAset, $request->all());
                $request->validate([
                    'kodeAset' => 'unique:tool_ikrs,kode_aset',
                ]);
            }
            
        }

        if ($request->kodeGA != '-') {
            if (Str::upper($request->kodeGA) != "NO CODING") {
                // dd($request->kodeAset, $request->all());
                $request->validate([
                    'kodeGA' => 'unique:tool_ikrs,kode_ga',
                ]);
            }
            
        }

        // if ($request->kode_aset != 'No Coding') {
        //     $request->validate([
        //         'kodeAset' => 'unique:tool_ikrs,kode_aset',
        //     ]);
        // }

        // if ($request->kode_ga != '-' || $request->kode_ga != 'No Coding') {
        //     $request->validate([
        //         'kodeGA' => 'unique:tool_ikrs,kode_ga',
        //     ]);
        // }

        // if ($request->kode_ga != 'No Coding') {
        //     $request->validate([
        //         'kodeGA' => 'unique:tool_ikrs,kode_ga',
        //     ]);
        // }


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

        DB::beginTransaction();
        try {

            ToolIkr::create([
                'nama_barang' => $request['namaTool'],
                'merk_barang' => $request['merk'],
                'spesifikasi' => $request['spesifikasi'],
                'kode_aset' => Str::upper($request['kodeAset']),
                'kode_ga' => Str::upper($request['kodeGA']),
                'kondisi' => $request['kondisi'],
                'satuan' => $request['satuan'],
                'jumlah' => 0,
                'kategori' => 'Tools',
                'tgl_pengadaan' => $request['tglPenerimaan'],
                'foto_barang' => $file,
                'nik_penerima' => $request['nikpenerima'],
                'nama_penerima' => $request['namapenerima'],
                'branch_penerima' => $request['namaBranch'],
                'departement' => $request['departemen'],
                'approve1' => 'Submited',
                'approve2' => 'Submited',
                'status_distribusi' => 'Stock',
                'posisi' => "Stock Branch",
                'login' => $login,
            ]);

            DB::commit();

            return redirect()->route('dataTool')->with(['success' => 'Data tersimpan.']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dataTool')->with('error','Gagal menyimpan data: ' . $e->getMessage());
        }
    }

    public function updateTool(Request $request)
    {

        if ($request->kodeAsetShow != '-') {
            if (Str::upper($request->kodeAsetShow) != "NO CODING") {
                $request->validate([
                    'kodeAsetShow' => 'unique:tool_ikrs,kode_aset,'.$request->namaToolShowId,
                ]);
            }
        }

        if ($request->kodeGAShow != '-') {
            if (Str::upper($request->kodeGAShow) != "NO CODING") {
                $request->validate([
                    'kodeGAShow' => 'unique:tool_ikrs,kode_ga,'.$request->namaToolShowId,
                ]);
            }
            
        }

        $request->validate([
            'namaToolShow' => 'required',
            'merkShow' => 'required',
            'kondisiShow' => 'required',
            'satuanShow' => 'required',
        ]);

        $login = Auth::user()->name;

        $dtToolOld = DB::table('tool_ikrs')->where('id', $request->namaToolShowId)->first();

        if ($request->hasFile('fotoToolShow')) {
            $fileFoto = $request->file('fotoToolShow');
            $file = $fileFoto->hashName();
            $request->file('fotoToolShow')->move(public_path('storage/image-tool'), $file);

        } else {
            $file = $dtToolOld->foto_barang;
        }

        DB::beginTransaction();
        try {

            // $dtToolOld = DB::table('tool_ikrs')->where('id', $request->namaToolShowId)->first();
            $dtTool = ToolIkr::findOrFail($request->namaToolShowId);
            
            if(Auth::user()->akses == "SA") {
                $dtTool->update([
                    'nama_barang' => $request['namaToolShow'],
                    'merk_barang' => $request['merkShow'],
                    'spesifikasi' => $request['spesifikasiShow'],
                    'kode_aset' => Str::upper($request['kodeAsetShow']),
                    'kode_ga' => Str::upper($request['kodeGAShow']),
                    'kondisi' => $request['kondisiShow'],
                    'satuan' => $request['satuanShow'],
                    'tgl_pengadaan' => $request['tglPenerimaanShow'],
                    'foto_barang' => $file,
                    'approve1' => $dtToolOld->approve1,
                    'approve2' => $dtToolOld->approve2,
                ]);

                $dtDis = DataDistribusiTool::where('barang_id', $request->namaToolShowId)
                        ->update([
                            'nama_barang' => $request['namaToolShow'],
                            'merk_barang' => $request['merkShow'],
                            // 'kondisi' => $request['kondisiShow'],
                            'satuan' => $request['satuanShow'],
                            'kode_aset' => Str::upper($request['kodeAsetShow']),
                            'kode_ga' => Str::upper($request['kodeGAShow']),
                            'spesifikasi' => $request['spesifikasiShow'],                    
                        ]);

                $dtkmbli = DataPengembalianTool::where('barang_id', $request->namaToolShowId)
                        ->update([
                            'nama_barang' => $request['namaToolShow'],
                            'merk_barang' => $request['merkShow'],
                            // 'kondisi' => $request['kondisiShow'],
                            'satuan' => $request['satuanShow'],
                            'kode_aset' => Str::upper($request['kodeAsetShow']),
                            'kode_ga' => Str::upper($request['kodeGAShow']),
                            'spesifikasi' => $request['spesifikasiShow'],                    
                        ]);

                $dtlap = DataPengecekanTool::where('barang_id', $request->namaToolShowId)
                        ->update([
                            'nama_barang' => $request['namaToolShow'],
                            'merk_barang' => $request['merkShow'],
                            // 'kondisi' => $request['kondisiShow'],
                            'satuan' => $request['satuanShow'],
                            'kode_aset' => Str::upper($request['kodeAsetShow']),
                            'kode_ga' => Str::upper($request['kodeGAShow']),
                            'spesifikasi' => $request['spesifikasiShow'],                    
                        ]);
            } else {
                $dtTool->update([
                    'nama_barang' => $request['namaToolShow'],
                    'merk_barang' => $request['merkShow'],
                    'spesifikasi' => $request['spesifikasiShow'],
                    'kode_aset' => Str::upper($request['kodeAsetShow']),
                    'kode_ga' => Str::upper($request['kodeGAShow']),
                    'kondisi' => $request['kondisiShow'],
                    'satuan' => $request['satuanShow'],
                    'tgl_pengadaan' => $request['tglPenerimaanShow'],
                    'foto_barang' => $file,
                    'approve1' => 'Submited',
                    'approve2' => 'Submited',
                ]);
            }            

            DB::commit();

            if($request->hasFile('fotoToolShow')){
                if($dtToolOld->foto_barang != 'default-150x150.png'){
                    File::delete(public_path('storage/image-tool/' . $dtToolOld->foto_barang));
                }
            }

            return redirect()->route('dataTool')->with(['success' => 'Data tersimpan.']);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('dataTool')->with('error','Gagal menyimpan data: ' . $e->getMessage());
        }

    }

    public function simpanApproval(Request $request)
    {
        $akses = Auth::user()->name;
        $aksesId = Auth::user()->id;
        $toolId = $request->namaToolApp1Id;
        $toolId2 = $request->namaToolApp2Id;

        // dd($request->all());

        switch ($request->input('action')) {
            case 'Approve1':
                
                DB::beginTransaction();
                try {

                    $dtApprove = ToolApprove::create([
                        'br_id' => $request->namaToolApp1Id,
                        'tgl_approve' => $request->tglApp1,
                        'jenis_approve' => "Approve1",
                        'status_approve' => $request->statusApp1,
                        'ket_approve' => $request->keteranganApp1,
                        'login_approve' => $aksesId
                    ]);

                    if($dtApprove) {
                        // $dtTool = DB::table('tool_ikrs')->where('id', $toolId)->first();
                        $dtTool = ToolIkr::findOrFail($toolId);
                        $dtTool->update([
                            'approve1' => $request->statusApp1,
                        ]);
                    };

                    DB::commit();
                    // return redirect()->route('dataTool')->with(['success' => 'Berhasil update Persetujuan 1']);
                    return response()->json('success');

                } catch (\Exception $e) {
                    // Rollback jika ada kesalahan
                    DB::rollback();
                    // return redirect()->route('dataTool')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
                    return response()->json($e->getMessage());
                }

                break;

            case 'Approve2':

                DB::beginTransaction();
                try {

                    $dtApprove = ToolApprove::create([
                        'br_id' => $request->namaToolApp2Id,
                        'tgl_approve' => $request->tglApp2,
                        'jenis_approve' => "Approve2",
                        'status_approve' => $request->statusApp2,
                        'ket_approve' => $request->keteranganApp2,
                        'login_approve' => $aksesId
                    ]);

                    if($dtApprove) {
                        // $dtTool = DB::table('tool_ikrs')->where('id', $toolId)->first();
                        $dtTool = ToolIkr::findOrFail($toolId2);
                        $dtTool->update([
                            'approve2' => $request->statusApp2,
                        ]);
                    };

                    DB::commit();
                    // return redirect()->route('dataTool')->with(['success' => 'Berhasil update Persetujuan 1']);
                    return response()->json('success');

                } catch (\Exception $e) {
                    // Rollback jika ada kesalahan
                    DB::rollback();
                    // return redirect()->route('dataTool')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
                    return response()->json($e->getMessage());
                }

                break;
            }

    }

    public function showDetailTool(Request $request)
    {
        $detTool = DB::table('tool_ikrs')
                ->leftJoin('employees','tool_ikrs.nik_penerima','=','employees.nik_karyawan')
                ->select('tool_ikrs.*','employees.nik_karyawan', 'employees.nama_karyawan','employees.departement','employees.posisi')->where('tool_ikrs.id', $request->filToolId)
            ->first();

        if(Auth::user()->akses == "SA") {
            $detTool->approve1 = "Submited";
        }

        return response()->json($detTool);
    }

    public function getRiwayatApprove(Request $request)
    {
        $idTool = $request->tid;
        if($request->app=="app1") {
            $dtRw = DB::table('tool_approves as ta')
                ->leftJoin('users as u','ta.login_approve','u.id')
                ->leftJoin('employees as e', 'u.email','e.email')
                ->select('ta.*', 'e.nama_karyawan')
                ->where('jenis_approve',"Approve1")
                ->where('ta.br_id',$idTool)->orderBy('tgl_approve', 'DESC')->get();
        }
        if($request->app=="app2") {
            $dtRw = DB::table('tool_approves as ta')
                ->leftJoin('users as u','ta.login_approve','u.id')
                ->leftJoin('employees as e', 'u.email','e.email')
                ->select('ta.*', 'e.nama_karyawan')
                ->where('jenis_approve',"Approve2")
                ->where('ta.br_id',$idTool)->orderBy('tgl_approve', 'DESC')->get();
        }

        if ($request->ajax()) {
        
            // $dtRw = DataDistribusiTool::where('barang_id', $idTool)->get();
            // $dtRw = DB::table('v_history_tools')->where('barang_id', $idTool)->get();
        
            return DataTables::of($dtRw)
                    ->addIndexColumn() //memberikan penomoran
                    ->addColumn('action', function ($row) {
                            $btn = '
                            <a href="javascript:void(0)" id="dis-detail" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-tool mb-0" >Detail</a>';
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
