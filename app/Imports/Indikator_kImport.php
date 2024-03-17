<?php

namespace App\Imports;

use App\Models\KModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Indikator_kImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        return new KModel([
            'id_ik' => $row["ik"],
            'P' => $row["p"],
            'deskripsi' => $row["deskripsi"],
        ]);
    }
}
