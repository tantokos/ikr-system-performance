<?php

namespace App\Http\Controllers;

use App\Imports\MaterialDismantleImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Yajra\DataTables\Facades\DataTables;

class ImportMaterialDismantleController extends Controller
{
    public function index()
    {
        $akses = Auth::user()->name;
        $leadCallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        return view('ftth-dismantle.import_dismantle_material', compact('akses', 'leadCallsign', 'branches'));
    }

    public function import()
    {
        $headings = (new HeadingRowImport())->toArray('users.xlsx');
    }

    public function importDismantleProsesMaterial(Request $request, Excel $excel)
    {
        if ($request->hasFile('fileDataWO'))
        {
            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            try {
                Excel::import(new MaterialDismantleImport($akses), $request->file('fileDataWO'));
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                foreach ($failures as $failure) {
                    $failure->row();
                    $failure->attribute();
                    $failure->errors();
                    $failure->values();
                }
            }

            return back()->with(['success' => 'Import Material Dismantle berhasil']);
        }
    }

    public function getDataImportMaterialDismantle(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_ftth_dismantle_materials')
                ->get();

            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return '<a href="javascript:void(0)" id="detail-importMaterial"
                                data-id="' . $row->id . '"
                                class="btn btn-sm btn-primary detail-importMaterial mb-0">Detail</a>';
                })
                ->rawColumns(['action'])
                ->escapeColumns([])
                ->toJson();
        }

        return response()->json(['message' => 'Invalid request'],400);
    }

    public function storeDismantleMaterial(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':
                $importedData = DB::table('import_ftth_dismantle_materials')->get();

                DB::beginTransaction();
                try {
                    foreach ($importedData as $data) {
                        // Cek apakah data dengan wo_no dan installation_date yang sama sudah ada


                        // Insert data baru jika tidak ada duplikat
                        DB::table('ftth_dismantle_materials')->insert([
                            'wo_no' => $data->wo_no,
                            'wo_date' => $data->wo_date,
                            'installation_date' => $data->installation_date,
                            'vendor_installer' => $data->vendor_installer,
                            'callsign' => $data->callsign,
                            'area' => $data->area,
                            'warehouse' => $data->warehouse,
                            'cust_id' => $data->cust_id,
                            'name' => $data->name,
                            'wo_type' => $data->wo_type,
                            'remarks' => $data->remarks,
                            'status' => $data->status,
                            'status_item' => $data->status_item,
                            'item_code' => $data->item_code,
                            'description' => $data->description,
                            'qty' => $data->qty,
                            'sn' => $data->sn,
                            'mac_address' => $data->mac_address,
                            'material_condition' => $data->material_condition,
                            'login' => $akses,
                        ]);
                    }

                    // Commit transaksi jika tidak ada kesalahan
                    DB::table('import_ftth_dismantle_materials')->delete();
                    DB::commit();
                    return redirect()->route('importFtthDismantle')->with('success', 'Data berhasil disimpan.');
                } catch (\Exception $e) {
                    // Rollback jika ada kesalahan
                    DB::rollback();
                    return redirect()->route('importFtthDismantle')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
                }
                break;

            case 'batal':
                DB::table('import_ftth_dismantle_materials')->delete();
                return redirect()->route('importFtthDismantle')->with('success', 'Material berhasil dibatalkan.');
                break;
        }
    }
}
