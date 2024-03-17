<?php

namespace Database\Seeders;

use App\Models\BelanjaMak;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class BelanjaMakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = fopen(base_path("database/data/3belanjaMak.csv"), "r");

        $firstline = true;
        while (($data = fgetcsv($csvFile, 2000, ";")) !== FALSE) {
            if (!$firstline) {
                BelanjaMak::create([
                    "id" => $data['0'],
                    "id_kelompok" => $data['1'],
                    "belanja" => $data['2'],
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
