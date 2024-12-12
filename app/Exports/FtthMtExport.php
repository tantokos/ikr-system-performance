<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FtthMtExport implements FromCollection, WithHeadings, WithStyles
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function collection()
    {
        ini_set('max_execution_time', 1900);
        ini_set('memory_limit', '8192M');

        $datas = DB::table('data_ftth_mt_oris as d')
        ->select('d.pic_monitoring',
            'd.type_wo',
            'd.no_wo',
            'd.no_ticket',
            'd.cust_id',
            'd.nama_cust',
            'd.cust_address1',
            'd.cust_address2',
            'd.type_maintenance',
            'd.kode_fat',
            'd.kode_wilayah',
            'd.cluster',
            'd.kotamadya',
            'd.kotamadya_penagihan',
            'd.branch',
            'd.tgl_ikr',
            'd.slot_time_leader',
            'd.slot_time_apk',
            'd.sesi',
            'd.remark_traffic',
            'd.callsign',
            'd.leader',
            'd.teknisi1',
            'd.teknisi2',
            'd.teknisi3',
            'd.status_wo',
            'd.couse_code',
            'd.root_couse',
            'd.penagihan',
            'd.alasan_tag_alarm',
            'd.tgl_jam_reschedule',
            'd.tgl_reschedule',
            'd.tgl_jam_fat_on',
            'd.action_taken',
            'd.panjang_kabel',
            'd.weather',
            'd.remark_status',
            'd.action_status',
            'd.visit_novisit',
            'd.start_ikr_wa',
            'd.end_ikr_wa',
            'd.validasi_start',
            'd.validasi_end',
            'd.checkin_apk',
            'd.checkout_apk',
            'd.status_apk',
            'd.keterangan',
            'd.ms_regular',
            'd.wo_date_apk',
            'd.wo_date_mail_reschedule',
            'd.wo_date_slot_time_apk',
            'd.actual_sla_wo_minute_apk',
            'd.actual_sla_wo_jam_apk',
            'd.mttr_over_apk_minute',
            'd.mttr_over_apk_jam',
            'd.mttr_over_apk_persen',
            'd.status_sla',
            'd.root_couse_before',
            'd.slot_time_assign_apk',
            'd.slot_time_apk_delay',
            'd.status_slot_time_apk_delay',
            'd.ket_delay_slot_time',
            'd.konfirmasi_customer',
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_merk_out'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_sn_out'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_mac_out'),
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_merk_in'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_sn_in'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_mac_in'),
            'd.router_merk_out',
            'd.router_sn_out',
            'd.router_mac_out',
            'd.router_merk_in',
            'd.router_sn_in',
            'd.router_mac_in',
            'd.stb_merk_out',
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_merk_out'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_sn_out'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_mac_out'),
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_merk_in'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_sn_in'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_mac_in'),
            'd.dw_out',
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%PRECON%" LIMIT 1) as precon_out'),
            'd.bad_precon',
            'd.fast_connector',
            'd.patchcord',
            'd.terminal_box',
            'd.remote_fiberhome',
            'd.remote_extrem',
            'd.port_fat',
            'd.site_penagihan',
            'd.site_penagihan',
            'd.konfirmasi_cst',
            'd.konfirmasi_dispatch',
            'd.remark_status2',
            'd.login',
            'd.created_at',
            'd.updated_at',
            'd.wo_type_apk',
            'd.branch_id',
            'd.leadcall',
            'd.tek1_nik',
            'd.tek2_nik',
            'd.tek3_nik',
            'd.tek4_nik',
            'd.leadcall_id',
            'd.leader_id',
            'd.callsign_id',
            'd.teknisi4',
            'd.alasan_tidak_ganti_precon',
            'd.alasan_pending',
            'd.alasan_cancel',
            'd.is_checked',
         )
        ->orderBy('tgl_ikr', 'DESC');

        if($this->request->filtglProgress) {
            $dateRange = explode(" - ", $this->request->filtglProgress);

            // Trim whitespace and ensure correct format
            $startDate = trim($dateRange[0]);
            $endDate = trim($dateRange[1]);

            // Parse the date using a more flexible approach
            $startDt = Carbon::parse($startDate)->startOfDay();
            $endDt = Carbon::parse($endDate)->endOfDay();

            $datas = $datas->whereBetween('tgl_ikr', [$startDt, $endDt]);
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
            'PIC Monitoring',
            'Type WO',
            'No WO',
            'No Ticket',
            'Cust ID',
            'Nama Cust',
            'Adress',
            'Address2',
            'Type Maintenance',
            'Kode FAT',
            'Kode Wilayah',
            'Cluster',
            'Kotamadya',
            'Kotamadya Penagihan',
            'Branch',
            'Tgl IKR',
            'Slot Time Leader',
            'Slot Time APK',
            'Sesi',
            'Remarks Traffic',
            'Callsign',
            'Leader',
            'Teknisi1',
            'Teknisi2',
            'Teknisi3',
            'Status WO',
            'Cause Code',
            'Root Couse',
            'Penagihan',
            'Alasan Tag Alarm',
            'Tgl Jam Reschedule',
            'Tgl Reschedule',
            'Tgl Jam FAT On',
            'Action Taken',
            'Panjang Kabel',
            'Weather',
            'Remarks Status',
            'Action Status',
            'Visit Novisit',
            'Start IKR WA',
            'End IKR WA',
            'Validasi Start',
            'Validasi End',
            'Checkin Apk',
            'Checkout Apk',
            'Status Apk',
            'Report Teknisi',
            'MS Regular',
            'WO Date Apk',
            'Wo Date Mail Reschedule',
            'Wo Date Slot Time Apk',
            'Actual Sla Wo Minute Apk',
            'Actual Sla Wo Jam Apk',
            'Mttr Over Apk Minute',
            'Mttr Over Apk Jam',
            'Mttr Over Apk Persen',
            'Status Sla',
            'Root Couse Before',
            'Slot Time Assign Apk',
            'Slot Time Apk Delay',
            'Status Slot Time Apk Delay',
            'Ket Delay Slot Time',
            'Konfirmasi Customer',
            'Ont Merk Out',
            'Ont Sn Out',
            'Ont Mac Out',
            'Ont Merk In',
            'Ont Sn In',
            'Ont Mac In',
            'Router Merk Out',
            'Router Sn Out',
            'Router Mac Out',
            'Router Merk In',
            'Router Sn In',
            'Router Mac In',
            'Stb Merk Out',
            'Stb Sn Out',
            'Stb Mac Out',
            'Stb Merk In',
            'Stb Sn In',
            'Stb Mac In',
            'Dw Out',
            'Precon Out',
            'Bad Precon',
            'Fast Connector',
            'Patchcord',
            'Terminal Box',
            'Remote Fiberhome',
            'Remote Extrem',
            'Port Fat',
            'Site Penagihan',
            'Konfirmasi Cst',
            'Konfirmasi Dispatch',
            'Remark Status2',
            'Login',
            'Created At',
            'Updated At',
            'Wo Type Apk',
            'Branch Id',
            'Leadcall',
            'Tek1 Nik',
            'Tek2 Nik',
            'Tek3 Nik',
            'Tek4 Nik',
            'Leadcall Id',
            'Leader Id',
            'Callsign Id',
            'Teknisi4',
            'Alasan Tidak Ganti Precon',
            'Alasan Pending',
            'Alasan Cancel',
            'Is Checked',
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
                        'argb' => 'FF0000', // Background biru
                    ],
                ],
            ],
        ];
    }
}
