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
        $australianStateAbbreviations = [
            'NSW',
            'VIC',
            'QLD',
            'WA',
            'SA',
            'TAS',
            'NT',
            'ACT',
        ];
        $faker = Faker::create('en_AU');
        $clinics = [];
        for ($i = 0; $i < 100; $i++) {
            $clinics[] = [
                'name' => $faker->company,
                'house' => $faker->buildingNumber,
                'street' => $faker->streetAddress,
                'suburb' => $faker->city,
                'postcode' => $faker->postcode,
                'state' => $faker->randomElement($australianStateAbbreviations),
                'geocode' => $faker->latitude.','.$faker->longitude
            ];
        }
        $clinics = collect($clinics);

        for ($i = 0; $i < 500; $i++) {
            $clinic = $clinics->random();

            // Randomly muddle up the data so it's not obvious which doctor or clinic goes where
            if (rand(1, 10) === 10) {
                $clinic['name'] = $clinic['street'] = $clinic['suburb'] = null;
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

            $date = $faker->dateTimeThisYear;

            $clinic = [
                'name' => $clinic['name'],
                'house' => $clinic['house'],
                'street' => $clinic['street'],
                'suburb' => $clinic['suburb'],
                'postcode' => $clinic['postcode'],
                'state' => $clinic['state'],
                'geocode' => $clinic['geocode'],
                'created_at' => $date,
                'updated_at' => $date
            ];

            Clinics::create($clinic);
        }
    }
}
