<?php

namespace App\Imports;

use App\Models\ImportKonfCst;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class KonfCstImport implements ToModel, WithHeadingRow, WithChunkReading, SkipsEmptyRows, WithValidation
{

    protected $logId, $logNm;

    public function __construct($akses)
    {
        $dtLogin = explode("|", $akses);
        $this->logId = $dtLogin[0];
        $this->logNm = $dtLogin[1];
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $timeStamp = $row['timestamp'];
        if (is_numeric($timeStamp)) {
            $formattedDate = Date::excelToDateTimeObject($timeStamp)->format("Y-m-d H:i:s");
        } else {
            $parsedDate = \DateTime::createFromFormat('d/m/Y H:i:s', $timeStamp)
                ?: \DateTime::createFromFormat('d-m-Y H:i:s', $timeStamp)
                ?: \DateTime::createFromFormat('Y-m-d H:i:s', $timeStamp)
                ?: \DateTime::createFromFormat('m-d-Y H:i:s', $timeStamp);

            if ($parsedDate) {
                $formattedDate = $parsedDate->format('Y-m-d H:i:s');
            } else {
                throw new \Exception("Format tanggal IKR tidak valid: " . $timeStamp);
            }
        }

        $tgl_progress = $row['tanggal_progress'];
        if (is_numeric($tgl_progress)) {
            $tglProgress = Date::excelToDateTimeObject($tgl_progress)->format("Y-m-d H:i:s");
        } else {
            $parsedDate = \DateTime::createFromFormat('d/m/Y H:i:s', $tgl_progress)
                ?: \DateTime::createFromFormat('d-m-Y H:i:s', $tgl_progress)
                ?: \DateTime::createFromFormat('Y-m-d H:i:s', $tgl_progress)
                ?: \DateTime::createFromFormat('m-d-Y H:i:s', $tgl_progress);

            if ($parsedDate) {
                $tglProgress = $parsedDate->format('Y-m-d H:i:s');
            } else {
                throw new \Exception("Format tanggal IKR tidak valid: " . $tgl_progress);
            }
        }

        $tgl_konf = $row['tanggal_konfirmasi_customer'];
        if (is_numeric($tgl_konf)) {
            $tglKonfirmasi = Date::excelToDateTimeObject($tgl_konf)->format("Y-m-d H:i:s");
        } else {
            $parsedDate = \DateTime::createFromFormat('d/m/Y H:i:s', $tgl_konf)
                ?: \DateTime::createFromFormat('d-m-Y H:i:s', $tgl_konf)
                ?: \DateTime::createFromFormat('Y-m-d H:i:s', $tgl_konf)
                ?: \DateTime::createFromFormat('m-d-Y H:i:s', $tgl_konf);

            if ($parsedDate) {
                $tglKonfirmasi = $parsedDate->format('Y-m-d H:i:s');
            } else {
                throw new \Exception("Format tanggal IKR tidak valid: " . $tgl_konf);
            }
        }

        $slotTime_leader = $row['slot_time_leader'];
        if (is_numeric($slotTime_leader)) {
            $slotTimeLeader = Date::excelToDateTimeObject($slotTime_leader)->format("H:i:s");
        } else {
            $parsedDate = \DateTime::createFromFormat('H:i:s', $slotTime_leader)
                ?: \DateTime::createFromFormat('H.i.s', $slotTime_leader)
                ?: \DateTime::createFromFormat('H:i', $slotTime_leader)
                ?: \DateTime::createFromFormat('H.i', $slotTime_leader);

            if ($parsedDate) {
                $slotTimeLeader = $parsedDate->format('H:i:s');
            } else {
                throw new \Exception("Format tanggal IKR tidak valid: " . $slotTime_leader);
            }
        }

        $jam_konfirmasi = $row['jam_konfirmasi_customer'];
        if (is_numeric($jam_konfirmasi)) {
            $jamKonfirmasi = Date::excelToDateTimeObject($jam_konfirmasi)->format("H:i:s");
        } else {
            $parsedDate = \DateTime::createFromFormat('H:i:s', $jam_konfirmasi)
                ?: \DateTime::createFromFormat('H.i.s', $jam_konfirmasi)
                ?: \DateTime::createFromFormat('H:i', $jam_konfirmasi)
                ?: \DateTime::createFromFormat('H.i', $jam_konfirmasi);

            if ($parsedDate) {
                $jamKonfirmasi = $parsedDate->format('H:i:s');
            } else {
                throw new \Exception("Format tanggal IKR tidak valid: " . $jam_konfirmasi);
            }
        }

        // dd($row);
        return new ImportKonfCst([
            'timestamp' => $formattedDate,
            'pic' => $row['pic'],
            'tgl_progress' => $tglProgress,
            'branch' => $row['branch'],
            'type_wo' => $row['type_wo'],
            'no_wo' => $row['nomor_wo'],
            'id_cust' => $row['id_customer'],
            'nama_cust' => $row['nama_customer'],
            'slot_time_leader' => $slotTimeLeader,
            'no_telp_cst' => $row['nomor_telp_customer'],
            'bukti_konfirmasi' => $row['screenshoot_konfirmasi_awal_customer'],
            'tgl_konfirmasi' => $tglKonfirmasi,
            'jam_konfirmasi' => $jamKonfirmasi,
            'status_konfirmasi'  => $row['status_konfirmasi_customer'],
            'login' => $this->logNm

        ]);

    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function rules(): array
    {
        return [
            '*.nomor_wo' => ['required', 
                Rule::unique('import_konf_csts', 'no_wo')->where('login', '=', $this->logNm)],
            // '*.wo_date' => ['required'],
            // '*.ticket_no' => ['required'],
            '*.tanggal_progress' => ['required'],
        ];
    }

    public function customValidationMessages()
    {
        return [
            '*.nomor_wo.unique' => 'No WO sudah ada di database',
            '*.nomor_wo.required' => 'No WO harus diisi',
            // '*.ticket_no.required' => 'Ticket No harus diisi',
            // '*.wo_date.required' => 'WO Date harus diisi',
            '*.tanggal_progress.required' => 'Periksa kembali file yang diunggah, pastikan formatnya benar',
        ];
    }
}
