<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class FtthMtExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
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
        ->leftJoin('data_assign_tims as dt', function ($join) {
            $join->on('d.no_wo','=','dt.no_wo_apk');
            $join->on('d.tgl_ikr', '=', 'dt.tgl_ikr');
        })
        ->select(
            'd.site_penagihan',
            'd.no_wo',       
            'd.wo_date_apk',
            'd.type_wo',
            'd.wo_type_apk',                 
            'd.type_maintenance',
            'd.sesi',
            'd.no_ticket',
            'd.cust_id',
            'd.nama_cust',
            'd.cust_address1',
            'dt.cust_phone_apk',            
            'd.kode_fat',
            'd.port_fat',
            'd.tgl_ikr',
            'd.slot_time_apk',
            'd.checkin_apk',
            DB::raw('"-" as minute'),
            DB::raw('"-" as status_checkin'),
            'd.checkout_apk',
            DB::raw('"-" as waktu_Installasi'),
            'd.mttr_all',
            'd.mttr_pending',
            'd.mttr_progress',
            'd.mttr_teknisi',
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
            DB::raw('"-" as pic_pengecekan'),
            'd.status_apk',
            'd.status_wo',
            'd.penagihan',
            'd.couse_code',
            'd.root_couse',
            'd.action_taken',
            'd.action_status',
            'd.detail_alasan',
            'd.visit_novisit',
            'd.keterangan',
            DB::raw('concat_ws(" ", d.tgl_reschedule, d.tgl_jam_reschedule) as jadwal_reschedule'),
            'd.respon_cst',
            'd.jawaban_cst',
            'd.permintaan_rsch',
            'd.dispatch',
            'd.telp_dispatch',
            'd.cek_telebot',
            'd.hasil_cek_telebot',
            'd.weather',
            'd.validasi_start',
            'd.validasi_end',
            'd.regist_start',
            'd.regist_end',
            'd.kode_otp',
            'd.pic_konf_cst',
            DB::raw('d.konfirmasi_customer as status_konf_cst'),
            DB::raw('concat_ws(" ", d.tgl_konf_cst, d.jam_konf_cst) as tgl_jam_konf_cst'),
            DB::raw('"-" as menit_konf_cst'),
            DB::raw('"-" as ket_konf_cst'),
            DB::raw('"-" as terlambat_konf_cst'),
            DB::raw('d.bukti_konf_cst as bukti_konf_cst'),
            'd.material_out',
            'd.material_in',
                  
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "ONT" LIMIT 1) as ont_merk_out'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "ONT" LIMIT 1) as ont_sn_out'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "ONT" LIMIT 1) as ont_mac_out'),
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "ONT" LIMIT 1) as ont_merk_in'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "ONT" LIMIT 1) as ont_sn_in'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "ONT" LIMIT 1) as ont_mac_in'),

            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Router" LIMIT 1) as router_merk_out'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Router" LIMIT 1) as router_sn_out'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Router" LIMIT 1) as router_mac_out'),
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "Router" LIMIT 1) as router_merk_in'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "Router" LIMIT 1) as router_sn_in'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "Router" LIMIT 1) as router_mac_in'),

            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "STB" LIMIT 1) as stb_merk_out'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "STB" LIMIT 1) as stb_sn_out'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "STB" LIMIT 1) as stb_mac_out'),
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "STB" LIMIT 1) as stb_merk_in'),
            DB::raw('(SELECT sn FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "STB" LIMIT 1) as stb_sn_in'),
            DB::raw('(SELECT mac_address FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "STB" LIMIT 1) as stb_mac_in'),

            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Remote" LIMIT 1) as remote_out'),
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "IN" AND kategori_material = "Remote" LIMIT 1) as remote_in'),

            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "DW" LIMIT 1) as dw_out'),
            DB::raw('(SELECT description FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Precon" LIMIT 1) as precon_out'),
            'd.bad_precon',

            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Fast Connector" LIMIT 1) as fastConnector'),
            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Patchcord" LIMIT 1) as patchcord'),
            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Terminal Box" LIMIT 1) as terminal_box'),
            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "UTP Box" LIMIT 1) as kabel_utp'),
            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "PVC Pipe Box" LIMIT 1) as pipa'),
            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Socket Pipe" LIMIT 1) as socket_pipa'),
            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "Cable Duct" LIMIT 1) as cable_duct'),
            DB::raw('(SELECT qty FROM ftth_materials WHERE wo_no = d.no_wo AND status_item = "OUT" AND kategori_material = "RJ45" LIMIT 1) as rj45'),

            'd.is_checked',
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
            $datas = $datas->where('d.no_wo', 'like', '%' . $this->request->filnoWo . '%');
        }

        if($this->request->filcustId) {
            $datas = $datas->where('d.cust_id', 'like', '%' . $this->request->filcustId . '%');
        }

        if($this->request->filstatusWo) {
            $datas = $datas->where('d.status_wo', $this->request->filstatusWo);
        }

        if($this->request->filarea) {
            $area = explode("|", $this->request->filarea);
            $datas = $datas->where('d.branch', $area[1]);
        }

        if($this->request->filGroup) {
            $branchList = DB::table('branches')->where('grup_area',$this->request->filGroup)
                        ->select('nama_branch')->pluck('nama_branch')->toArray();

            // $List = Arr::join($branchList, ', ');

            // $area = explode("|", $this->request->filarea);
            $datas = $datas->whereIn('d.branch', $branchList);
        }

        if($this->request->filleaderTim) {
            $leader = explode("|", $this->request->filleaderTim);
            $datas = $datas->where('d.leader', $leader[1]);
        }

        if($this->request->filcallsignTimid) {
            $callsign = explode("|", $this->request->filcallsignTimid);
            $datas = $datas->where('d.callsign', $callsign[1]);
        }

        if($this->request->filteknisi) {
            $teknisi = explode("|", $this->request->filteknisi);
            $nikTk = $teknisi[0];
            $datas = $datas->where(function($query) use ($nikTk) {
                $query->where('d.tek1_nik', $nikTk)
                      ->orWhere('d.tek2_nik', $nikTk)
                      ->orWhere('d.tek3_nik', $nikTk)
                      ->orWhere('d.tek4_nik', $nikTk);
            });
        }

        if($this->request->filcluster) {
            $datas = $datas->where('d.cluster', $this->request->filcluster);
        }

        if($this->request->filfatCode) {
            $datas = $datas->where('d.kode_fat', 'like', '%' . $this->request->filfatCode . '%');
        }

        if($this->request->filslotTime) {
            $datas = $datas->where('d.slot_time', $this->request->filslotTime);
        }

        $datas=$datas->get();

        $collection = $datas->map(function ($item, $key) {
            $item->minute = '=IF(Q'.($key + 2).'="","No Checkin",(CONCATENATE(TEXT(O'.($key + 2).',"yyyy-mm-dd")&" "&TEXT(P'.($key + 2).',"hh:mm:ss"))-Q'.($key + 2).')*1440)';
            $item->status_checkin = '=IF(R'.($key + 2).'="No Checkin", "No Checkin",IF(R'.($key + 2).'<0,"Terlambat","On Time"))';
            $item->waktu_Installasi = '=IF(AND(AM'.($key + 2).'="Done",AL'.($key + 2).'="cancelled"),0,IF(OR(AM'.($key + 2).'="done",AM'.($key + 2).'="CHECKOUT"),(T'.($key + 2).'-Q'.($key + 2).'),0))';
            $item->material_in = '=COUNTA(BV'.($key + 2).',CB'.($key + 2).',CH'.($key + 2).',CL'.($key + 2).',CO'.($key + 2).')';
            $item->material_out = '=COUNTA(BS'.($key + 2).',BY'.($key + 2).',CE'.($key + 2).',CK'.($key + 2).',CM'.($key + 2).',CN'.($key + 2).',CP'.($key + 2).',CQ'.($key + 2).',CR'.($key + 2).',CS'.($key + 2).',CT'.($key + 2).',CU'.($key + 2).',CV'.($key + 2).',CW'.($key + 2).')';
            $item->menit_konf_cst = '=(BL'.($key + 2).'-(CONCATENATE(TEXT(O'.($key + 2).',"yyyy-mm-dd")&" "&TEXT(P'.($key + 2).',"hh:mm:ss"))))*1440';
            $item->ket_konf_cst = '=IF(BM'.($key + 2).'<=-60,"LEBIH AWAL",IF(BM'.($key + 2).'<=0,"ONTIME","TERLAMBAT"))';
            $item->terlambat_konf_cst = '=IF(BN'.($key + 2).'="TERLAMBAT",IF(AND(BM'.($key + 2).'>=1,BM'.($key + 2).'<=10),"< 10 Menit",IF(AND(BM'.($key + 2).'>=11,BM'.($key + 2).'<=30),"< 30 Menit",IF(AND(BM'.($key + 2).'>=31,BM'.($key + 2).'<=60),"< 1 Jam",IF(AND(BM'.($key + 2).'>=61,BM'.($key + 2).'<=90)," < 1,5 Jam",IF(BM'.($key + 2).'>=91,"> 2 Jam"))))),"-")';
            return $item;
        });

        // dd($datas);

        // return $datas->get();

        return $collection;
    }

    public function headings(): array
    {
        return [
            'Site',
            'No WO',
            'WO Date',
            'Type WO',
            'Sub Type WO',
            'Rekarks WO',
            'Sesi',
            'No Ticket',
            'Cust ID',
            'Nama Cust',
            'Alaamat',
            'No HP',
            'Kode FAT',
            'Port FAT',
            'IKR Date',
            'Slot time',
            'Checkin APK',
            '+- Minute',
            'Status Checkin',
            'Checkout APK',
            'Waktu Instalasi (APK)',
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
            'Teknisi1',
            'Teknisi2',
            'Teknisi3',
            'Leader',
            'PIC Monitoring',
            'PIC Pengecekan',
            'Status APK',
            'Status Progress',
            'Rootcouse Penagihan',
            'Couse Code',
            'Root Couse',
            'Action Taken',
            'Action Status',
            'Detail Alasan',
            'Status Visit',
            'Remarks',
            'Tgl & Jam Reschedule',
            'Respon Konf Cst',
            'Jawaban Konf',
            'Permintaan Reschedule',
            'Nama Dispatch',
            'Telp Dispatch',
            'Cek Telebot',
            'Hasil Pengecekan',
            'Weather',
            'Start Validasi',
            'End Validasi',
            'Start Regist',
            'End Regist',
            'Kode OTP',   
            'PIC Konf Cst',
            'Status Konf Cst',
            'Tgl & Jam Konf Cst',
            '+- Menit Konf CST',
            'Ket Konf Cst',
            'Keterlambatan Konf Cst',
            'Bukti Konfirmasi',
            'Qty Material Out',
            'Qty Material In',
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
            'Remote Out',
            'Remote In',
            'Dw Out',
            'Precon Out',
            'Precon In',
            'Fast Connector',
            'Patchcord',
            'Terminal Box',
            'Kabel UTP',
            'Pipa PVC',
            'Socket Pipa',
            'Cable Duct',
            'RJ 45',
            'Is Checked',
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
                        'argb' => 'FF0000', // Background biru
                    ],
                ],
            ],
        ];
    }
}
