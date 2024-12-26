<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(public_path("storage/data/cities.csv"), "r");
        $firstLine = true;

        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstLine) {
                City::query()->create([
                    "id" => $data[0],
                    "name" => $data[1],
                    "state_id" => $data[2],
                ]);
            }

            $firstLine = false;
        }

        fclose($csvFile);
    }
}
