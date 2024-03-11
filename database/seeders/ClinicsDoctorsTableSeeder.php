<?php

namespace Database\Seeders;

use App\Models\Clinics;
use App\Models\Doctor;
use Illuminate\Database\Seeder;

class ClinicsDoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorsCount = Doctor::count();
        $clinicsCount = Clinics::count();

        for ($i = 0; $i < 500; $i++) {
            $doctorId = rand(1, $doctorsCount);
            $clinicId = rand(1, $clinicsCount);

            Clinics::find($clinicId)->doctors()->attach($doctorId, ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
