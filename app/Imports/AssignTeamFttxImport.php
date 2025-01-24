<?php

namespace App\Imports;

use Illuminate\Support\Str;
use App\Models\ImportAssignTeamFttx;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use \PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class AssignTeamFttxImport implements ToModel, WithHeadingRow,  WithValidation, SkipsEmptyRows
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

        $ikrDate = $row['jadwal_ikr'];
        if (is_numeric($ikrDate)) {
            $formattedDate = Date::excelToDateTimeObject($ikrDate)->format("Y-m-d");
        } else {
            $parsedDate = \DateTime::createFromFormat('d/m/Y', $ikrDate)
                ?: \DateTime::createFromFormat('d-m-Y', $ikrDate)
                ?: \DateTime::createFromFormat('Y-m-d', $ikrDate);

            if ($parsedDate) {
                $formattedDate = $parsedDate->format('Y-m-d');
            } else {
                throw new \Exception("Format tanggal IKR tidak valid: " . $ikrDate);
            }
        }

        $soDate = $row['so_date'];
        if (is_numeric($soDate)) {
            $formattedDateSo = Date::excelToDateTimeObject($soDate)->format("Y-m-d");
        } else {
            $parsedDate = \DateTime::createFromFormat('d/m/Y', $soDate)
                ?: \DateTime::createFromFormat('d-m-Y', $soDate)
                ?: \DateTime::createFromFormat('Y-m-d', $soDate);

            if ($parsedDate) {
                $formattedDateSo = $parsedDate->format('Y-m-d');
            } else {
                throw new \Exception("Format tanggal IKR tidak valid: " . $soDate);
                $formattedDateSo = $soDate;
            }
        }

        return new ImportAssignTeamFttx([
            'no_so' => Str::trim($row['no_so']),
            'so_date' => $formattedDateSo, // Str::trim($row['so_date']),
            'customer_name' => Str::trim($row['customer_name']),
            'address' => Str::trim($row['address']),
            'pic_customer' => Str::trim($row['pic_cst']),
            'phone_pic_cust' => Str::trim($row['phone_pic_cust']),
            'wo_type' => ((Str::trim(strtoupper($row['wo_type'])) == "NEW INSTALLATION" || Str::trim(strtoupper($row['wo_type'])) == "NEW LINK")) ? "FTTX New Installation" : (Str::trim(strtoupper($row['wo_type'])) == "MAINTENANCE" ? "FTTX Maintenance" : null),
            'product' => Str::trim($row['product']),
            'remark_ewo' => Str::trim($row['remark_ewo']),
            'cid' => Str::trim($row['cid']),
            'segment_sales' => Str::trim($row['segment_sales']),
            'area' => Str::trim($row['area']),
            'jadwal_ikr' => $formattedDate, // Str::trim($row['jadwal_ikr']),
            'slot_time_jadwal' => Str::trim($row['slot_time_jadwal']),
            'remark_for_ikr' => Str::trim($row['remark_for_ikr']),
            'status_penjadwalan' => Str::trim($row['status_penjadwalan']),
            'vendor' => Str::trim($row['vendor']),
            'branch_id' => $this->get_data_id("branch_id", Str::trim(Str::title($row['branch']))),
            'branch' => $this->get_data_id("branch", Str::trim(Str::title($row['branch']))),
            'leadcall_id' => $this->get_data_id("leadcall_id", Str::trim(Str::title($row['leader']))),
            'leadcall' => $this->get_data_id("leadcall", Str::trim(Str::title($row['leader']))),
            'leader_id' => $this->get_data_id("leader_id", Str::trim(Str::title($row['leader']))),
            'leader' => Str::trim(Str::title($row['leader'])),
            'callsign_id' => $this->get_data_id("callsign_id", Str::trim($row['callsign'])),
            'callsign' => Str::trim($row['callsign']),
            'tek1_nik' => $this->get_data_id("tek1_nik", Str::trim(Str::title($row['tim_1']))),
            'tim_1' => $this->get_data_id("tek1_nik", $row['tim_1']) == null ? null : Str::trim(Str::title($row['tim_1'])),
            'tek2_nik'=> $this->get_data_id("tek2_nik", Str::trim($row['tim_2'])),
            'tim_2' => $this->get_data_id("tek2_nik", $row['tim_2']) == null ? null : Str::trim(Str::title($row['tim_2'])),
            'tek3_nik' => $this->get_data_id("tek3_nik", Str::trim($row['tim_3'])),
            'tim_3' => $this->get_data_id("tek3_nik", $row['tim_3']) == null ? null : Str::trim(Str::title($row['tim_3'])),
            'tek4_nik' => $this->get_data_id("tek4_nik", Str::trim($row['tim_4'])),
            'tim_4' => $this->get_data_id("tek4_nik", $row['tim_4']) == null ? null : Str::trim(Str::title($row['tim_4'])),
            'nopol' => Str::trim($row['nopol']),
            // 'perubahan_slot_time_tele' => Str::trim($row['perubahan_slot_time_tele']),
            // 'checkin' => Str::trim($row['checkin']),
            // 'checkout' => Str::trim($row['checkout']),
            // 'status_wo' => Str::trim($row['status_wo']),
            // 'keterangan_wo' => Str::trim($row['keterangan_wo']),
            'login_id' => $this->logId,
            'login' => $this->logNm
        ]);

    }

    public function rules(): array
    {
        return [
            '*.no_so' => ['required', Rule::unique('import_assign_tims', 'no_wo_apk')],
            '*.wo_type' => ['required', Rule::exists('type_wo','type_wo_apk')],
            '*.branch' => ['required', Rule::exists('branches', 'nama_branch')],
            '*.leader' => ['required', Rule::exists('v_detail_callsign_tim','nama_leader')],
            '*.tim_1' => [Rule::exists('employees','nama_karyawan')],
            '*.tim_2' => ['nullable', Rule::exists('employees','nama_karyawan')],
            '*.tim_3' => ['nullable', Rule::exists('employees','nama_karyawan')],
            '*.tim_4' => ['nullable', Rule::exists('employees','nama_karyawan')],
            '*.callsign' => ['required'],
            '*.jadwal_ikr' => [
                'required',
                function ($attribute, $value, $fail) {
                    try {
                        $date = null;

                        // Jika nilai berupa angka (Excel datetime)
                        if (is_numeric($value)) {
                            $date = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
                        } else {
                            // Jika nilai berupa string, coba parsing dengan berbagai format
                            $formats = ['d/m/Y', 'd-m-Y', 'Y-m-d'];
                            foreach ($formats as $format) {
                                $parsedDate = \DateTime::createFromFormat($format, $value);
                                if ($parsedDate !== false) {
                                    $date = $parsedDate->format('Y-m-d');
                                    break;
                                }
                            }
                        }

                        // Jika konversi gagal
                        if (!$date) {
                            $fail("Format tanggal $attribute tidak valid. Gunakan format d/m/Y, d-m-Y, Y-m-d, atau Excel date.");
                            return;
                        }

                        // Validasi tanggal tidak boleh di masa lalu
                        if (\Carbon\Carbon::parse($date)->isBefore(\Carbon\Carbon::today())) {
                            $fail("Tanggal $attribute tidak boleh di masa lalu.");
                        }
                    } catch (\Exception $e) {
                        $fail("Format tanggal $attribute tidak valid.");
                    }
                }
            ],
        ];
    }

    public function customValidationMessages()
    {
        return [
            // '*.wo_no.unique' => 'No WO sudah ada di database',
            '*.leader' => 'Nama Leader tidak terdaftar',
            '*.wo_no.required' => 'No WO harus diisi',
            '*.branch.required' => 'Branch harus diisi',
            '*.callsign.required' => 'Callsign harus diisi',
            '*.ikr_date.required' => 'Tanggal IKR harus diisi',
        ];
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
                if(strtoupper(substr($data,0,4))=="LEAD") {
                    $callsign_id = DB::table('callsign_leads as cl')
                        ->leftJoin('employees as e','cl.leader_id', '=', 'e.nik_karyawan')
                        ->select('cl.id as callsign_tim_id')
                        ->where('lead_callsign', $data)->first();
                } else {
                    $callsign_id = DB::table('v_detail_callsign_tim')->select('callsign_tim_id')->where('callsign_tim', $data)->first();
                }
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
