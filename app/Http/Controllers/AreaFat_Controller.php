<?php

namespace App\Http\Controllers;

use App\Models\listFat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AreaFat_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listBranch = DB::table('branches')
                ->distinct()
                ->orderBy('nama_branch')->get();

        return view('rootcause-fat.list_area_fat',['listBranch' => $listBranch]);
    }

    public function getListAreaFat(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {

            $datas = DB::table('list_fat')->orderBy('kode_area')->orderBy('kategori_area')->get();

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-areaFat" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-areaFat mb-0" >Edit</a>';
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

    public function getDetailAreaFat(Request $request)
    {
        
        $id = $request->filDisId;

        $dtRoot = DB::table('list_fat')->where('id', $id)->first();

        return response()->json($dtRoot);
    }

    public function simpanAreaFat(Request $request)
    {
        // dd($request->all());
        $kodeArea = strtoupper(trim($request->kodeArea));
        $cluster = Str::title(trim($request->cluster));
        $branch = strtoupper(trim($request->branch));
        $kotamadya = strtoupper(trim($request->kotamadya));
        $kotaPenagihan = strtoupper(trim($request->kotaPenagihan));
        $sitePenagihan = strtoupper(trim($request->sitePenagihan));
        $kategoriArea = strtoupper(trim($request->kategoriArea));

        $dtFat = DB::table('list_fat')
                ->whereRaw('UPPER(kode_area) = ?', [$kodeArea]) 
                // ->whereRaw('UPPER(cluster) = ?', [$cluster])
                ->whereRaw('UPPER(branch) = ?', [$branch])
                // ->whereRaw('UPPER(kotamadya) = ?', [$kotamadya]) 
                // ->whereRaw('UPPER(kotamadya_penagihan) = ?', [$kotaPenagihan])
                // ->whereRaw('UPPER(site) = ?', [$sitePenagihan])
                // ->whereRaw('UPPER(kategori_area) = ?', [$kategoriArea])
                ->get();

        // dd($dtFat);
        if(count($dtFat) > 0) {
            return back()->with(['error' => 'Data Kode FAT sudah terdaftar.']);
            // dd(count($dtRootCause));
        } else {

            DB::beginTransaction();

            try {
                listFat::create([
                    'kode_area' => $kodeArea,
                    'cluster' => $cluster,
                    'kotamadya' => Str::title(trim($request->kotamadya)),
                    'status_ms' => "Manage Service",
                    'branch' => Str::title(trim($request->branch)),
                    'site' => Str::title(trim($request->sitePenagihan)),
                    'kotamadya_penagihan' => Str::title(trim($request->kotaPenagihan)),
                    'kategori_area' => Str::title(trim($request->kategoriArea))
                ]);

                DB::commit();

                return redirect()->route('areaFat')->with(['success' => 'Data tersimpan.']);

            }catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('areaFat')->with('error','Gagal menyimpan data: ' . $e->getMessage());
            }
        } 

    }



    public function updateAreaFat(Request $request)
    {
        // dd($request->all());
        $id = $request->detid;
        $kodeArea = strtoupper(trim($request->kodeAreaEdit));
        $cluster = Str::title(trim($request->clusterEdit));
        $branch = strtoupper(trim($request->branchEdit));
        $kotamadya = strtoupper(trim($request->kotamadyaEdit));
        $kotaPenagihan = strtoupper(trim($request->kotaPenagihanEdit));
        $sitePenagihan = strtoupper(trim($request->sitePenagihanEdit));
        $kategoriArea = strtoupper(trim($request->kategoriAreaEdit));

        $dtFat = DB::table('list_fat')
                ->where('id','!=', $id)
                ->whereRaw('UPPER(kode_area) = ?', [$kodeArea]) 
                // ->whereRaw('UPPER(cluster) = ?', [$cluster])
                ->whereRaw('UPPER(branch) = ?', [$branch])
                // ->whereRaw('UPPER(kotamadya) = ?', [$kotamadya]) 
                // ->whereRaw('UPPER(kotamadya_penagihan) = ?', [$kotaPenagihan])
                // ->whereRaw('UPPER(site) = ?', [$sitePenagihan])
                // ->whereRaw('UPPER(kategori_area) = ?', [$kategoriArea])
                ->get();

        if(count($dtFat) > 0) {
            return back()->with(['error' => 'Data Kode FAT sudah terdaftar.']);
                    // dd(count($dtRootCause));
        } else {
        
            DB::beginTransaction();
            try {

                $listFat = DB::table('list_fat')->where('id', $id)
                    ->update([ // listFat::create([
                        'kode_area' => $kodeArea,
                        'cluster' => $cluster,
                        'kotamadya' => Str::title(trim($request->kotamadyaEdit)),
                        'status_ms' => "Manage Service",
                        'branch' => Str::title(trim($request->branchEdit)),
                        'site' => Str::title(trim($request->sitePenagihanEdit)),
                        'kotamadya_penagihan' => Str::title(trim($request->kotaPenagihanEdit)),
                        'kategori_area' => Str::title(trim($request->kategoriAreaEdit))
                ]);
                
                DB::commit();
                
                return back()->with(['success' => 'Berhasil Update Data Area FAT.']); 

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
