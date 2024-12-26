<?php

namespace Database\Seeders;

use App\Models\State;
use Illuminate\Database\Seeder;

class StateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = fopen(public_path("storage/data/states.csv"), "r");
        $firstLine = true;

        while (($data = fgetcsv($csvFile)) !== FALSE) {
            if (!$firstLine) {
                State::query()->create([
                    "id" => $data[0],
                    "name" => $data[1],
                    "country_id" => $data[2],
                ]);
            }

            $firstLine = false;
        }

        fclose($csvFile);
    }
}
