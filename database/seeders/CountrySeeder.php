<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(public_path("storage/data/countries.csv"), "r");
        $firstLine = true;

        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstLine) {
                Country::query()->create([
                    "id" => $data[0],
                    "iso2" => $data[1],
                    "name" => $data[2],
                    "phone_code" => $data[3]
                ]);
            }

            $firstLine = false;
        }

        fclose($csvFile);
    }
}
