<?php

namespace App\Http\Controllers;

use App\Imports\MaterialIbImport;
use App\Imports\MaterialImport;
use App\Models\FtthIbMaterial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\HeadingRowImport;
use Yajra\DataTables\Facades\DataTables;

class ImportIbMaterialController extends Controller
{
    public function index()
    {
        $akses = Auth::user()->name;
        $leadCallsign = DB::table('v_detail_callsign_tim')->select('lead_call_id', 'lead_callsign', 'leader_id', 'nama_leader', 'nama_branch')
            ->orderBy('lead_callsign')->orderBy('branch_id')
            ->groupBy('lead_call_id', 'lead_callsign', 'nama_branch')->get();

        $branches = DB::table('branches')->whereNotIn('nama_branch', ['Apartemen', 'Underground'])->get();

        return view('ftth-ib.import_ib_material', compact('akses', 'leadCallsign', 'branches'));
    }

    public function import()
    {
        $headings = (new HeadingRowImport)->toArray('users.xlsx');
    }

    public function importIbProsesMaterial(Request $request, Excel $excel)
    {
        if ($request->hasFile('fileDataWO'))
        {
            $request->validate([
                'fileDataWO' => ['required', 'mimes:xlsx,xls,csv']
            ]);

            $akses = Auth::user()->id . "|" . Auth::user()->name;

            try {
                $excel->import(new MaterialIbImport($akses), $request->file('fileDataWO'));
            } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
                $failures = $e->failures();
                foreach ($failures as $failure) {
                    $failure->row();
                    $failure->attribute();
                    $failure->errors();
                    $failure->values();
                }
            }

            return back()->with(['success' => 'Import Data Material IB berhasil']);
        }
    }

    public function getDataImportIbMaterial(Request $request)
    {
        $akses = Auth::user()->name;

        if ($request->ajax()) {
            $datas = DB::table('import_ftth_ib_materials')
                ->get();

            return Datatables::of($datas)
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

    public function storeFtthIbMaterial(Request $request)
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');
        $akses = Auth::user()->name;

        switch ($request->input('action')) {
            case 'simpan':
                $importedData = DB::table('import_ftth_ib_materials')->get();

                DB::beginTransaction();
                try {
                    $doubleImport = [];

                    foreach ($importedData as $data) {
                        // Cek apakah data WO ada sama / pernah di import sebelumnya
                        $cekDoubleImport = DB::table('ftth_ib_materials')
                                    ->where('wo_no',$data->wo_no)
                                    // ->where('installation_date', $data->installation_date)
                                    ->first();

                        // kumpulkan no wo yg sama /pernah di import sebelumnya
                        if($cekDoubleImport) {
                            array_push($doubleImport,  $data->wo_no);
                        }
                    }

                    //cek jumlah wo yg sama, dan langsung di hapus
                    if(count($doubleImport) > 0) {
                        $deleteDtMaterial = FtthIbMaterial::whereIn('wo_no', $doubleImport)
                        // ->where('installation_date', $data->installation_date)
                        ->delete();
                    }

                    foreach ($importedData as $data) {
                        // Cek apakah data dengan wo_no dan installation_date yang sama sudah ada


                        // Insert data baru jika tidak ada duplikat
                        DB::table('ftth_ib_materials')->insert([
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
                    DB::table('import_ftth_ib_materials')->where('login', $akses)->delete();
                    DB::commit();
                    return redirect()->route('monitFtthIB')->with('success', 'Data berhasil disimpan.');
                } catch (\Exception $e) {
                    // Rollback jika ada kesalahan
                    DB::rollback();
                    return redirect()->route('monitFtthIB')->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
                }
                break;

            case 'batal':
                DB::table('import_ftth_ib_materials')->where('login', $akses)->delete();
                return redirect()->route('monitFtthIB')->with('success', 'Material berhasil dibatalkan.');
                break;
        }
    }
}
