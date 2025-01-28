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
            ->leftJoin('data_assign_tims as da', 'da.no_wo_apk', '=', 'd.no_wo')
            ->select(
                'd.site',
                'd.no_wo',
                'd.wo_date_apk',
                'd.type_wo',
                // 'd.wo_type_apk',
                // '',
                'd.sesi',
                // 'd.no_ticket',
                'd.cust_id',
                'd.nama_cust',
                'd.cust_address1',
                'da.cust_mobile_apk',
                'd.kode_fat',
                'd.port_fat',
                'd.tgl_ikr',
                'd.slot_time_apk',
                'd.checkin_apk',
                DB::raw('TIMESTAMPDIFF(MINUTE, d.checkin_apk, TIMESTAMP(d.tgl_ikr, d.slot_time_apk)) as selisih_menit'),
                'd.status_checkin',
                'd.checkout_apk',
                DB::raw('
                    CASE
                        WHEN d.status_wo IN ("done", "checkout")
                        THEN TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(MINUTE, d.checkin_apk, d.checkout_apk) * 60), "%H:%i")
                        ELSE "00:00"
                    END as waktu_instalasi
                '),

                // '',
                // '',
                'd.checkout_apk',
                'd.mttr_all',
                'd.mttr_pending',
                'd.mttr_progress',
                'd.mttr_technician',
                'sla_over',
                'd.cluster',
                'd.kotamadya',
                'd.branch',
                'd.kotamadya_penagihan',
                'd.callsign',
                'd.teknisi1',
                'd.teknisi2',
                'd.teknisi3',
                'd.leader',
                'd.pic_monitoring',
                // '',
                'd.status_apk',
                'd.status_wo',
                // '',
                'd.reason_status',
                // '',
                // '',
                // '',
                // '',
                'd.remarks_teknisi',
                'd.tgl_jam_reschedule',
                'd.respon_konf_cst',
                // '',
                'd.permintaan_reschedule',
                'd.nama_dispatch',
                'd.telp_dispatch',
                'd.weather',
                'd.validasi_start',
                'd.validasi_end',
                'd.start_ikr_wa',
                'd.end_ikr_wa',
                'd.otp_start',
                // '',
                // '',
                // '',
                // '',
                // '',
                // '',
                // '',
                // '',
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
                'd.remote_fiberhome',
                'd.remote_extrem',
                'd.dw_out',
                DB::raw('(SELECT description FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%PRECON%" LIMIT 1) as precon_out'),
                // '',
                'd.fast_connector',
                'd.patchcord',
                'd.terminal_box',
                'd.kabel_utp',
                'd.pipa',
                'd.socket_pipa',
                'd.cable_duct',

                // 'd.type_maintenance',
                // 'd.kode_wilayah',
                // 'd.branch_id',
                // 'd.leadcall_id',
                // 'd.leadcall',
                // 'd.slot_time_leader',
                // 'd.leader_id',
                // 'd.tek1_nik',
                // 'd.tek2_nik',
                // 'd.tek3_nik',
                // 'd.penagihan',
                // 'd.tgl_reschedule',
                // 'd.alasan_cancel',
                // 'd.alasan_pending',
                // 'd.jam_tek_foto_rmh',
                // 'd.jam_dispatch_respon_foto',
                // 'd.jam_teknisi_cek_fat',
                // 'd.jam_dispatch_respon_fat',
                // 'd.jam_teknisi_cek_port_fat',
                // 'd.jam_dispatch_respon_port_fat',
                // 'd.jam_teknisi_aktifasi_perangkat',
                // 'd.jam_dispatch_respon_aktifasi_perangkat',
                // 'd.otp_end',
                // 'd.keterangan',
                // 'd.ms_regular',
                // 'd.wo_date_mail_reschedule',
                // 'd.wo_date_slot_time_apk',
                // 'd.slot_time_assign_apk',
                // 'd.slot_time_apk_delay',
                // 'd.status_slot_time_apk_delay',
                // 'd.ket_delay_slot_time',
                // 'd.marker',
                // 'd.site_penagihan',
                // 'd.login',
                // 'd.is_checked'
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

            $datas = $datas->whereBetween('d.tgl_ikr', [$startDt, $endDt]);
        }

        if($this->request->filnoWo) {
            $datas = $datas->where('no_wo', 'like', '%' . $this->request->filnoWo . '%');
        }

        if($this->request->filcustId) {
            $datas = $datas->where('cust_id', 'like', '%' . $this->request->filcustId . '%');
        }

        if($this->request->filstatusWo) {
            $datas = $datas->where('type_wo', $this->request->filstatusWo);
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
            'Site',
            'No Wo',
            'WO Date',
            'Type Wo',
            // 'Remarks WO',
            'Sesi',
            // 'No Ticket',
            'Cust Id',
            'Nama Cust',
            'Alamat Customer',
            'No Hp',
            'Kode FAT',
            'Port FAT',
            'IKR Date',
            'Slot Time',
            'Check In (Aplikasi)',
            '+/-Minute',
            'Status Checkin',
            'Check Out (Aplikasi)',
            'Waktu Instalasi (Aplikasi)',
            'MTTR All',
            'MTTR Pending',
            'MTTR Progress',
            'MTTR Technician',
            'SLA Over',
            'Cluster',
            'Kotamadya',
            'Branch',
            'Kotamadya Penagihan',
            'Callsign',
            'Teknisi',
            'Teknisi 2',
            'Teknisi 3',
            'Leader',
            'PIC Input',
            'PIC Pengecekan',
            'Status Aplikasi',
            'Status',
            // 'Root Cause Penagihan',
            'Couse Code / Reason Status',
            // 'Root Cause',
            // 'Action Taken',
            'Action Status',
            'Detail Alasan',
            'Remarks',
            'Tanggal & Jam Reschedule Customer',
            'Respon Konfirmasi Cst (Respon/Tidak Respon)',
            'Jawaban Konfirmasi Cst (Setuju/Tidak Setuju/No Respon)',
            'Permintaan Reschedule (Leader/Teknisi/Customer/Dispatch)',
            'Nama Dispatch Konfirmasi',
            'No Telp Dispatch Konfirmasi',
            // 'Cek Telebot',
            // 'Hasil Pengecekan',
            'Weather',
            'Validasi Start',
            'Validasi End',
            'Start Regist',
            'End Regist',
            'Kode OTP',
            'PIC Konfirmasi Cst',
            'Status Konfirmasi Customer',
            'Tgl IKR & Jam Konfirmasi Cst',
            '+/- Minute Konfirmasi',
            'Status Konfirmasi Cst',
            'Waktu Keterlambatan Konfirmasi',
            'Bukti Konfirmasi',
            'Jumlah Material',
            'Merk ONT Out',
            'SN Ont Out',
            'Mac Ont Out',
            'Merk Ont In',
            'SN Ont In',
            'Mac Ont In',
            'Merk Router Out',
            'SN Router Out',
            'Mac Router Out',
            'Merk Router In',
            'SN Router In',
            'Mac Router In',
            'Merk STB Out',
            'SN STB Out',
            'Mac STB Out',
            'Merk STB In',
            'SN STB In',
            'Mac STB In',
            // 'Remote Fiberhome',
            // 'Remote Extreme',
            'Aerial drop cable DW',
            'Precon Out',
            // 'Precon In',
            'Fast Connector',
            'Patch Cord',
            'Terminal Box',
            'Kabel UTP',
            'Pipa',
            'Socket Pipa',
            'Cable Duct',
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
