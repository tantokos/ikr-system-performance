<?php

namespace App\Imports;

use App\Models\DataAbsence;
use App\Models\ImportDataAbsence;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class AbsenImport implements ToModel, WithHeadingRow, WithChunkReading
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $login;

    function __construct($akses)
    {
        $this->login = $akses;
    }


    public function model(array $row)
    {
        return new ImportDataAbsence([
            'tanggal' => Date::excelToDateTimeObject($row['tanggal']),
            'nama_karyawan' => $row['nama_karyawan'],
            'no_karyawan' => $row['no_karyawan'],
            'area' => $row['area'],
            'posisi' => $row['posisi'],
            'unit_organisasi' => $row['unit_organisasi'],
            'shift' => $row['shift'],
            'masuk' => $row['masuk'],
            'keluar' => $row['keluar'],
            'jam_masuk' => $row['jam_masuk'],
            'menit_masuk' => $row['menit_masuk'],
            'jam_keluar' => $row['jam_keluar'],
            'menit_keluar' => $row['menit_keluar'],
            'istirahat_mulai' => $row['istirahat_mulai'],
            'istirahat_akhir' => $row['istirahat_akhir'],
            'tipe_hari' => $row['tipe_hari'],
            'actual_work_minutes' => $row['actual_work_minutes'],
            'menit_lembur' => $row['menit_lembur'],
            'index_lembur' => $row['index_lembur'],
            'makanan' => $row['makanan'],
            'transport' => $row['transport'],
            'status' => $row['status'],
            'status_lainnya' => $row['status_lainnya'],
            'abs' => $row['abs'],
            'anl' => $row['anl'],
            'cst' => $row['cst'],
            'dif' => $row['dif'],
            'eai' => $row['eai'],
            'eao' => $row['eao'],
            'gvl' => $row['gvl'],
            'lti' => $row['lti'],
            'mdl' => $row['mdl'],
            'nsi' => $row['nsi'],
            'nso' => $row['nso'],
            'off' => $row['off'],
            'ovh' => $row['ovh'],
            'ovt' => $row['ovt'],
            'pl' => $row['pl'],
            'prs' => $row['prs'],
            'sbm' => $row['sbm'],
            'sdc' => $row['sdc'],
            'upl' => $row['upl'],
            'ot' => $row['ot'],
            'unpr' => $row['unpr'],
            'permith' => $row['permith'],
            'keterangan' => $row['keterangan'],
            'import_by' => $this->login

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
