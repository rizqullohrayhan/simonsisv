<?php

namespace Database\Seeders;

use App\Models\Pagu;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class PaguSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/paguCsv.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                Pagu::create([
                    "id" => $data['0'],
                    "id_unit" => $data['1'],
                    "id_tahun" => $data['2'],
                    "pagu" => $data['3'],
                    "tw1" => $data['4'],
                    "tw2" => $data['5'],
                    "tw3" => $data['6'],
                    "tw4" => $data['7'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
