<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\ImportAssignTeamFttx;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AssignTeamFttxImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $logId, $logNm;

    function __construct($akses)
    {
        $dtLogin = explode("|", $akses);
        $loginId = $dtLogin[0];
        $loginNm = $dtLogin[1];
        $this->logId = $loginId;
        $this->logNm = $loginNm;
    }
    public function model(array $row)
    {
        if(!array_filter($row)) {
            return null;
        }

        if (empty($row['no_so'])) {
            return null;
        }

        return new ImportAssignTeamFttx([
            'no_so' => Str::trim($row['no_so']),
            'so_date' => Str::trim($row['so_date']),
            'customer_name' => Str::trim($row['customer_name']),
            'address' => Str::trim($row['address']),
            'pic_customer' => Str::trim($row['pic_cst']),
            'phone_pic_cust' => Str::trim($row['phone_pic_cust']),
            'wo_type' => Str::trim($row['wo_type']),
            'product' => Str::trim($row['product']),
            'remark_ewo' => Str::trim($row['remark_ewo']),
            'cid' => Str::trim($row['cid']),
            'segment_sales' => Str::trim($row['segment_sales']),
            'area' => Str::trim($row['area']),
            'jadwal_ikr' => Str::trim($row['jadwal_ikr']),
            'slot_time_jadwal' => Str::trim($row['slot_time_jadwal']),
            'remark_for_ikr' => Str::trim($row['remark_for_ikr']),
            'status_penjadwalan' => Str::trim($row['status_penjadwalan']),
            'vendor' => Str::trim($row['vendor']),
            'branch' => Str::trim($row['branch']),
            'leader' => Str::trim($row['leader']),
            'callsign' => Str::trim($row['callsign']),
            'tim_1' => Str::trim($row['tim_1']),
            'tim_2' => Str::trim($row['tim_2']),
            'tim_3' => Str::trim($row['tim_3']),
            'nopol' => Str::trim($row['nopol']),
            'perubahan_slot_time_tele' => Str::trim($row['perubahan_slot_time_tele']),
            'checkin' => Str::trim($row['checkin']),
            'checkout' => Str::trim($row['checkout']),
            'status_wo' => Str::trim($row['status_wo']),
            'keterangan_wo' => Str::trim($row['keterangan_wo']),
            'login_id' => $this->logId,
            'login' => $this->logNm
        ]);

    }

    public function startRow(): int
    {
        return 2;
    }

    public function get_data_id($kolom, $data)
    {
        switch ($kolom) {
            case "branch_id":
                $branchID = DB::table('branches')->select('id')->where('nama_branch', $data)->first();
                return is_null($branchID) ? null : $branchID->id;
                break;

            case "branch":
                $branch = DB::table('branches')->select('nama_branch')->where('nama_branch', $data)->first();
                return is_null($branch) ? null : $branch->nama_branch;
                break;

            case "leadcall_id":
                $leadcall_id = DB::table('v_detail_callsign_tim')->select('lead_call_id')->where('nama_leader', $data)->first();
                $leadCallID= is_null($leadcall_id) ? null : $leadcall_id->lead_call_id;
                return $leadCallID;
                break;

            case "leadcall":
                $leadcall = DB::table('v_detail_callsign_tim')->select('lead_callsign')->where('nama_leader', $data)->first();
                $leadCallsign =  is_null($leadcall) ? null : $leadcall->lead_callsign;
                return $leadCallsign;
                break;

            case "leader_id":
                $leader_id = DB::table('v_detail_callsign_tim')->select('leader_id')->where('nama_leader', $data)->first();
                $leaderID= is_null($leader_id) ? null : $leader_id->leader_id;
                return $leaderID;
                break;

            case "callsign_id":
                $callsign_id = DB::table('v_detail_callsign_tim')->select('callsign_tim_id')->where('callsign_tim', $data)->first();
                // $leaderID= is_null($leader_id) ? "-" : $leader_id->leader_id;
                return is_null($callsign_id) ?  null : $callsign_id->callsign_tim_id;
                break;

            case "tek1_nik":
                $tek1_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                // dd(is_null($tek1_nik));
                $tek1Nik = is_null($tek1_nik) ? null : $tek1_nik->nik_karyawan;
                return $tek1Nik;

                break;

            case "tek2_nik":
                $tek2_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                $tek2Nik = is_null($tek2_nik) ? null : $tek2_nik->nik_karyawan;
                return $tek2Nik;
                break;

            case "tek3_nik":
                $tek3_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                $tek3Nik = is_null($tek3_nik) ? null : $tek3_nik->nik_karyawan;
                return $tek3Nik;
                break;

            case "tek4_nik":
                $tek4_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                $tek4Nik = is_null($tek4_nik) ? null : $tek4_nik->nik_karyawan;
                return $tek4Nik;
                break;
            case "type_wo":
                $tp_wo = DB::table('type_wo')->select('type_wo')->where('type_wo_apk', $data)->first();
                $typeWo = is_null($tp_wo) ? null : $tp_wo->type_wo;
                return $typeWo;
                break;

        }
    }
}
