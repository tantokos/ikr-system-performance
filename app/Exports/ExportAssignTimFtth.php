<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportAssignTimFtth implements FromCollection, WithStyles, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect([]); // Koleksi kosong
    }

    public function headings(): array
    {
        return [
            'WO_NO',
            'TICKET_NO',
            'WO TYPE',
            'WO_DATE',
            'CUST_ID',
            'NAME',
            'CUST_PHONE',
            'CUST_MOBILE',
            'ADDRESS',
            'AREA',
            'WO TYPE',
            'FAT_CODE',
            'FAT_PORT',
            'REMARKS',
            'VENDOR_INSTALLER',
            'IKR_DATE',
            'TIME',
            'KODE AREA',
            'SESI',
            'KOTA MADYA',
            'BRANCH',
            'CALLSIGN',
            'LEADER',
            'TIM 1',
            'TIM 2',
            'Tim3',
            'tim4',
            'Status Telebot'
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
                        'argb' => '1700ff', // Background biru
                    ],
                ],
            ],
        ];
    }
}
