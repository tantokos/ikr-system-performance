<?php

namespace App\Imports;

use App\Models\ImportFtthMaterial;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class MaterialImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    protected $logId, $logNm;
    function __construct($akses)
    {
        $dtLogin = explode("|", $akses);
        $this->logId = $dtLogin[0];
        $this->logNm = $dtLogin[1];
    }
    public function model(array $row)
    {
        if(!array_filter($row))
        {
            return null;
        }

        return new ImportFtthMaterial([
            'wo_no' => $row['wo_no'],
            'wo_date' => $row['wo_date'],
            'installation_date' => $row['installation_date'],
            'vendor_installer' => $row['vendor_installer'],
            'callsign' => $row['call_sign'],
            'area' => $row['area'],
            'warehouse' => $row['warehouse'],
            'cust_id' => $row['cust_id'],
            'name' => $row['name'],
            'wo_type' => $row['wo_type'],
            'remarks' => $row['remarks'],
            'status' => $row['status'],
            'status_item' => $row['status_item'],
            'item_code' => $row['item_code'],
            'description' => $row['description'],
            'qty' => $row['qty'],
            'sn' => $row['sn'],
            'mac_address' => $row['mac_address'],
            'material_condition' => $row['material_condition'],
            'login_id' => $this->logId,
            'login' => $this->logNm,
        ]);
    }

    public function rules(): array
    {
        return [
            'no_wo_apk' => Rule::unique('import_ftth_material', 'no_wo_apk')
            // 'wo_no' => Rule::unique('import_assign_tims', 'wo_no')->where(fn (Builder $query) => $query->where('tgk_ikr', 'satu'))
        ];
    }
    public function customValidationMessages()
    {
        return [
            'wo_no.unique' => 'WO number sudah diimport.',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
