<?php

namespace App\Imports;

use App\Models\ImportJadwalIkr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;

class JadwalIkrImport implements ToModel, WithHeadingRow
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

        // $days = new Date(pWO.tgl[pw].tanggal).getDate().toString().padStart(2, "0");
        // for($x=1 ; $x < $endDate->format('d'); $x++)
        // {
        //     // dd($endDate->format('d'));
        //     dd($x);
        // }

        if ($endDate->format('d') == "30")
        {
            return new ImportJadwalIkr([
                'branch_id' => $this->get_data_id("branch_id", $row['branch']),
                'branch' => $this->get_data_id("branch", $row['branch']),
                'nik_karyawan' => $this->get_data_id("nik_karyawan", $row['nama_karyawan']),
                'nama_karyawan' => $row['nama_karyawan'],
                'bulan' => $this->bulan,
                'tahun' => $this->tahun,
                
                't01' => $row['1'],
                't02' => $row['2'],
                't03' => $row['3'],
                't04' => $row['4'],
                't05' => $row['5'],
                't06' => $row['6'],
                't07' => $row['7'],
                't08' => $row['8'],
                't09' => $row['9'],
                't10' => $row['10'],
                't11' => $row['11'],
                't12' => $row['12'],
                't13' => $row['13'],
                't14' => $row['14'],
                't15' => $row['15'],
                't16' => $row['16'],
                't17' => $row['17'],
                't18' => $row['18'],
                't19' => $row['19'],
                't20' => $row['20'],
                't21' => $row['21'],
                't22' => $row['22'],
                't23' => $row['23'],
                't24' => $row['24'],
                't25' => $row['25'],
                't26' => $row['26'],
                't27' => $row['27'],
                't28' => $row['28'],
                't29' => $row['29'],
                't30' => $row['30'],
                'login_id'=> $this->logId,
                'login' => $this->logNm
            ]);
        }

        if ($endDate->format('d') == "31")
        {
            return new ImportJadwalIkr([
                'branch_id' => $this->get_data_id("branch_id", $row['branch']),
                'branch' => $this->get_data_id("branch", $row['branch']),
                'nik_karyawan' => $this->get_data_id("nik_karyawan", $row['nama_karyawan']),
                'nama_karyawan' => $row['nama_karyawan'],
                'bulan' => $this->bulan,
                'tahun' => $this->tahun,
                
                't01' => $row['1'],
                't02' => $row['2'],
                't03' => $row['3'],
                't04' => $row['4'],
                't05' => $row['5'],
                't06' => $row['6'],
                't07' => $row['7'],
                't08' => $row['8'],
                't09' => $row['9'],
                't10' => $row['10'],
                't11' => $row['11'],
                't12' => $row['12'],
                't13' => $row['13'],
                't14' => $row['14'],
                't15' => $row['15'],
                't16' => $row['16'],
                't17' => $row['17'],
                't18' => $row['18'],
                't19' => $row['19'],
                't20' => $row['20'],
                't21' => $row['21'],
                't22' => $row['22'],
                't23' => $row['23'],
                't24' => $row['24'],
                't25' => $row['25'],
                't26' => $row['26'],
                't27' => $row['27'],
                't28' => $row['28'],
                't29' => $row['29'],
                't30' => $row['30'],
                't31' => $row['31'],
                'login_id'=> $this->logId,
                'login' => $this->logNm
            ]);
        }
        

        
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
                    $nik_karyawan = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->first();
                    // dd(is_null($tek1_nik));
                    $nik = is_null($nik_karyawan) ? NULL : $nik_karyawan->nik_karyawan;
                    return $nik;

                    break;

                case "nama_karyawan":
                    $nk = DB::table('employees')->select('nama_karyawan')->where('nama_karyawan', $data)->first();
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
}
