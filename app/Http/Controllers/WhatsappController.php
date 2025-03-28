<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DataAssignTim;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WhatsappController extends Controller
{
    public function index()
    {
        return view('confirm-customer.index');
    }

    public function getDataCustomer(Request $request)
    {
        $akses = Auth::user()->name;

        $datas = DB::table('data_assign_tims')->orderBy('tgl_ikr', 'DESC');

            if($request->filTgl != null) {
                $dateRange = explode("-", $request->filTgl);
                $startDt = \Carbon\Carbon::parse($dateRange[0]);
                $endDt = \Carbon\Carbon::parse($dateRange[1]);

                $datas = $datas->whereBetween('tgl_ikr',[$startDt, $endDt]);
            }

            if($request->filNoWo != null) {
                $datas = $datas->where('no_wo_apk', $request->filNoWo);
            }
            if($request->filcustId != null) {
                $datas = $datas->where('cust_id_apk', $request->filcustId);
            }
            if($request->filNoWo != null) {
                $datas = $datas->where('no_wo_apk', $request->filNoWo);
            }
            if($request->filslotTime != null) {
                $datas = $datas->where('slot_time', $request->filslotTime);
            }

            $datas = $datas->get();

            // dd($datas);

        if ($request->ajax()) {

            return DataTables::of($datas)
                ->addIndexColumn() //memberikan penomoran
                ->editColumn('name_cust_apk', function ($nm) {
                    return Str::title($nm->name_cust_apk);
                })
                ->editColumn('wo_type_apk', function ($nm) {
                    return Str::title($nm->wo_type_apk);
                })
                ->editColumn('area_cluster_apk', function ($nm) {
                    return Str::title($nm->area_cluster_apk);
                })
                ->editColumn('branch', function ($nm) {
                    return Str::title($nm->branch);
                })
                ->addColumn('action', function ($row) {
                    $btn = '
                    <a href="javascript:void(0)" id="detail-assign" data-id="' . $row->id . '" class="btn btn-sm btn-primary detail-assign mb-0" >Detail</a>';
                    // <a href="javascript:void(0)" id="detail-lead" data-id="' . $row->lead_call_id . "|" . $row->branch_id . "|" . $row->leader_id . '" class="btn btn-sm btn-primary detil-lead mb-0" >Edit</a>';
                    //  <a href="#" class="btn btn-sm btn-secondary disable"> <i class="fas fa-trash"></i> Hapus</a>';
                    return $btn;
                })
                ->rawColumns(['action'])   //merender content column dalam bentuk html
                ->escapeColumns()  //mencegah XSS Attack
                ->toJson(); //merubah response dalam bentuk Json
            // ->make(true);
        }
    }

    public function sendBroadcast()
    {
        // Token API Fonnte (disimpan langsung di controller)
        $token = 'byTuouzHLvb3JTX7gtD4';

        $today = Carbon::today();
        $customers = DataAssignTim::whereDate('tgl_ikr', $today)
                    ->where('is_broadcast_sent', false)
                    ->get();

        foreach ($customers as $customer) {
            $id = $customer->id;
            $message = $this->formatMessage($id,$customer);

            $target = '62' . ltrim($customer->cust_phone_apk, '0'); // Format nomor HP

            $response = Http::withHeaders([
                'Authorization' => $token, // Token API
            ])->post('https://api.fonnte.com/send', [
                'target' => $target, // Nomor tujuan
                'message' => $message, // Pesan
                'delay' => '5',
            ]);

            if ($response->successful()) {
                DB::transaction(function () use ($customer) {
                    $customer->is_broadcast_sent = true;
                    $customer->save();
                });

                Log::info("Pesan berhasil dikirim ke {$customer->name_cust_apk} ({$target})");
            } else {
                Log::error("Gagal mengirim pesan ke {$customer->name_cust_apk} ({$target}): " . $response->body());
            }
            // dd(json_decode($response->body()));
        }


        return redirect()->back()->with('success', 'Broadcast berhasil dikirim');
    }

    /**
     * Format pesan sesuai dengan template yang diberikan.
     *
     * @param \App\Models\DataAssignTim $customer
     * @return string
     */
    private function formatMessage($id, $customer)
    {
        // Tentukan waktu (pagi/siang/sore) berdasarkan jam
        $time = date('H');
        $dataAssignTim = DataAssignTim::find($id);

        if ($time >= 5 && $time < 11) {
            $greeting = 'Selamat Pagi';
        } elseif ($time >= 11 && $time < 15) {
            $greeting = 'Selamat Siang';
        } else {
            $greeting = 'Selamat Sore';
        }

        if (!$dataAssignTim) {
            return 'Data tidak ditemukan';
        }

        $type_wo = $dataAssignTim->type_wo;

        $headerMap = [
            'FTTH Maintenance' => '🔧 Konfirmasi Penjadwalan Perbaikan',
            'FTTH Dismantle' => '🚚 Konfirmasi Penjadwalan Pengambilan',
            'FTTH New Installation' => '💻 Konfirmasi Penjadwalan Pemasangan'
        ];

        $header = $headerMap[$type_wo] ?? '📅 Konfirmasi Penjadwalan';


        $hari = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu',
        ];

        $bulan = [
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember',
        ];

        $hariIndonesia = $hari[date('l')];
        $bulanIndonesia = $bulan[date('F')];
        $tanggalIndonesia = "$hariIndonesia, " .date('d') . " $bulanIndonesia " . date("Y");

        $formattedPhone = '62' . ltrim($customer->cust_phone_apk, '0');

        return <<<MSG

        {$header}

        {$greeting} Pelanggan Setia Oxygen Home,

        Saat ini kami dalam proses konfirmasi untuk jadwal perbaikan perangkat dengan info sebagai berikut:

        ▫️ *Nama*: {$customer->name_cust_apk}
        ▫️ *ID Pelanggan*: {$customer->cust_id_apk}
        ▫️ *Alamat*: {$customer->address_apk}
        ▫️ *Kontak*: {$formattedPhone}
        ▫️ *Tanggal*: {$tanggalIndonesia}
        ▫️ *Waktu*: {$customer->slot_time}

        *Konfirmasi*:
        ✅ Balas "Ya" jika jadwal sesuai
        🔄 Balas "Ubah" untuk ubah jadwal
        ❌ Balas "Batal" jika ingin membatalkan jadwal

        Terima kasih sudah menjadi pelanggan setia Oxygen Home

        Salam hangat,
        Tim Layanan Pelanggan
        📞 1500 882 (Customer Service)
        "📱 https://wa.me/6287750301112"
        🌐 https://home.oxygen.id/
        MSG;
    }

}
