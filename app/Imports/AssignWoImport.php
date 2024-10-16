<?php

namespace App\Imports;

use App\Models\ImportAssignTim;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;

class AssignWoImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $logId, $logNm;

    function __construct($akses)
    {
        $dtLogin = explode("|", $akses);
        $loginId = $dtLogin[0];
        $loginNm = $dtLogin[1];
        $this->logId = $loginId;
        $this->logNm = $loginNm;
    }


    public function model(array $row)
    {
        return new ImportAssignTim([


            'batch_wo' => "Sesi",
            // 'tgl_ikr' => ,
            'no_wo_apk' => $row['wo_no'],
            'no_ticket_apk' => $row['ticket_no'],
            'wo_type_apk' => Str::title($row['wo_type']),

            'type_wo' => Str::upper($row['wo_type'])=="MAINTENANCE" || Str::upper($row['wo_type'])=="REMOVE DEVICE" || Str::upper($row['wo_type'])=="ADD DEVICE" || Str::upper($row['wo_type'])=="ADD / REMOVE DEVICE" || Str::upper($row['wo_type'])=="PENDING DEVICE" ? "FTTH Maintenance" : (Str::upper($row['wo_type'])=="NEW INSTALLATION" || Str::upper($row['wo_type'])=="RELOCATION" ? "FTTH New Installation" : (Str::upper($row['wo_type'])=="DISMANTLE" ? "FTTH Dismantle" : "-")),

            'wo_date_apk' => $row['wo_date'],
            'cust_id_apk' => $row['cust_id'],
            'name_cust_apk' => Str::title($row['name']),
            'cust_phone_apk' => $row['cust_phone'],
            'cust_mobile_apk' => $row['cust_mobile'],
            'address_apk' => Str::title($row['address']),
            'area_cluster_apk' => Str::title($row['area']),
            'fat_code_apk' => $row['fat_code'],
            'fat_port_apk' => $row['fat_port'],
            'remarks_apk' => Str::title($row['remarks']),
            'vendor_installer_apk' => Str::title($row['vendor_installer']),
            'ikr_date_apk' => $row['ikr_date'],
            'time_apk' => $row['time'],
            'login_id' => $this->logId,
            'login' => $this->logNm
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'no_wo_apk' => Rule::unique('import_assign_tims', 'no_wo_apk')
            // 'wo_no' => Rule::unique('import_assign_tims', 'wo_no')->where(fn (Builder $query) => $query->where('tgk_ikr', 'satu'))
        ];
    }

    public function customValidationMessages()
{
    return [
        'no_wo_apk.unique' => 'Duplicate',
    ];
}

    public function chunkSize(): int
    {
        return 1000;
    }
}
