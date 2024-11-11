<?php

namespace App\Imports;

use App\Models\ImportJadwalIkr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Support\Facades\DB;

class JadwalIkrImport implements ToModel, WithHeadingRow
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

        return new ImportJadwalIkr([
            //
        ]);
    }
}
