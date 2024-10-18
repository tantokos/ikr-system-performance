<?php

namespace App\Imports;

use App\Models\ImportFtthMtApk;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;

class FtthMtApkImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
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
            'installation_date' => $row['installation_date'],
            'time' => $row['time'],
            'vendor_installer' => $row['vendor_installer'],
            'callsign' => $row['call_sign'],
            'cust_id' => $row['cust_id'],
            'name' => Str::title($row['name']),
            'cust_phone' => $row['cust_phone'],
            'cust_mobile' => $row['cust_mobile'],
            'address' => Str::title($row['address']),
            'area' => Str::title($row['area']),
            'wo_type' => $row['wo_type'],
            'cause_code' => $row['cause_code'],
            'root_cause' => $row['root_cause'],
            'action_taken' => $row['action_taken'],
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
            'wo_no' => Rule::unique('import_ftth_mt_apks', 'wo_no'), // Sesuaikan nama tabel dan kolom
        ];
    }

    /**
     * Pesan khusus untuk validasi.
     */
    public function customValidationMessages()
    {
        return [
            'wo_no.unique' => 'WO number already exists.',
        ];
    }
}
