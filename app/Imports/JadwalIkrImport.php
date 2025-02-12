<?php

namespace App\Imports;

use App\Models\ImportJadwalIkr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\WithStartRow;

class JadwalIkrImport implements ToModel, WithCalculatedFormulas, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $logId, $logNm, $bulan, $tahun;

    function __construct($akses)
    {
        $dtLogin = explode("|", $akses);
        $loginId = $dtLogin[0];
        $loginNm = $dtLogin[1];
        $bln = $dtLogin[2];
        $thn = $dtLogin[3];
        $this->logId = $loginId;
        $this->logNm = $loginNm;
        $this->bulan = $bln;
        $this->tahun = $thn;

    }

    public function model(array $row)
    {        
        if(!array_filter($row)) {
            return null;
        }

        $startDate = \Carbon\Carbon::createFromDate($this->tahun, $this->bulan, 1)->startOfMonth();
        $endDate = \Carbon\Carbon::createFromDate($this->tahun, $this->bulan, 1)->endOfMonth();

        $dataImport = [           
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
        ];

        for($x=0; $x < $endDate->format('d')+2; $x++) {
            if($x==0){
                $dataImport += [
                    'branch_id' => $this->get_data_id("branch_id", $row[$x]),
                    'branch' => $this->get_data_id("branch", $row[$x])
                ];    
            } else if($x==1){
                $dataImport += [
                    'nik_karyawan' => $this->get_data_id("nik_karyawan", $row[$x]),
                    'nama_karyawan' => $this->get_data_id("nama_karyawan", $row[$x])
                ];    
            } else {
                $dataImport += ['t'.sprintf("%02d",$x-1) => $row[$x]];
            }
        }

        $dataImport += [
            'login_id'=> $this->logId,
            'login' => $this->logNm
        ];

        return new ImportJadwalIkr($dataImport);
        
    }

    public function get_data_id($kolom, $data)
    {
        // dd($kolom, $data);

        // try {

            switch ($kolom) {             
                
                case "branch_id":
                    $branchID = DB::table('branches')->select('id')->where('nama_branch', $data)->first();
                    return is_null($branchID) ? NULL : $branchID->id;
                    break;

                case "branch":
                    $branch = DB::table('branches')->select('nama_branch')->where('nama_branch', $data)->first();
                    return is_null($branch) ? NULL : $branch->nama_branch;
                    break;

                case "nik_karyawan":
                    $nik_karyawan = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)
                    ->where('status_active', 'Aktif')->first();
                    // dd(is_null($tek1_nik));
                    $nik = is_null($nik_karyawan) ? NULL : $nik_karyawan->nik_karyawan;
                    return $nik;

                    break;

                case "nama_karyawan":
                    $nk = DB::table('employees')->select('nama_karyawan')->where('nama_karyawan', $data)
                    ->where('status_active', 'Aktif')->first();
                        // dd(is_null($tek1_nik));
                    $nama = is_null($nk) ? NULL : $nk->nama_karyawan;
                    return $nama;
    
                    break;
                    // dd($branch);
            }


        // } catch (\Exception $e) {
            // DB::rollBack();
            // return $e->getMessage();
            // return redirect()->route('importDataWo')
                // ->with(['error' => 'Gagal Import Assign Tim: ' . $e->getMessage()]);
        // }

    }

    public function startRow(): int
    {
        return 2;
    }
}
