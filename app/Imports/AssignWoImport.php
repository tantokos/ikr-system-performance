<?php

namespace App\Imports;

use App\Models\ImportAssignTim;
use Carbon\Carbon;
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
use Illuminate\Validation\Rules\ExcludeIf;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Illuminate\Support\Arr;

class AssignWoImport implements ToModel, WithHeadingRow, WithChunkReading, WithValidation, SkipsEmptyRows
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    protected $logId, $logNm, $tpe_wo, $cluster, $rekapKry, $rekapBranch, $rekapCallsignTim, $rekapCallsignLead;

    function __construct($akses, $dttp_wo, $dtcluster, $dtKry, $dtBranch, $dtCallsignTim, $dtCallsignLead)
    {
        // dd($dttp_wo);
        $dtLogin = explode("|", $akses);
        $loginId = $dtLogin[0];
        $loginNm = $dtLogin[1];
        $this->logId = $loginId;
        $this->logNm = $loginNm;
        // $this->rekapJadwal = json_decode($dtJadwal, true);
        $this->tpe_wo = json_decode($dttp_wo,true);
        $this->cluster = json_decode($dtcluster, true);
        $this->rekapKry = json_decode($dtKry, true);
        $this->rekapBranch = json_decode($dtBranch, true);
        $this->rekapCallsignTim = json_decode($dtCallsignTim, true);
        $this->rekapCallsignLead = json_decode($dtCallsignLead, true);

    }


    public function model(array $row)
    {

        
        // $ikrDate = $row['ikr_date'];
        
        if(!array_filter($row)) {
            return null;
        }

        if (empty($row['wo_no'])) {
            return null;
        }

        // Tangani nilai non-numerik pada 'ikr_date'
        $ikrDate = $row['ikr_date'];
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

        $woDate = Str::trim($row['wo_date']);
        if (is_numeric($woDate)) {
            $formatWoDate = Date::excelToDateTimeObject($woDate)->format("d-m-Y H:i");
        } else {
            $parsedDate = \DateTime::createFromFormat('d/m/Y H:i', $woDate)
                ?: \DateTime::createFromFormat('m/d/Y H:i', $woDate)
                ?: \DateTime::createFromFormat('d-m-Y H:i', $woDate)
                ?: \DateTime::createFromFormat('d/m/Y H:i', $woDate)
                ?: \DateTime::createFromFormat('Y/m/d H:i', $woDate)
                ?: \DateTime::createFromFormat('Y-m-d H:i', $woDate);

            if ($parsedDate) {
                $formatWoDate = $parsedDate->format('d-m-Y H:i');
            } else {
                $formatWoDate = $woDate;
                // throw new \Exception("Format tanggal IKR tidak valid: " . $ikrDate);
            }
        }

        $tm = intval($row['time']);

        $katArea = "";
        if(Str::title($row['branch']) == "Jakarta Timur" || Str::title($row['branch']) == "Jakarta Selatan" || Str::title($row['branch']) == "Bekasi" || Str::title($row['branch']) == "Bogor" || Str::title($row['branch']) == "Tangerang") {
            $katArea = "Jabotabek";
        } else {
            $katArea = "Regional";
        }
        
        if( $row['area'] == null ) {            

            $clusterArea = DB::table('list_fat')->select('cluster')
                            ->where('kode_area', substr($row['fat_code'],4,3))->where('kategori_area', $katArea)->first();
            
            $area = is_null($clusterArea) ? $row['area'] : $clusterArea->cluster;
        } else {
            $area = $row['area'];
        }

        return new ImportAssignTim([

            'batch_wo' => Str::trim($row['sesi']),
            // 'tgl_ikr' => ,
            'no_wo_apk' => Str::trim($row['wo_no']),
            'no_ticket_apk' => Str::trim($row['ticket_no']),
            'wo_type_apk' => Str::title(str_replace("_"," ",$row['wo_type'])),

            'type_wo' => $this->get_data_id("type_wo", Str::trim(str_replace('_',' ', $row['wo_type'])), $formattedDate), // Str::upper($row['wo_type'])=="MAINTENANCE" || Str::upper($row['wo_type'])=="REMOVE DEVICE" || Str::upper($row['wo_type'])=="ADD DEVICE" || Str::upper($row['wo_type'])=="ADD / REMOVE DEVICE" || Str::upper($row['wo_type'])=="PENDING DEVICE" ? "FTTH Maintenance" : (Str::upper($row['wo_type'])=="NEW INSTALLATION" || Str::upper($row['wo_type'])=="RELOCATION" ? "FTTH New Installation" : (Str::upper($row['wo_type'])=="DISMANTLE" ? "FTTH Dismantle" : "-")),
            'area_cluster_apk' => Str::title($area),
            'wo_date_apk' => $formatWoDate, // Str::trim($row['wo_date']),
            'cust_id_apk' => Str::trim($row['cust_id']),
            'name_cust_apk' => Str::title($row['name']),
            'cust_phone_apk' => Str::trim($row['cust_phone']),
            'cust_mobile_apk' => Str::trim($row['cust_mobile']),
            'address_apk' => Str::title($row['address']),
            
            'fat_code_apk' => Str::trim($row['fat_code']),
            'fat_port_apk' => Str::trim($row['fat_port']),
            'remarks_apk' => Str::title($row['remarks']),
            'vendor_installer_apk' => Str::title($row['vendor_installer']),
            // 'ikr_date_apk' => Date::excelToDateTimeObject($row['ikr_date'])->format("Y-m-d"),
            // 'time_apk' => Date::excelToDateTimeObject($row['time'])->format("H:i"),

            'tgl_ikr' => $formattedDate,
            // 'tgl_ikr' => Date::excelToDateTimeObject($row['ikr_date'])->format("Y-m-d"),
            'slot_time' => is_string($row['time']) ? \Carbon\Carbon::createFromFormat('H:i', $row['time'])->format('H:i') : Date::excelToDateTimeObject($row['time'])->format("H:i"),
            'time_apk' => is_string($row['time']) ? \Carbon\Carbon::createFromFormat('H:i', $row['time'])->format('H:i') : Date::excelToDateTimeObject($row['time'])->format("H:i"),

            'branch_id' => $this->get_data_id("branch_id", Str::trim(Str::title($row['branch'])), $formattedDate),
            'branch' => $this->get_data_id("branch", Str::trim(Str::title($row['branch'])), $formattedDate),
            'leadcall_id' => $this->get_data_id("leadcall_id", Str::trim(Str::title($row['leader'])), $formattedDate),
            'leadcall' => $this->get_data_id("leadcall", Str::trim(Str::title($row['leader'])), $formattedDate),
            'leader_id' => $this->get_data_id("leader_id", Str::trim(Str::title($row['leader'])), $formattedDate),
            'leader' => Str::trim(Str::title($row['leader'])),
            'callsign_id' => $this->get_data_id("callsign_id", Str::trim($row['callsign']), $formattedDate),
            'callsign' => Str::trim($row['callsign']),
            'tek1_nik' => $this->get_data_id("tek1_nik", Str::trim(ucwords($row['tim_1'])), $formattedDate),
            'teknisi1' => $this->get_data_id("teknisi1", $row['tim_1'] == null ? null : Str::trim(ucwords($row['tim_1'])), $formattedDate),
            'tek2_nik'=> $this->get_data_id("tek2_nik", Str::trim($row['tim_2']), $formattedDate),
            'teknisi2' => $this->get_data_id("teknisi2", $row['tim_2'] == null ? null : Str::trim(ucwords($row['tim_2'])), $formattedDate),
            'tek3_nik' => $this->get_data_id("tek3_nik", Str::trim($row['tim3']), $formattedDate),
            'teknisi3' => $this->get_data_id("teknisi3", $row['tim3'] == null ? null : Str::trim(ucwords($row['tim3'])), $formattedDate),
            'tek4_nik' => $this->get_data_id("tek4_nik", Str::trim($row['tim4']), $formattedDate),
            'teknisi4' => $this->get_data_id("teknisi4", $row['tim4'] == null ? null : Str::trim(ucwords($row['tim4'])), $formattedDate),
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
            '*.wo_no' => ['required', Rule::unique('import_assign_tims', 'no_wo_apk')],
            '*.wo_type' => ['required', Rule::exists('type_wo','type_wo_apk')],
            '*.branch' => ['required', Rule::exists('branches', 'nama_branch')],
            '*.leader' => ['required', Rule::exists('v_detail_callsign_tim','nama_leader')],
            '*.tim_1' => [Rule::exists('employees','nama_karyawan')],
            '*.tim_2' => ['nullable', Rule::exists('employees','nama_karyawan')],
            '*.tim3' => ['nullable', Rule::exists('employees','nama_karyawan')],
            '*.tim4' => ['nullable', Rule::exists('employees','nama_karyawan')],
            '*.callsign' => ['required'],
            '*.ikr_date' => [
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
            '*.wo_no.unique' => 'No WO sudah ada di database',
            '*.leader' => 'Nama Leader tidak terdaftar',
            '*.wo_no.required' => 'No WO harus diisi',
            '*.branch.required' => 'Branch harus diisi',
            '*.callsign.required' => 'Callsign harus diisi',
            '*.ikr_date.required' => 'Tanggal IKR harus diisi',
        ];
    }


    public function chunkSize(): int
    {
        return 10;
    }

    public function get_data_id($kolom, $data, $tanggal)
    {
        // dd($kolom, $data);

        // try {

            switch ($kolom) {
                case "branch_id":
                    // $branchID = DB::table('branches')->select('id')->where('nama_branch', $data)->first();
                    // return is_null($branchID) ? null : $branchID->id;

                    $branchID = array_values(Arr::where($this->rekapBranch, function (array $value, $key) use ($data) {
                        // return $value['tgl'] == $ikrDate ;
                        return $value['nama_branch']== $data;
                    }));

                    return empty($branchID) ? null : $branchID[0]['id'];
                    break;

                case "branch":
                    // $branch = DB::table('branches')->select('nama_branch')->where('nama_branch', $data)->first();
                    // return is_null($branch) ? null : $branch->nama_branch;

                    $branch = array_values(Arr::where($this->rekapBranch, function (array $value, $key) use ($data) {
                        // return $value['tgl'] == $ikrDate ;
                        return $value['nama_branch']== $data;
                    }));

                    return empty($branch) ? null : $branch[0]['nama_branch'];
                    break;

                case "leadcall_id":
                    // $leadcall_id = DB::table('v_detail_callsign_tim')->select('lead_call_id')->where('nama_leader', $data)->first();
                    // $leadCallID= is_null($leadcall_id) ? null : $leadcall_id->lead_call_id;
                    // return $leadCallID;

                    $leadcall_id = array_values(Arr::where($this->rekapCallsignTim, function (array $value, $key) use ($data) {
                        // return $value['tgl'] == $ikrDate ;
                        return $value['nama_leader']== $data;
                    }));

                    return empty($leadcall_id) ? null : $leadcall_id[0]['lead_call_id'];
                    break;

                case "leadcall":
                    // $leadcall = DB::table('v_detail_callsign_tim')->select('lead_callsign')->where('nama_leader', $data)->first();
                    // $leadCallsign =  is_null($leadcall) ? null : $leadcall->lead_callsign;
                    // return $leadCallsign;

                    $leadcall = array_values(Arr::where($this->rekapCallsignTim, function (array $value, $key) use ($data) {
                        // return $value['tgl'] == $ikrDate ;
                        return $value['nama_leader']== $data;
                    }));

                    return empty($leadcall) ? null : $leadcall[0]['lead_callsign'];
                    break;

                case "leader_id":
                    // $leader_id = DB::table('v_detail_callsign_tim')->select('leader_id')->where('nama_leader', $data)->first();
                    // $leaderID= is_null($leader_id) ? null : $leader_id->leader_id;
                    // return $leaderID;

                    $leader_id = array_values(Arr::where($this->rekapCallsignTim, function (array $value, $key) use ($data) {
                        // return $value['tgl'] == $ikrDate ;
                        return $value['nama_leader']== $data;
                    }));

                    return empty($leader_id) ? null : $leader_id[0]['leader_id'];

                    break;

                case "callsign_id":
                    if(strtoupper(substr($data,0,4))=="LEAD") {
                        // $callsign_id = DB::table('callsign_leads as cl')
                        //     ->leftJoin('employees as e','cl.leader_id', '=', 'e.nik_karyawan')
                        //     ->select('cl.id as callsign_tim_id')
                        //     ->where('lead_callsign', $data)->first();
                        
                        $callsign_id = array_values(Arr::where($this->rekapCallsignLead, function (array $value, $key) use ($data) {
                                // return $value['tgl'] == $ikrDate ;
                                return $value['lead_callsign']== $data;
                        }));
                        
                    } else {
                        // $callsign_id = DB::table('v_detail_callsign_tim')->select('callsign_tim_id')->where('callsign_tim', $data)->first();

                        $callsign_id = array_values(Arr::where($this->rekapCallsignTim, function (array $value, $key) use ($data) {
                            // return $value['tgl'] == $ikrDate ;
                            return $value['callsign_tim']== $data;
                        }));
                    }
                    
                    // $leaderID= is_null($leader_id) ? "-" : $leader_id->leader_id;
                    // return is_null($callsign_id) ?  null : $callsign_id->callsign_tim_id;
                    return empty($callsign_id) ?  null : $callsign_id[0]['callsign_tim_id'];
                    break;

                case "tek1_nik":
                    // $tek1_nik = DB::table('employees as e')->select('e.nik_karyawan')->where('e.nama_karyawan', $data)->where('e.status_active','=','Aktif')
                    //             ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                    //             ->whereIn('vj.status', ["ON","OD"])
                    //             ->where('vj.tgl', $tanggal)
                    //             ->first();
                    // dd(is_null($tek1_nik));

                    $tek1_nik = array_values(Arr::where($this->rekapKry, function (array $value, $key) use ($tanggal, $data) {
                        // return $value['tgl'] == $ikrDate ;
                        return strtoupper($value['nama_karyawan'])== strtoupper($data);
                    }));

                    $tek1Nik = empty($tek1_nik) ? null : $tek1_nik[0]['nik_karyawan'];
                    
                    return $tek1Nik;
                    break;

                case "teknisi1":
                    // $tek1_nik = DB::table('employees')->select('nama_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                    // $tek1_nik = DB::table('employees as e')->select('e.nama_karyawan')->where('e.nama_karyawan', $data)->where('e.status_active','=','Aktif')
                    //             ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                    //             ->whereIn('vj.status', ["ON","OD"])
                    //             ->where('vj.tgl', $tanggal)
                    //             ->first();
                    // dd(is_null($tek1_nik));

                    $tek1_nik = array_values(Arr::where($this->rekapKry, function (array $value, $key) use ($tanggal, $data) {
                        // return $value['tgl'] == $ikrDate ;
                        return strtoupper($value['nama_karyawan'])== strtoupper($data);
                    }));

                    $tekName1 = empty($tek1_nik) ? null : $tek1_nik[0]['nama_karyawan'];
                    // $tekName1 = is_null($tek1_nik) ? null : $tek1_nik->nama_karyawan;
                    return $tekName1;
                    break;

                case "tek2_nik":
                    // $tek2_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                    // $tek2_nik = DB::table('employees as e')->select('e.nik_karyawan')->where('e.nama_karyawan', $data)->where('e.status_active','=','Aktif')
                    //         ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                    //         ->whereIn('vj.status', ["ON","OD"])
                    //         ->where('vj.tgl', $tanggal)
                    //         ->first();
                    // $tek2Nik = is_null($tek2_nik) ? null : $tek2_nik->nik_karyawan;

                    $tek2_nik = array_values(Arr::where($this->rekapKry, function (array $value, $key) use ($tanggal, $data) {
                        // return $value['tgl'] == $ikrDate ;
                        return strtoupper($value['nama_karyawan'])== strtoupper($data);
                    }));
                    
                    $tek2Nik = empty($tek2_nik) ? null : $tek2_nik[0]['nik_karyawan'];
                    return $tek2Nik;
                    break;

                case "teknisi2":
                    // $tek2_nik = DB::table('employees')->select('nama_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                    // $tek2_nik = DB::table('employees as e')->select('e.nama_karyawan')->where('e.nama_karyawan', $data)->where('e.status_active','=','Aktif')
                    //         ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                    //         ->whereIn('vj.status', ["ON","OD"])
                    //         ->where('vj.tgl', $tanggal)
                    //         ->first();
                    // // dd(is_null($tek1_nik));
                    // $tekName2 = is_null($tek2_nik) ? null : $tek2_nik->nama_karyawan;

                    $tek2_nik = array_values(Arr::where($this->rekapKry, function (array $value, $key) use ($tanggal, $data) {
                        // return $value['tgl'] == $ikrDate ;
                        return strtoupper($value['nama_karyawan'])== strtoupper($data);
                    }));

                    $tekName2 = empty($tek2_nik) ? null : $tek2_nik[0]['nama_karyawan'];
                    return $tekName2;
                    break;

                case "tek3_nik":
                    // $tek3_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                    // $tek3_nik = DB::table('employees as e')->select('e.nik_karyawan')->where('e.nama_karyawan', $data)->where('e.status_active','=','Aktif')
                    //         ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                    //         ->whereIn('vj.status', ["ON","OD"])
                    //         ->where('vj.tgl', $tanggal)
                    //         ->first();
                    // $tek3Nik = is_null($tek3_nik) ? null : $tek3_nik->nik_karyawan;

                    $tek3_nik = array_values(Arr::where($this->rekapKry, function (array $value, $key) use ($tanggal, $data) {
                        // return $value['tgl'] == $ikrDate ;
                        return strtoupper($value['nama_karyawan'])== strtoupper($data);
                    }));
                    // dd(empty($tek3_nik));

                    $tek3Nik = empty($tek3_nik) ? null : $tek3_nik[0]['nik_karyawan'];
                    return $tek3Nik;
                    break;

                case "teknisi3":
                    // $tek3_nik = DB::table('employees')->select('nama_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                    // $tek3_nik = DB::table('employees as e')->select('e.nama_karyawan')->where('e.nama_karyawan', $data)->where('e.status_active','=','Aktif')
                    //         ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                    //         ->whereIn('vj.status', ["ON","OD"])
                    //         ->where('vj.tgl', $tanggal)
                    //         ->first();
                    // // dd(is_null($tek1_nik));
                    // $tekName3 = is_null($tek3_nik) ? null : $tek3_nik->nama_karyawan;

                    $tek3_nik = array_values(Arr::where($this->rekapKry, function (array $value, $key) use ($tanggal, $data) {
                        // return $value['tgl'] == $ikrDate ;
                        return strtoupper($value['nama_karyawan'])== strtoupper($data);
                    }));

                    $tekName3 = empty($tek3_nik) ? null : $tek3_nik[0]['nama_karyawan'];
                    return $tekName3;
                    break;

                case "tek4_nik":
                    // $tek4_nik = DB::table('employees')->select('nik_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                    // $tek4_nik = DB::table('employees as e')->select('e.nik_karyawan')->where('e.nama_karyawan', $data)->where('e.status_active','=','Aktif')
                    //         ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                    //         ->whereIn('vj.status', ["ON","OD"])
                    //         ->where('vj.tgl', $tanggal)
                    //         ->first();
                    // $tek4Nik = is_null($tek4_nik) ? null : $tek4_nik->nik_karyawan;

                    $tek4_nik = array_values(Arr::where($this->rekapKry, function (array $value, $key) use ($tanggal, $data) {
                        // return $value['tgl'] == $ikrDate ;
                        return strtoupper($value['nama_karyawan'])== strtoupper($data);
                    }));

                    $tek4Nik = empty($tek4_nik) ? null : $tek4_nik[0]['nik_karyawan'];
                    return $tek4Nik;
                    break;

                case "teknisi4":
                    // $tek4_nik = DB::table('employees')->select('nama_karyawan')->where('nama_karyawan', $data)->where('status_active','=','Aktif')->first();
                    // $tek4_nik = DB::table('employees as e')->select('e.nama_karyawan')->where('e.nama_karyawan', $data)->where('e.status_active','=','Aktif')
                    //         ->leftJoin('v_rekap_jadwal_data as vj', 'e.nik_karyawan','=','vj.nik_karyawan')
                    //         ->whereIn('vj.status', ["ON","OD"])
                    //         ->where('vj.tgl', $tanggal)
                    //         ->first();
                    // // dd(is_null($tek1_nik));
                    // $tekName4 = is_null($tek4_nik) ? null : $tek4_nik->nama_karyawan;

                    $tek4_nik = array_values(Arr::where($this->rekapKry, function (array $value, $key) use ($tanggal, $data) {
                        // return $value['tgl'] == $ikrDate ;
                        return strtoupper($value['nama_karyawan'])== strtoupper($data);
                    }));

                    $tekName4 = empty($tek4_nik) ? null : $tek4_nik[0]['nama_karyawan'];
                    return $tekName4;
                    break;

                case "type_wo":
                    // $tp_wo = DB::table('type_wo')->select('type_wo')->where('type_wo_apk', $data)->first();
                    // $typeWo = is_null($tp_wo) ? null : $tp_wo->type_wo;

                    $t_wo = array_values(Arr::where($this->tpe_wo, function (array $value, $key) use ($data) {
                        return strtoupper($value['type_wo_apk']) == strtoupper($data);

                    }));
                    // dd($this->tp_wo);
                    $typeWo = empty($t_wo) ? null : $t_wo[0]['type_wo'];
                    return $typeWo;
                    break;   
                case "areaCluster":
                    $katArea = "";
                    if($data == "Jakarta Timur" || $data == "Jakarta Selatan" || $data == "Bekasi" 
                                || $data == "Bogor" || $data == "Tangerang") {
                        $katArea = "Jabotabek";
                    } else {
                        $katArea = "Regional";
                    }

                    // $clusterArea = DB::table('list_fat')->select('cluster')
                    //             ->where('kode_area', substr($data,5,3))->where('kategori_area', $katArea)->first();
                    // $cluster = is_null($clusterArea) ? null : $clusterArea->cluster;

                    $clusterArea = array_values(Arr::where($this->cluster, function (array $value, $key) use ($data, $katArea) {
                        return strtoupper($value['kode_area']) == strtoupper(substr($data,5,3)) && strtoupper($value['kategori_area']) == strtoupper($katArea);

                    }));
                    $cluster = empty($clusterArea) ? null : $clusterArea[0]['cluster'];
                    return $cluster;
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
