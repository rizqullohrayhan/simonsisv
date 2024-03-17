<?php

namespace Database\Seeders;

use App\Models\DetailMak;
use Illuminate\Database\Seeder;

class DetailMakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/4detailMak.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                DetailMak::create([
                    "id" => $data['0'],
                    "id_belanja" => $data['1'],
                    "detail" => $data['2'],
                    "harga" => $data['3'],
                    "satuan" => $data['4'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
