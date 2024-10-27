<?php

namespace App\Exports;

use App\Models\FtthMt;
use Maatwebsite\Excel\Concerns\FromCollection;

class FtthMtApkMaterial implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return FtthMt::all();
    }
}
