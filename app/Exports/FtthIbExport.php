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

        $datas = DB::table('data_ftth_ib_oris as d')
            ->select(
                'd.pic_monitoring',
                'd.site',
                'd.type_wo',
                'd.wo_type_apk',
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
                'd.branch_id',
                'd.branch',
                'd.leadcall_id',
                'd.leadcall',
                'd.tgl_ikr',
                'd.slot_time_leader',
                'd.slot_time_apk',
                'd.sesi',
                'd.callsign',
                'd.leader_id',
                'd.leader',
                'd.tek1_nik',
                'd.tek2_nik',
                'd.tek3_nik',
                'd.teknisi1',
                'd.teknisi2',
                'd.teknisi3',
                'd.status_wo',
                'd.reason_status',
                'd.remarks_teknisi',
                'd.penagihan',
                'd.tgl_jam_reschedule',
                'd.tgl_reschedule',
                'd.alasan_cancel',
                'd.alasan_pending',
                'd.respon_konf_cst',
                'd.permintaan_reschedule',
                'd.weather',
                'd.start_ikr_wa',
                'd.end_ikr_wa',
                'd.nama_dispatch',
                'd.telp_dispatch',
                'd.jam_tek_foto_rmh',
                'd.jam_dispatch_respon_foto',
                'd.jam_teknisi_cek_fat',
                'd.jam_dispatch_respon_fat',
                'd.jam_teknisi_cek_port_fat',
                'd.jam_dispatch_respon_port_fat',
                'd.jam_teknisi_aktifasi_perangkat',
                'd.jam_dispatch_respon_aktifasi_perangkat',
                'd.validasi_start',
                'd.validasi_end',
                'd.otp_start',
                'd.otp_end',
                'd.checkin_apk',
                'd.checkout_apk',
                'd.status_apk',
                'd.keterangan',
                'd.ms_regular',
                'd.wo_date_apk',
                'd.wo_date_mail_reschedule',
                'd.wo_date_slot_time_apk',
                'd.slot_time_assign_apk',
                'd.slot_time_apk_delay',
                'd.status_slot_time_apk_delay',
                'd.ket_delay_slot_time',
                DB::raw('(SELECT description FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_merk_out'),
                DB::raw('(SELECT sn FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_sn_out'),
                DB::raw('(SELECT mac_address FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_mac_out'),
                DB::raw('(SELECT description FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_merk_in'),
                DB::raw('(SELECT sn FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_sn_in'),
                DB::raw('(SELECT mac_address FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_mac_in'),
                'd.router_merk_out',
                'd.router_sn_out',
                'd.router_mac_out',
                'd.router_merk_in',
                'd.router_sn_in',
                'd.router_mac_in',
                DB::raw('(SELECT description FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_merk_out'),
                DB::raw('(SELECT sn FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_sn_out'),
                DB::raw('(SELECT mac_address FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_mac_out'),
                DB::raw('(SELECT description FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_merk_in'),
                DB::raw('(SELECT sn FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_sn_in'),
                DB::raw('(SELECT mac_address FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_mac_in'),
                'd.dw_out',
                DB::raw('(SELECT description FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%PRECON%" LIMIT 1) as precon_out'),
                'd.kabel_utp',
                'd.fast_connector',
                'd.patchcord',
                'd.pipa',
                'd.socket_pipa',
                'd.terminal_box',
                'd.cable_duct',
                'd.remote_fiberhome',
                'd.remote_extrem',
                'd.port_fat',
                'd.marker',
                'd.site_penagihan',
                'd.login',
                'd.is_checked'
            )
            ->orderBy('d.tgl_ikr', 'DESC');

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
