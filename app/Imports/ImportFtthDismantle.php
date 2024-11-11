<?php

namespace App\Imports;

use App\Models\FtthDismantle;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportFtthDismantle implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
{
    protected $logId, $logNm;

    function __construct($akses)
    {
        $dtLogin = explode("|", $akses);
        $this->logId = $dtLogin[0];
        $this->logNm = $dtLogin[1];
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!arrary_filter($row))
        {
            return null;
        }

        return new FtthDismantle([
            'no_wo' => $row['wo_no'],
            'wo_date' => $row['wo_date'],
            'visit_date' => $row['ikr_date'],
            'dis_port_date' => $row['wo_no'],
            'takeout_notakeout' => $row['wo_no'],
            'port' => $row['wo_no'],
            'close_date' => $row['wo_no'],
            'cust_id' => $row['wo_no'],
            'nama_cust' => $row['wo_no'],
            'cust_address' => $row['wo_no'],
            'slot_time' => $row['wo_no'],
            'teknisi1' => $row['wo_no'],
            'teknisi2' => $row['wo_no'],
            'teknisi3' => $row['wo_no'],
            'start' => $row['wo_no'],
            'finish' => $row['wo_no'],
            'kode_fat' => $row['fat_code'],
            'kode_area' => $row['kode_area'],
            'cluster' => $row['area'],
            'kotamadya' => $row['kotamadya'],
            'kotamadya_penagihan' => $row['kotamadya'],
            'main_branch' => $row['area'],
            'ms_regular' => $row['wo_no'],
            'fat_status' => $row['wo_no'],
            'ont_sn_in' => $row['wo_no'],
            'stb_sn_in' => $row['wo_no'],
            'router_sn_in' => $row['wo_no'],
            'tarik_cable' => $row['wo_no'],
            'status_wo' => $row['wo_no'],
            'reason_status' => $row['wo_no'],
            'remarks' => $row['wo_no'],
            'reschedule_date' => $row['wo_no'],
            'alasan_no_rollback' => $row['wo_no'],
            'reschedule_time' => $row['wo_no'],
            'callsign' => $row['wo_no'],
            'checkin_apk' => $row['wo_no'],
            'checkout_apk' => $row['wo_no'],
            'status_apk' => $row['wo_no'],
            'keterangan' => $row['wo_no'],
            'ikr_progress_date' => $row['wo_no'],
            'ikr_report_date' => $row['wo_no'],
            'reconsile_date' => $row['wo_no'],
            'weather' => $row['wo_no'],
            'leader' => $row['wo_no'],
            'pic_monitoring' => $row['wo_no'],
            'login' => $row['wo_no'],
            'created_at' => $row['wo_no'],
            'updated_at' => $row['wo_no'],
        ]);
    }

    public function rules()
    {
        return [
            'no_wo' => Rule::unique('import_ftth_dismantle', 'no_wo')
        ];
    }

    public function customValidationMessages()
    {
        return [
            'no_wo.unique' => 'Nomor WO sudah diimport',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
