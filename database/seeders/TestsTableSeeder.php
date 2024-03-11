<?php

namespace Database\Seeders;

use App\Models\Clinics;
use App\Models\Test;
use App\Models\Doctor;
use App\Models\TestName;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TestsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 500; $i++) {
            $date = $faker->dateTimeThisYear;
            Test::create([
                'test_name_id' => rand(1, TestName::count()),
                'description' => $faker->text,
                'referring_doctor_id' => rand(1, Doctor::count()) === 5 ? null : Doctor::inRandomOrder()->first()->id,
                'referring_doctor_clinic_id' => rand(1, Clinics::count()),
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
