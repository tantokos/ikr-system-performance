<?php

namespace App\Imports;

use App\Models\ImportAssignTim;
use Illuminate\Database\Query\Builder;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\DB;

class AssignWoImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation
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

        $tm = intval($row['time']);

        return new ImportAssignTim([


            'batch_wo' => $row['sesi'],
            // 'tgl_ikr' => ,
            'no_wo_apk' => $row['wo_no'],
            'no_ticket_apk' => $row['ticket_no'],
            'wo_type_apk' => Str::title($row['wo_type']),

            'type_wo' => Str::upper($row['wo_type'])=="MAINTENANCE" || Str::upper($row['wo_type'])=="REMOVE DEVICE" || Str::upper($row['wo_type'])=="ADD DEVICE" || Str::upper($row['wo_type'])=="ADD / REMOVE DEVICE" || Str::upper($row['wo_type'])=="PENDING DEVICE" ? "FTTH Maintenance" : (Str::upper($row['wo_type'])=="NEW INSTALLATION" || Str::upper($row['wo_type'])=="RELOCATION" ? "FTTH New Installation" : (Str::upper($row['wo_type'])=="DISMANTLE" ? "FTTH Dismantle" : "-")),

            'wo_date_apk' => $row['wo_date'],
            'cust_id_apk' => $row['cust_id'],
            'name_cust_apk' => Str::title($row['name']),
            'cust_phone_apk' => $row['cust_phone'],
            'cust_mobile_apk' => $row['cust_mobile'],
            'address_apk' => Str::title($row['address']),
            'area_cluster_apk' => Str::title($row['area']),
            'fat_code_apk' => $row['fat_code'],
            'fat_port_apk' => $row['fat_port'],
            'remarks_apk' => Str::title($row['remarks']),
            'vendor_installer_apk' => Str::title($row['vendor_installer']),
            // 'ikr_date_apk' => Date::excelToDateTimeObject($row['ikr_date'])->format("Y-m-d"),
            // 'time_apk' => Date::excelToDateTimeObject($row['time'])->format("H:i"),

            'tgl_ikr' => Date::excelToDateTimeObject($row['ikr_date'])->format("Y-m-d"),
            'slot_time' => is_string($row['time']) ? \Carbon\Carbon::createFromFormat('H:i', $row['time'])->format('H:i') : Date::excelToDateTimeObject($row['time'])->format("H:i"),
            'time_apk' => is_string($row['time']) ? \Carbon\Carbon::createFromFormat('H:i', $row['time'])->format('H:i') : Date::excelToDateTimeObject($row['time'])->format("H:i"),

            'branch_id' => $this->get_data_id("branch_id", $row['branch']),
            'branch' => $this->get_data_id("branch", $row['branch']),
            'leadcall_id' => $this->get_data_id("leadcall_id", $row['leader']),
            'leadcall' => $this->get_data_id("leadcall", $row['leader']),
            'leader_id' => $this->get_data_id("leader_id", $row['leader']),
            'leader' => $row['leader'],
            'callsign_id' => $this->get_data_id("callsign_id", $row['callsign']),
            'callsign' => $row['callsign'],
            'tek1_nik' => $this->get_data_id("tek1_nik", $row['tim_1']),
            'teknisi1' => $this->get_data_id("tek1_nik", $row['tim_1']) == "-" ? "-" : $row['tim_1'],
            'tek2_nik'=> $this->get_data_id("tek2_nik", $row['tim_2']),
            'teknisi2' => $this->get_data_id("tek2_nik", $row['tim_2']) == "-" ? "-" : $row['tim_2'],
            'tek3_nik' => $this->get_data_id("tek3_nik", $row['tim3']),
            'teknisi3' => $this->get_data_id("tek3_nik", $row['tim3']) == "-" ? "-" : $row['tim3'],
            'login_id' => $this->logId,
            'login' => $this->logNm
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function rules(): array
    {
        return [
            'no_wo_apk' => Rule::unique('import_assign_tims', 'no_wo_apk')
            // 'wo_no' => Rule::unique('import_assign_tims', 'wo_no')->where(fn (Builder $query) => $query->where('tgk_ikr', 'satu'))
        ];
    }

    public function customValidationMessages()
    {
        return [
            'no_wo_apk.unique' => 'Duplicate',
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function get_data_id($kolom, $data)
    {
        // dd($kolom, $data);

        // try {

            switch ($kolom) {
                case "branch_id":
                    $branchID = DB::table('branches')->select('id')->where('nama_branch', $data)->first();
                    return is_null($branchID) ? "-" : $branchID->id;
                    break;

                case "branch":
                    $branch = DB::table('branches')->select('nama_branch')->where('nama_branch', $data)->first();
                    return is_null($branch) ? "-" : $branch->nama_branch;
                    break;

                case "leadcall_id":
                    $leadcall_id = DB::table('v_detail_callsign_tim')->select('lead_call_id')->where('nama_leader', $data)->first();
                    $leadCallID= is_null($leadcall_id) ? "-" : $leadcall_id->lead_call_id;
                    return $leadCallID;
                    break;

                case "leadcall":
                    $leadcall = DB::table('v_detail_callsign_tim')->select('lead_callsign')->where('nama_leader', $data)->first();
                    $leadCallsign =  is_null($leadcall) ? "-" : $leadcall->lead_callsign;
                    return $leadCallsign;
                    break;

                case "leader_id":
                    $leader_id = DB::table('v_detail_callsign_tim')->select('leader_id')->where('nama_leader', $data)->first();
                    $leaderID= is_null($leader_id) ? "-" : $leader_id->leader_id;
                    return $leaderID;
                    break;

                case "callsign_id":
                    $callsign_id = DB::table('v_detail_callsign_tim')->select('callsign_tim_id')->where('callsign_tim', $data)->first();
                    // $leaderID= is_null($leader_id) ? "-" : $leader_id->leader_id;
                    return is_null($callsign_id) ?  "-" : $callsign_id->callsign_tim_id;
                    break;

                case "tek1_nik":
                    $tek1_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->first();
                    // dd(is_null($tek1_nik));
                    $tek1Nik = is_null($tek1_nik) ? "-" : $tek1_nik->nik_karyawan;
                    return $tek1Nik;

                    break;

                case "tek2_nik":
                    $tek2_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->first();
                    $tek2Nik = is_null($tek2_nik) ? "-" : $tek2_nik->nik_karyawan;
                    return $tek2Nik;
                    break;

                case "tek3_nik":
                    $tek3_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->first();
                    $tek3Nik = is_null($tek3_nik) ? "-" : $tek3_nik->nik_karyawan;
                    return $tek3Nik;
                    break;

                    // dd($branch);
            }


        // } catch (\Exception $e) {
            // DB::rollBack();
            // return $e->getMessage();
            // return redirect()->route('importDataWo')
                // ->with(['error' => 'Gagal Import Assign Tim: ' . $e->getMessage()]);
        // }


    }

    private function convertTime($time)
    {

        // Adjust based on how time is formatted in your Excel file
        dump($time);
        // return \Carbon\Carbon::createFromFormat('H:i', $time)->toTimeString();
    }
}
