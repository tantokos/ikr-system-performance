<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class FtthIbExport implements FromCollection, WithHeadings, WithStyles
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

        $datas = DB::table('data_ftth_ib_oris')
        ->select(
            'pic_monitoring',
            'site',
            'type_wo',
            'wo_type_apk',
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
            'branch_id',
            'branch',
            'leadcall_id',
            'leadcall',
            'tgl_ikr',
            'slot_time_leader',
            'slot_time_apk',
            'sesi',
            'callsign',
            'leader_id',
            'leader',
            'tek1_nik',
            'tek2_nik',
            'tek3_nik',
            'teknisi1',
            'teknisi2',
            'teknisi3',
            'status_wo',
            'reason_status',
            'remarks_teknisi',
            'penagihan',
            'tgl_jam_reschedule',
            'tgl_reschedule',
            'alasan_cancel',
            'alasan_pending',
            'respon_konf_cst',
            'permintaan_reschedule',
            'weather',
            'start_ikr_wa',
            'end_ikr_wa',
            'nama_dispatch',
            'telp_dispatch',
            'jam_tek_foto_rmh',
            'jam_dispatch_respon_foto',
            'jam_teknisi_cek_fat',
            'jam_dispatch_respon_fat',
            'jam_teknisi_cek_port_fat',
            'jam_dispatch_respon_port_fat',
            'jam_teknisi_aktifasi_perangkat',
            'jam_dispatch_respon_aktifasi_perangkat',
            'validasi_start',
            'validasi_end',
            'otp_start',
            'otp_end',
            'checkin_apk',
            'checkout_apk',
            'status_apk',
            'keterangan',
            'ms_regular',
            'wo_date_apk',
            'wo_date_mail_reschedule',
            'wo_date_slot_time_apk',
            'slot_time_assign_apk',
            'slot_time_apk_delay',
            'status_slot_time_apk_delay',
            'ket_delay_slot_time',
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
            'kabel_utp',
            'fast_connector',
            'patchcord',
            'pipa',
            'socket_pipa',
            'terminal_box',
            'cable_duct',
            'remote_fiberhome',
            'remote_extrem',
            'port_fat',
            'marker',
            'site_penagihan',
            'login',
            'is_checked'
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
            'Pic Monitoring',
            'Site',
            'Type Wo',
            'Wo Type Apk',
            'No Wo',
            'No Ticket',
            'Cust Id',
            'Nama Cust',
            'Cust Address1',
            'Cust Address2',
            'Type Maintenance',
            'Kode Fat',
            'Kode Wilayah',
            'Cluster',
            'Kotamadya',
            'Kotamadya Penagihan',
            'Branch Id',
            'Branch',
            'Leadcall Id',
            'Leadcall',
            'Tgl Ikr',
            'Slot Time Leader',
            'Slot Time Apk',
            'Sesi',
            'Callsign',
            'Leader Id',
            'Leader',
            'Tek1 Nik',
            'Tek2 Nik',
            'Tek3 Nik',
            'Teknisi1',
            'Teknisi2',
            'Teknisi3',
            'Status Wo',
            'Reason Status',
            'Remarks Teknisi',
            'Penagihan',
            'Tgl Jam Reschedule',
            'Tgl Reschedule',
            'Alasan Cancel',
            'Alasan Pending',
            'Respon Konf Cst',
            'Permintaan Reschedule',
            'Weather',
            'Start Ikr Wa',
            'End Ikr Wa',
            'Nama Dispatch',
            'Telp Dispatch',
            'Jam Tek Foto Rmh',
            'Jam Dispatch Respon Foto',
            'Jam Teknisi Cek Fat',
            'Jam Dispatch Respon Fat',
            'Jam Teknisi Cek Port Fat',
            'Jam Dispatch Respon Port Fat',
            'Jam Teknisi Aktifasi Perangkat',
            'Jam Dispatch Respon Aktifasi Perangkat',
            'Validasi Start',
            'Validasi End',
            'Otp Start',
            'Otp End',
            'Checkin Apk',
            'Checkout Apk',
            'Status Apk',
            'Keterangan',
            'Ms Regular',
            'Wo Date Apk',
            'Wo Date Mail Reschedule',
            'Wo Date Slot Time Apk',
            'Slot Time Assign Apk',
            'Slot Time Apk Delay',
            'Status Slot Time Apk Delay',
            'Ket Delay Slot Time',
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
            'Kabel Utp',
            'Fast Connector',
            'Patchcord',
            'Pipa',
            'Socket Pipa',
            'Terminal Box',
            'Cable Duct',
            'Remote Fiberhome',
            'Remote Extrem',
            'Port Fat',
            'Marker',
            'Site Penagihan',
            'Login',
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
                        'argb' => '007BFF', // Background biru
                    ],
                ],
            ],
        ];
    }
}
