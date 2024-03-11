<?php

namespace Database\Seeders;

use App\Models\Clinics;
use Faker\Factory as Faker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_AU');
        $clinics = [];
        for ($i = 0; $i < 100; $i++) {
            $clinics[] = [
                'name' => $faker->company,
                'address' => preg_replace('#\n#', ', ', trim($faker->address))
            ];
        }
        $clinics = collect($clinics);

        for ($i = 0; $i < 500; $i++) {
            $clinic = $clinics->random();

            // Randomly muddle up the data so it's not obvious which doctor or clinic goes where
            if (rand(1, 10) === 10) {
                $clinic['name'] = null;
            }

            if (rand(1, 10) === 10) {
                $clinic['address'] = null;
            }

            if ($clinic['name'] && rand(0, 1)) {
                $clinic['name'] = $clinic['name'] . ' ' . ucfirst($faker->word);
            }

            if ($clinic['name'] && rand(0, 1)) {
                $clinic['name'] = ucfirst($faker->word) . ' ' . $clinic['name'];
            }

            if ($clinic['name'] && rand(0, 5) === 5) {
                $clinic['name'] = substr($clinic['name'], 0, 10);
            }

            if ($clinic['address'] && rand(0, 1)) {
                $parts = collect(explode(', ', $clinic['address']));
                $muddle = $parts->random(2)->implode(' ');
                if (str_contains($muddle, '/')) {
                    list($ignore, $muddle) = explode('/', $muddle);
                }

                if (rand(0, 10) === 10) {
                    $muddle .= $faker->word;
                }

                $clinic['address'] = $muddle;
            }

            $date = $faker->dateTimeThisYear;

            $clinic = [
                'name' => $clinic['name'],
                'address' => str_replace('\n', ', ', $clinic['address']),
                'created_at' => $date,
                'updated_at' => $date
            ];

            Clinics::create($clinic);
        }
    }
}
