<?php

namespace App\Imports;

use App\Models\IKUModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IKUImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if (is_null($row["iku"])) {
            return null;
        }
        // dd($row["iku"]);
        return new IKUModel([
            //
            'IKU' => $row["iku"],
            'deskripsi' => $row["deskripsi"],
        ]);
    }
}
