<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class FtthIbExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
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
            ->leftJoin('data_assign_tims as da', function ($join) {
            $join->on('d.no_wo','=','da.no_wo_apk');
                        $join->on('d.tgl_ikr', '=', 'da.tgl_ikr');
                                })
            ->select(
                'd.site',
                'd.no_wo',
                'd.wo_date_apk',
                'd.type_wo',
                'd.wo_type_apk',
                // 'd.wo_type_apk',
                // 'd.remarks_wo',
                'd.type_maintenance',
                'd.sesi',
                'd.no_ticket',
                'd.cust_id',
                'd.nama_cust',
                'd.cust_address1',
                'da.cust_mobile_apk',
                'd.kode_fat',
                'd.port_fat',
                'd.tgl_ikr',
                'd.slot_time_apk',
                'd.checkin_apk',
                // DB::raw('TIMESTAMPDIFF(MINUTE, d.checkin_apk, TIMESTAMP(d.tgl_ikr, d.slot_time_apk)) as selisih_menit'),
                // 'd.selisih_menit',
                DB::raw('"-" as minute'),
                'd.status_checkin',
                'd.checkout_apk',
                // DB::raw('
                //     CASE
                //         WHEN d.status_wo IN ("done", "checkout")
                //         THEN TIME_FORMAT(SEC_TO_TIME(TIMESTAMPDIFF(MINUTE, d.checkin_apk, d.checkout_apk) * 60), "%H:%i")
                //         ELSE "00:00"
                //     END as waktu_instalasi
                // '),
                // 'd.waktu_instalasi',
                DB::raw('"-" as waktu_Installasi'),
                'd.mttr_all',
                'd.mttr_pending',
                'd.mttr_progress',
                'd.mttr_technician',
                'd.sla_over',
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
                DB::raw("'' as pic_pengecekan"),
                'd.status_apk',
                'd.status_wo',
                'd.penagihan',
                'd.reason_status',
                DB::raw("'' as root_cause"),
                DB::raw("'' as action_taken"),
                DB::raw("'' as action_status"),
                'd.detail_alasan',
                DB::raw("'' as status_visit"),
                 'd.remarks_teknisi',
                DB::raw('concat_ws(" ", d.tgl_reschedule, d.tgl_jam_reschedule) as jadwal_reschedule'),
                'd.respon_konf_cst',
                'd.jawaban_konf_cst',
                'd.permintaan_reschedule',
                'd.nama_dispatch',
                'd.telp_dispatch',
                DB::raw("'' as cek_telebot"),
                DB::raw("'' as hasil_pengecekan"),
                'd.weather',
                'd.validasi_start',
                'd.validasi_end',
                'd.start_regist',
                'd.end_regist',
                DB::raw("'' as kode_otp"),
                DB::raw("'' as pic_konfirmasi_cst"),
                DB::raw("'' as status_konfirmasi_customer"),
                DB::raw("'' as tgl_jam_konfirmasi"),
                DB::raw("'' as selisih_menit_konfirmasi"),
                DB::raw("'' as status_konfirmasi_cst"),
                DB::raw("'' as waktu_keterlambatan_konfirmasi"),
                DB::raw("'' as bukti_konfirmasi"),
                'd.qty_material_out as material_out',
                'd.qty_material_in as material_in',
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
                DB::raw("'' as remot_out"),
                DB::raw("'' as remot_in"),
                'd.dw_out',
                DB::raw('(SELECT description FROM ftth_ib_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND description LIKE "%PRECON%" LIMIT 1) as precon_out'),
                DB::raw("'' as precon_in"),
                'd.fast_connector',
                'd.patchcord',
                'd.terminal_box',
                'd.kabel_utp',
                'd.pipa',
                'd.socket_pipa',
                'd.cable_duct',
                DB::raw("'' as precon_in"),
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
            $datas = $datas->where('d.branch', $area[1]);
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
                    ->where('grup_ib', 'like', '%'.$group.'%')
                    ->pluck('nama_branch') // Ambil langsung sebagai koleksi nilai
                    ->toArray(); // Ubah menjadi array agar bisa digunakan di whereIn()

            // if ($group == "Jabota") {
            //     $grupArea = ["Jakarta Timur", "Jakarta Selatan", "Bogor", "Tangerang"];
            // } else {
            //     $grupArea = DB::table('branches')
            //         ->where('grup_area', $group)
            //         ->pluck('nama_branch') // Ambil langsung sebagai koleksi nilai
            //         ->toArray(); // Ubah menjadi array agar bisa digunakan di whereIn()
            // }

            $datas = $datas->whereIn('d.branch', $grupArea);

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

        $datas = $datas->get();

        $collection = $datas->map(function ($item, $key) {
            $item->minute = '=IF(Q'.($key + 2).'="","No Checkin",(CONCATENATE(TEXT(O'.($key + 2).',"yyyy-mm-dd")&" "&TEXT(P'.($key + 2).',"hh:mm:ss"))-Q'.($key + 2).')*1440)';
            $item->status_checkin = '=IF(R'.($key + 2).'="No Checkin", "No Checkin",IF(R'.($key + 2).'<0,"Terlambat","On Time"))';
            $item->waktu_Installasi = '=IF(AND(AM'.($key + 2).'="Done",AL'.($key + 2).'="cancelled"),0,IF(OR(AM'.($key + 2).'="done",AM'.($key + 2).'="CHECKOUT"),(T'.($key + 2).'-Q'.($key + 2).'),0))';
            $item->material_in = '=COUNTA(BV'.($key + 2).',CB'.($key + 2).',CH'.($key + 2).',CL'.($key + 2).',CO'.($key + 2).')';
            $item->material_out = '=COUNTA(BS'.($key + 2).',BY'.($key + 2).',CE'.($key + 2).',CK'.($key + 2).',CM'.($key + 2).',CN'.($key + 2).',CP'.($key + 2).',CQ'.($key + 2).',CR'.($key + 2).',CS'.($key + 2).',CT'.($key + 2).',CU'.($key + 2).',CV'.($key + 2).',CW'.($key + 2).')';
            return $item;
        });

        // return $datas->get();
        return $collection;
    }

    public function headings(): array
    {
        return [
            'Site',
            'No Wo',
            'WO Date',
            'Type Wo',
            'Wo Type Apk',
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
            'Status Progress',
            'Root Cause Penagihan',
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
            'Hasil Pengecekan',
            'Weather',
            'Validasi Start',
            'Validasi End',
            'Start Regist',
            'End Regist',
            'Kode OTP',
            'PIC Konfirmasi Cst',
            'Status Konfirmasi Cst',
            'Tgl IKR & Jam Konfirmasi Cst',
            '+/- Minute Konfirmasi',
            'Keterangan Konfirmasi Cst',
            'Waktu Keterlambatan Konfirmasi',
            'Bukti Konfirmasi',
            'Qty Material Out',
            'Qty Material In',
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
            'Remot Out',
            'Remot In',
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
            'RJ45',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'R' => NumberFormat::FORMAT_NUMBER, // Format kolom D sebagai number
            'S' => NumberFormat::FORMAT_NUMBER, // Format kolom D sebagai number
            'U' => NumberFormat::FORMAT_DATE_TIME4, // Format kolom D sebagai time 24 jam
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
