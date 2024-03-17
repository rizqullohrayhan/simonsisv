<?php

namespace App\Exports;

use App\Models\Tor;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class MultiExport implements WithMultipleSheets
{
    protected $ids;

    function __construct($ids)
    {
        $this->ids = $ids;
    }
    public function sheets(): array
    {

        return [
            new TORExport($this->ids),
            new RABExport($this->ids),
        ];
    }
}
