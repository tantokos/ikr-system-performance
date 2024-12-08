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

        $datas = DB::table('data_ftth_mt_oris')
        ->select('pic_monitoring',
            'type_wo',
            'no_wo',
            'no_ticket',
            'cust_id',
            'nama_cust',
            'cust_address1',
            'cust_address2',
            'type_maintenance',
            'kode_fat',
            'kode_wilayah',
            'cluster',
            'kotamadya',
            'kotamadya_penagihan',
            'branch',
            'tgl_ikr',
            'slot_time_leader',
            'slot_time_apk',
            'sesi',
            'remark_traffic',
            'callsign',
            'leader',
            'teknisi1',
            'teknisi2',
            'teknisi3',
            'status_wo',
            'couse_code',
            'root_couse',
            'penagihan',
            'alasan_tag_alarm',
            'tgl_jam_reschedule',
            'tgl_reschedule',
            'tgl_jam_fat_on',
            'action_taken',
            'panjang_kabel',
            'weather',
            'remark_status',
            'action_status',
            'visit_novisit',
            'start_ikr_wa',
            'end_ikr_wa',
            'validasi_start',
            'validasi_end',
            'checkin_apk',
            'checkout_apk',
            'status_apk',
            'keterangan',
            'ms_regular',
            'wo_date_apk',
            'wo_date_mail_reschedule',
            'wo_date_slot_time_apk',
            'actual_sla_wo_minute_apk',
            'actual_sla_wo_jam_apk',
            'mttr_over_apk_minute',
            'mttr_over_apk_jam',
            'mttr_over_apk_persen',
            'status_sla',
            'root_couse_before',
            'slot_time_assign_apk',
            'slot_time_apk_delay',
            'status_slot_time_apk_delay',
            'ket_delay_slot_time',
            'konfirmasi_customer',
            'ont_merk_out',
            'ont_sn_out',
            'ont_mac_out',
            'ont_merk_in',
            'ont_sn_in',
            'ont_mac_in',
            'router_merk_out',
            'router_sn_out',
            'router_mac_out',
            'router_merk_in',
            'router_sn_in',
            'router_mac_in',
            'stb_merk_out',
            'stb_sn_out',
            'stb_mac_out',
            'stb_merk_in',
            'stb_sn_in',
            'stb_mac_in',
            'dw_out',
            'precon_out',
            'bad_precon',
            'fast_connector',
            'patchcord',
            'terminal_box',
            'remote_fiberhome',
            'remote_extrem',
            'port_fat',
            'site_penagihan',
            'site_penagihan',
            'konfirmasi_cst',
            'konfirmasi_dispatch',
            'remark_status2',
            'login',
            'created_at',
            'updated_at',
            'wo_type_apk',
            'branch_id',
            'leadcall',
            'tek1_nik',
            'tek2_nik',
            'tek3_nik',
            'tek4_nik',
            'leadcall_id',
            'leader_id',
            'callsign_id',
            'teknisi4',
            'alasan_tidak_ganti_precon',
            'alasan_pending',
            'alasan_cancel',
            'is_checked',
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
