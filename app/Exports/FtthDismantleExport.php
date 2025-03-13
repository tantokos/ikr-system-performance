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
                ->leftJoin('data_assign_tims as da', function ($join) {
                $join->on('d.no_wo','=','da.no_wo_apk');
                            $join->on('d.visit_date', '=', 'da.tgl_ikr');
                })
                ->select(
                DB::raw("'' as site"),
                'd.no_wo',
            'd.wo_date',
            'd.wo_type_apk',
            DB::raw("'' as sub_type_wo"),
            DB::raw("'' as remarks_wo"),
            'd.sesi',
            'd.no_ticket',
            'd.cust_id',
            'd.nama_cust',
            'd.cust_address1',
            'da.cust_mobile_apk',
            'd.kode_fat',
            'd.port_fat',
            'd.visit_date',
            'd.slot_time_leader',
            'd.checkin_apk',
            'd.selisih_menit',
            'd.status_checkin',
            'd.checkout_apk',
            'd.waktu_instalasi',
            'd.mttr_all',
            'd.mttr_pending',
            'd.mttr_progress',
            'd.mttr_technician',
            'd.sla_over',
            'd.cluster',
            'd.kotamadya',
            'd.main_branch',
            'd.kotamadya_penagihan',
            'd.callsign',
            'd.teknisi1',
            'd.teknisi2',
            'd.teknisi3',
            'd.leader',
            'd.login',
            DB::raw("'' as pic_pengecekan"),
            'd.status_apk',
            'd.status_wo',
            DB::raw("'' as rootcuase_penagihan"),
            'd.reason_status',
            DB::raw("'' as root_cause"),
            DB::raw("'' as action_taken"),
            DB::raw("'' as action_status"),
            DB::raw("'' as detail_alasan"),
            DB::raw("'' as status_visit"),
            'd.remarks',
            'd.reschedule_date',
            DB::raw("'' as respon_konfirmasi_cst"),
            DB::raw("'' as jawaban_konfirmasi_cst"),
            DB::raw("'' as permintaan_reschedule"),
            'd.pic_dispatch',
            DB::raw("'' as telpon_pic_dispatch"),
            DB::raw("'' as cek_telebot"),
            DB::raw("'' as hasil_pengecekan"),
            'd.weather',
            DB::raw("'' as validasi_start"),
            DB::raw("'' as validasi_end"),
            DB::raw("'' as start_regist"),
            DB::raw("'' as end_regist"),
            DB::raw("'' as kode_otp"),
            DB::raw("'' as pic_konfirmasi_cst"),
            DB::raw("'' as status_konfirmasi_cst"),
            DB::raw("'' as tgl_jam_konfirmasi_cst"),
            DB::raw("'' as selisih_menit_konfirmasi_cst"),
            DB::raw("'' as keterangan_konfirmasi_cst"),
            DB::raw("'' as waktu_keterlambatan_cst"),
            DB::raw("'' as bukti_konfirmasi"),
            DB::raw("'' as qty_material_out"),
            'd.material_in',

            DB::raw('(SELECT description FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_merk_out'),
            DB::raw('(SELECT sn FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_sn_out'),
            DB::raw('(SELECT mac_address FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%ONT%" LIMIT 1) as ont_mac_out'),
            DB::raw('(SELECT description FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_merk_in'),
            DB::raw('(SELECT sn FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_sn_in'),
            DB::raw('(SELECT mac_address FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%ONT%" LIMIT 1) as ont_mac_in'),

            DB::raw("'' as merk_router_out"),
            DB::raw("'' as sn_router_out"),
            DB::raw("'' as mac_router_out"),
            DB::raw("'' as merk_router_in"),
            DB::raw("'' as sn_router_in"),
            DB::raw("'' as mac_router_in"),

            DB::raw('(SELECT description FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_merk_out'),
            DB::raw('(SELECT sn FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_sn_out'),
            DB::raw('(SELECT mac_address FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%STB%" LIMIT 1) as stb_mac_out'),
            DB::raw('(SELECT description FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_merk_in'),
            DB::raw('(SELECT sn FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_sn_in'),
            DB::raw('(SELECT mac_address FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND description LIKE "%STB%" LIMIT 1) as stb_mac_in'),

            DB::raw("'' as remote_out"),
            DB::raw("'' as remote_in"),
            DB::raw("'' as dw_out"),
            DB::raw('(SELECT description FROM ftth_dismantle_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%PRECON%" LIMIT 1) as precon_out'),
            DB::raw("'' as precon_in"),
            DB::raw("'' as fast_connector"),
            DB::raw("'' as patchcord"),
            DB::raw("'' as terminal_box"),
            DB::raw("'' as kabel_utp"),
            DB::raw("'' as pipa"),
            DB::raw("'' as socket_pipa"),
            DB::raw("'' as cable_duct"),
            DB::raw("'' as rj_45"),
            DB::raw("'' as compare"),
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
            $datas = $datas->where('d.main_branch', $area[1]);
        }

        if($this->request->filleaderTim) {
            $leader = explode("|", $this->request->filleaderTim);
            $datas = $datas->where('leader', $leader[1]);
        }

        if($this->request->filcallsignTimid) {
            $callsign = explode("|", $this->request->filcallsignTimid);
            $datas = $datas->where('callsign', $callsign[1]);
        }

        if ($this->request->filGroup != null) {
            $group = $this->request->filGroup;

            $grupArea = DB::table('branches')
                ->where('grup_dismantle', 'like', '%' . $group . '%')
                ->pluck('nama_branch')
                ->toArray();

            $datas = $datas->whereIn('main_branch', $grupArea);
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
            'No WO',
            'WO Date',
            'Type WO',
            'Sub Type WO',
            'Remarks WO',
            'Sesi',
            'No Ticket',
            'Cust Id',
            'Nama Cust',
            'Alamat Customer',
            'No Hp',
            'Kode FAT',
            'Port FAT',
            'IKR Date',
            'SLot Time',
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
            'Status Progress',
            'Rootcause Penagihan',
            'Couse Code / Reason Status',
            'Root Cause',
            'Action Taken',
            'Action Status',
            'Detail Alasan',
            'Status Visit',
            'Remarks',
            'Tanggal & Jam Reschedule Customer',
            'Respon Konfirmasi Cst (Respon/Tidak Respon)',
            'Jawaban Konfirmasi Cst (Setuju/Tidak Setuju/No Respon)',
            'Permintaan Reschedule (Leader/Teknisi/Customer/Dispatch)',
            'Nama Dispatch Konfirmasi',
            'No Telp Dispatch Konfirmasi',
            'Cek Telebot',
            'Hasil Pengecekan Telebot',
            'Weather',
            'Start Validation',
            'End Validation',
            'Start Registration',
            'End Regist',
            'Kode OTP',
            'PIC Konfirmasi Cst',
            'Status Konfirmasi Customer',
            'Tgl IKR & Jam Konfirmasi Cst',
            '+/- Minute Konfirmasi',
            'Status Konfirmasi Cst',
            'Waktu Keterlambatan Konfirmasi',
            'Bukti Konfirmasi',
            'QTY Material Out',
            'QTY Material In',
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
            'Remote Out',
            'Remote In',
            'Aerial drop cable DW',
            'Precon Out',
            'Precon In',
            'Fast Connector',
            'Patch Cord',
            'Terminal Box',
            'Kabel UTP',
            'Pipa',
            'Socket Pipa',
            'Cable Duct',
            'RJ 45',
            'Compare',
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
