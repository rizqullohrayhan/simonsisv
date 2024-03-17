<?php

namespace Database\Seeders;

use App\Models\KelompokMak;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class KelompokMakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(base_path("database/data/2kelompokMak.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                KelompokMak::create([
                    "id" => $data['0'],
                    "id_mak" => $data['1'],
                    "kelompok" => $data['2'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
