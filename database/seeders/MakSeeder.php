<?php

namespace Database\Seeders;

use App\Models\Mak;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class MakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $csvFile = fopen(base_path("database/data/1kategoriMak.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                Mak::create([
                    "id" => $data['0'],
                    "id_spjkategori" => $data['1'],
                    "jenis_belanja" => $data['2'],
                    "is_aktif" => $data['3']
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
