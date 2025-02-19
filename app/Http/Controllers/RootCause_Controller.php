<?php

namespace App\Http\Controllers;

use App\Models\RootCouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class RootCause_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listPenagihan = DB::table('root_couse_penagihan')
                ->select('penagihan')->distinct()
                ->orderBy('penagihan')->get();

        return view('rootcause-fat.list_rootcause',['listPenagihan' => $listPenagihan]);
    }

    public function getListRootCause(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('root_couses')->orderBy(DB::raw('case when status_wo ="Done" then 1
                                                                    when status_wo ="Pending" then 2
                                                                    when status_wo ="Cancel" then 3 end'))->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-root" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-root mb-0" >Edit</a>';
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

    public function getDetailRootCause(Request $request)
    {
        
        $id = $request->filDisId;

        $dtRoot = DB::table('root_couses')->where('id', $id)->first();

        return response()->json($dtRoot);
    }

    public function simpanRootCause(Request $request)
    {
        // dd($request->all());
        $statWo = trim($request->status_wo);
        $causeCode = strtoupper(trim($request->causeCode));
        $rootcause = strtoupper(trim($request->rootcause));
        $actionTaken = strtoupper(trim($request->actionTaken));
        $penagihan = strtoupper(trim($request->penagihan));

        $dtRootCause = DB::table('root_couses')
                ->whereRaw('status_wo = ?', [$statWo]) 
                ->whereRaw('UPPER(couse_code) = ?', [$causeCode])
                ->whereRaw('UPPER(root_couse) = ?', [$rootcause]) 
                ->whereRaw('UPPER(action_taken) = ?', [$actionTaken])
                ->whereRaw('UPPER(rootcouse_penagihan) = ?', [$penagihan])
                ->get();

        if(count($dtRootCause) > 0) {
            return back()->with(['error' => 'Data Root Cause sudah terdaftar.']);
            // dd(count($dtRootCause));
        } else {

            DB::beginTransaction();

            try {
                RootCouse::create([
                    'status_wo' => $statWo,
                    'couse_code' => $causeCode,
                    'root_couse' => $rootcause,
                    'action_taken' => $actionTaken,
                    'rootcouse_penagihan' => $penagihan,        
                    'status_active' => "Aktif"
                ]);

                DB::commit();

                return redirect()->route('rootCause')->with(['success' => 'Data tersimpan.']);

            }catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('rootCause')->with('error','Gagal menyimpan data: ' . $e->getMessage());
            }
        } 

        return back()->with(['success' => 'Simpan data rootcause berhasil.']);

    }

    public function updateRootCause(Request $request)
    {
        // dd($request->all());
        $id = $request->detid;
        $statWo = trim($request->status_woEdit);
        $causeCode = strtoupper(trim($request->causeCodeEdit));
        $rootcause = strtoupper(trim($request->rootcauseEdit));
        $actionTaken = strtoupper(trim($request->actionTakenEdit));
        $penagihan = strtoupper(trim($request->penagihanEdit));

        $dtRootCause = DB::table('root_couses')
                ->where('id','!=', $id)
                ->whereRaw('status_wo = ?', [$statWo]) 
                ->whereRaw('UPPER(couse_code) = ?', [$causeCode])
                ->whereRaw('UPPER(root_couse) = ?', [$rootcause]) 
                ->whereRaw('UPPER(action_taken) = ?', [$actionTaken])
                ->whereRaw('UPPER(rootcouse_penagihan) = ?', [$penagihan])
                ->get();

        if(count($dtRootCause) > 0) {
            return back()->with(['error' => 'Data sudah terdaftar.']); 
        } else {

            DB::beginTransaction();
            try {
                $rootCause = DB::table('root_couses')->where('id', $id)
                            ->update([
                                'status_wo' => $statWo,
                                'couse_code' => $causeCode,
                                'root_couse' => $rootcause,
                                'action_taken' => $actionTaken,
                                'rootcouse_penagihan' => $penagihan,
                                'status_active' => "Aktif"
                            ]);
                
                DB::commit();
                
                return back()->with(['success' => 'Berhasil Update Data Root Cause.']); 

            } catch (\Throwable $th) {
                DB::rollBack();
                return back()->with(['error' => 'Gagal Update data. ' . $th->getMessage()]); 
            }
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
