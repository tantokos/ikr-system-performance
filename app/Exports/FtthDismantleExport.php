<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FtthDismantleExport implements FromCollection, WithHeadings, WithStyles
{
    protected $request;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function collection()
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');

        $datas = DB::table('data_ftth_dismantle_oris')
        ->select
            (
                'no_wo',
            'wo_date',
            'visit_date',
            'dis_port_date',
            'takeout_notakeout',
            'port',
            'close_date',
            'cust_id',
            'nama_cust',
            'cust_address',
            'slot_time',
            'teknisi1',
            'teknisi2',
            'teknisi3',
            'start',
            'finish',
            'kode_fat',
            'kode_area',
            'cluster',
            'kotamadya',
            'kotamadya_penagihan',
            'main_branch',
            'ms_regular',
            'fat_status',
            'ont_sn_in',
            'stb_sn_in',
            'router_sn_in',
            'tarik_cable',
            'status_wo',
            'reason_status',
            'remarks',
            'reschedule_date',
            'alasan_no_rollback',
            'reschedule_time',
            'callsign',
            'checkin_apk',
            'checkout_apk',
            'status_apk',
            'keterangan',
            'ikr_progress_date',
            'ikr_report_date',
            'reconsile_date',
            'weather',
            'leader',
            'pic_monitoring',
            'login',
            'is_checked',
            'created_at',
            'updated_at'
        )
        ->orderBy('visit_date', 'DESC');

        if($this->request->filtglProgress) {
            $dateRange = explode(" - ", $this->request->filtglProgress);

            // Trim whitespace and ensure correct format
            $startDate = trim($dateRange[0]);
            $endDate = trim($dateRange[1]);

            // Parse the date using a more flexible approach
            $startDt = Carbon::parse($startDate)->startOfDay();
            $endDt = Carbon::parse($endDate)->endOfDay();

            $datas = $datas->whereBetween('visit_date', [$startDt, $endDt]);
        }

        if($this->request->filnoWo) {
            $datas = $datas->where('no_wo', 'like', '%' . $this->request->filnoWo . '%');
        }

        if($this->request->filcustId) {
            $datas = $datas->where('cust_id', 'like', '%' . $this->request->filcustId . '%');
        }

        if($this->request->filtypeWo) {
            $datas = $datas->where('type_wo', $this->request->filtypeWo);
        }

        if($this->request->filarea) {
            $area = explode("|", $this->request->filarea);
            $datas = $datas->where('branch', $area[1]);
        }

        if($this->request->filleaderTim) {
            $leader = explode("|", $this->request->filleaderTim);
            $datas = $datas->where('leader', $leader[1]);
        }

        if($this->request->filcallsignTimid) {
            $callsign = explode("|", $this->request->filcallsignTimid);
            $datas = $datas->where('callsign', $callsign[1]);
        }

        if($this->request->filteknisi) {
            $teknisi = explode("|", $this->request->filteknisi);
            $nikTk = $teknisi[0];
            $datas = $datas->where(function($query) use ($nikTk) {
                $query->where('tek1_nik', $nikTk)
                      ->orWhere('tek2_nik', $nikTk)
                      ->orWhere('tek3_nik', $nikTk)
                      ->orWhere('tek4_nik', $nikTk);
            });
        }

        if($this->request->filcluster) {
            $datas = $datas->where('cluster', $this->request->filcluster);
        }

        if($this->request->filfatCode) {
            $datas = $datas->where('kode_fat', 'like', '%' . $this->request->filfatCode . '%');
        }

        if($this->request->filslotTime) {
            $datas = $datas->where('slot_time', $this->request->filslotTime);
        }

        return $datas->get();
    }

    public function headings(): array
    {
        return [
            'No Wo',
            'Wo Date',
            'Visit Date',
            'Dis Port Date',
            'Takeout Notakeout',
            'Port',
            'Close Date',
            'Cust Id',
            'Nama Cust',
            'Cust Address',
            'Slot Time',
            'Teknisi1',
            'Teknisi2',
            'Teknisi3',
            'Start',
            'Finish',
            'Kode Fat',
            'Kode Area',
            'Cluster',
            'Kotamadya',
            'Kotamadya Penagihan',
            'Main Branch',
            'Ms Regular',
            'Fat Status',
            'Ont Sn In',
            'Stb Sn In',
            'Router Sn In',
            'Tarik Cable',
            'Status Wo',
            'Reason Status',
            'Remarks',
            'Reschedule Date',
            'Alasan No Rollback',
            'Reschedule Time',
            'Callsign',
            'Checkin Apk',
            'Checkout Apk',
            'Status Apk',
            'Keterangan',
            'Ikr Progress Date',
            'Ikr Report Date',
            'Reconsile Date',
            'Weather',
            'Leader',
            'Pic Monitoring',
            'Login',
            'Is Checked',
            'Created At',
            'Updated At',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Gaya untuk baris pertama (heading)
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => 'FFFFFF'], // Teks putih
                ],
                'fill' => [
                    'fillType' => 'solid',
                    'startColor' => [
                        'argb' => 'A020F0', // Background biru
                    ],
                ],
            ],
        ];
    }

}
