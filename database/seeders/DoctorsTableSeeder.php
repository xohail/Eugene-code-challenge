<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class DoctorsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('en_AU');

        $names = [];
        for ($i = 0; $i < 100; $i++) {
            $names[] = $faker->name;
        }
        $names = collect($names);

        for ($i = 0; $i < 500; $i++) {
            $date = $faker->dateTimeThisYear;

            $name = $names->random();

            if (rand(0, 1)) {
                $parts = collect(explode(' ', $name));
                $name = $parts->random(2)->implode(' ');
            }

            $doctor = [
                'name' => $name,
                'created_at' => $date,
                'updated_at' => $date
            ];

            Doctor::create($doctor);
        }
    }
}
