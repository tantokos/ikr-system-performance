<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\DataAssignTim;
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

        // Ambil data dari tabel data_assign_tims
        $customers = DataAssignTim::all();

        // Loop melalui setiap pelanggan
        foreach ($customers as $customer) {
            // Format pesan
            $id = $customer->id;
            $message = $this->formatMessage($id,$customer);

            // Nomor tujuan (pastikan format internasional)
            $target = '62' . ltrim($customer->cust_phone_apk, '0'); // Format nomor HP

            // Kirim pesan menggunakan HTTP Client
            $response = Http::withHeaders([
                'Authorization' => $token, // Token API
            ])->post('https://api.fonnte.com/send', [
                'target' => $target, // Nomor tujuan
                'message' => $message, // Pesan
                'delay' => '10',
            ]);

            // Handle response (opsional)
            if ($response->successful()) {
                Log::info("Pesan berhasil dikirim ke {$customer->name_cust_apk} ({$target})");
            } else {
                Log::error("Gagal mengirim pesan ke {$customer->name_cust_apk} ({$target}): " . $response->body());
            }
        }

        return "Proses broadcast selesai.";
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

        if ($type_wo == 'FTTH Maintenance') {
            $header = 'Konfirmasi Penjadwalan Perbaikan';
        } elseif ($type_wo == 'FTTH Dismantle') {
            $header = 'Konfirmasi Penjadwalan Pengambilan';
        } elseif ($type_wo == 'FTTH New Installation') {
            $header = 'Konfirmasi Penjadwalan Pemasangan';
        } else {
            $header = 'Konfirmasi Penjadwalan';
        }


        // Format pesan
        return "{$header}\n\n" .
                "{$greeting} Pelanggan Setia Oxygen Home\n\n" .
               "Saat ini kami dalam proses konfirmasi untuk jadwal perbaikan perangkat dengan info sebagai berikut:\n\n" .
               "Nama: {$customer->name_cust_apk}\n" .
               "No ID: {$customer->cust_id_apk}\n" .
               "Alamat: {$customer->address_apk}\n" .
               "HP: {$customer->cust_phone_apk}\n" .
               "Hari/Tanggal: " . date('l, d F Y') . "\n" . // Format tanggal
               "Waktu: {$customer->slot_time}\n\n" .
               "Apabila jadwal tersebut di atas sudah sesuai, mohon konfirmasinya untuk kami proses lebih lanjut dengan kunjungan.\n" .
               "Jika terdapat perubahan jadwal kunjungan, mohon diinformasikan kepada kami kembali untuk penjadwalan ulang.\n\n" .
               "Terima kasih sudah menjadi pelanggan setia Oxygen Home.\n\n" .
               "Salam Hangat, " . Auth::user()->name;
    }

}
