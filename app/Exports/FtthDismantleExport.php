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

        $datas = DB::table('data_ftth_dismantle_oris as d')
        ->select
            (
                'd.no_wo',
            'd.wo_date',
            'd.visit_date',
            'd.dis_port_date',
            'd.takeout_notakeout',
            'd.port',
            'd.close_date',
            'd.cust_id',
            'd.nama_cust',
            'd.cust_address',
            'd.slot_time',
            'd.teknisi1',
            'd.teknisi2',
            'd.teknisi3',
            'd.start',
            'd.finish',
            'd.kode_fat',
            'd.kode_area',
            'd.cluster',
            'd.kotamadya',
            'd.kotamadya_penagihan',
            'd.main_branch',
            'd.ms_regular',
            'd.fat_status',
            DB::raw('(SELECT sn FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_sn_in'),
            DB::raw('(SELECT sn FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_sn_in'),
            'd.router_sn_in',
            'd.tarik_cable',
            'd.status_wo',
            'd.reason_status',
            'd.remarks',
            'd.reschedule_date',
            'd.alasan_no_rollback',
            'd.reschedule_time',
            'd.callsign',
            'd.checkin_apk',
            'd.checkout_apk',
            'd.status_apk',
            'd.keterangan',
            'd.ikr_progress_date',
            'd.ikr_report_date',
            'd.reconsile_date',
            'd.weather',
            'd.leader',
            'd.pic_monitoring',
            'd.login',
            'd.is_checked',
            'd.created_at',
            'd.updated_at'
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
