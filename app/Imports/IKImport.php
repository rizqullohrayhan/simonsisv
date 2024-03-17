<?php

namespace App\Imports;

use App\Models\IKModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class IKImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        if (is_null($row["iku"])) {
            return null;
        }
        return new IKModel([
            //
            'id_iku' => $row["iku"],
            'IK' => $row["ik"],
            'deskripsi' => $row["deskripsi"],
        ]);
    }
}
