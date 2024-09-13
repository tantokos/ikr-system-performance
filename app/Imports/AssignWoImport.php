<?php

namespace App\Imports;

use App\Models\ImportAssignTim;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use \PhpOffice\PhpSpreadsheet\Shared\Date;

class AssignWoImport implements ToModel, WithHeadingRow, WithChunkReading
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
        return new ImportAssignTim([


            'batch_wo' => "Sesi",
            // 'tgl_ikr' => ,

            'wo_no' => $row['wo_no'],
            'ticket_no' => $row['ticket_no'],
            'wo_type' => $row['wo_type'],
            'wo_date' => $row['wo_date'],
            'cust_id' => $row['cust_id'],
            'name' => $row['name'],
            'cust_phone' => $row['cust_phone'],
            'cust_mobile' => $row['cust_mobile'],
            'address' => $row['address'],
            'area' => $row['area'],
            'fat_code' => $row['fat_code'],
            'fat_port' => $row['fat_port'],
            'remarks' => $row['remarks'],
            'vendor_installer' => $row['vendor_installer'],
            'ikr_date' => $row['ikr_date'],
            'time' => $row['time'],

            'login' => $this->login
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
