<?php

namespace Database\Seeders;

use App\Models\SubKegiatan;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SubKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/subK.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                SubKegiatan::create([
                    "id" => $data['0'],
                    "id_k" => $data['1'],
                    "subK" => $data['2'],
                    "deskripsi" => $data['3'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
