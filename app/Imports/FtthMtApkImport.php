<?php

namespace App\Imports;

use App\Models\ImportFtthMtApk;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class FtthMtApkImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation, SkipsEmptyRows
{
    protected $logId, $logNm;

    public function __construct($akses)
    {
        $dtLogin = explode("|", $akses);
        $this->logId = $dtLogin[0];
        $this->logNm = $dtLogin[1];
    }

    /**
     * Mengubah setiap baris Excel menjadi model.
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new ImportFtthMtApk([ // Ganti dengan model sesuai
            'wo_no' => $row['wo_no'],
            'ticket_no' => $row['ticket_no'],
            'wo_date' => $row['wo_date'],
            'installation_date' => date('Y-m-d', strtotime($row['installation_date'])),
            'time' => $row['time'],
            'vendor_installer' => $row['vendor_installer'],
            'callsign' => $row['call_sign'],
            'callsign_id' => $this->get_data_id("callsign_id", Str::trim($row['call_sign'])),
            'cust_id' => $row['cust_id'],
            'name' => Str::title($row['name']),
            'cust_phone' => $row['cust_phone'],
            'cust_mobile' => $row['cust_mobile'],
            'address' => Str::title($row['address']),
            'area' => Str::title($row['area']),
            'wo_type' => strtoupper(str_replace("_"," ",$row['wo_type'])),            
            'cause_code' => trim($row['cause_code']),
            'root_cause' => trim($row['root_cause']),
            'action_taken' => trim($row['action_taken']),
            'fat_code' => $row['fat_code'],
            'fat_port' => $row['fat_port'],
            'remarks' => $row['remarks'] ?? '',
            'status' => $row['status'],
            'pending' => $row['pending'],
            'reason' => $row['reason'],
            'check_in' => $row['check_in'],
            'check_out' => $row['check_out'],
            'mttr_all' => $row['mttr_all'],
            'mttr_pending' => $row['mttr_pending'],
            'mttr_progress' => $row['mttr_progress'],
            'mttr_technician' => $row['mttr_technician'],
            'sla_over' => $row['sla_over'],
            'login' =>  $this->logNm
        ]);
    }

    /**
     * Menentukan ukuran chunk untuk pemrosesan.
     * @return int
     */
    public function chunkSize(): int
    {
        return 1000;
    }

    /**
     * Validasi untuk data yang diimpor.
     */
    public function rules(): array
    {
        return [
            '*.wo_no' => ['required', 
                Rule::unique('import_ftth_mt_apks', 'wo_no')
                ->using(function ($q) { $q->where('login',  '=', $this->logNm); })],
            '*.wo_date' => ['required'],
            // '*.ticket_no' => ['required'],
            '*.installation_date' => ['required'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.wo_no.unique' => 'No WO sudah ada di database',
            '*.wo_no.required' => 'No WO harus diisi',
            // '*.ticket_no.required' => 'Ticket No harus diisi',
            '*.wo_date.required' => 'WO Date harus diisi',
            '*.installation_date.required' => 'Periksa kembali file yang diunggah, pastikan formatnya benar',
        ];
    }

    public function get_data_id($kolom, $data)
    {
        // dd($kolom, $data);

            switch ($kolom) {
                case "callsign_id":
                    if(strtoupper(substr($data,0,4))=="LEAD") {
                        $callsign_id = DB::table('callsign_leads as cl')
                            ->leftJoin('employees as e','cl.leader_id', '=', 'e.nik_karyawan')
                            ->select('cl.id as callsign_tim_id')
                            ->where('lead_callsign', $data)->first();
                    } else {
                        $callsign_id = DB::table('v_detail_callsign_tim')->select('callsign_tim_id')->where('callsign_tim', $data)->first();
                    }
                    
                    // $leaderID= is_null($leader_id) ? "-" : $leader_id->leader_id;
                    return is_null($callsign_id) ?  null : $callsign_id->callsign_tim_id;
                    break;
            }
    }
}
