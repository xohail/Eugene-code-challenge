<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Specialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorsSpecialtyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorsCount = Doctor::count();
        $specialtyCount = Specialty::count();

        for ($i = 0; $i < 500; $i++) {
            $doctorId = rand(1, $doctorsCount);
            $specialtyId = rand(1, $specialtyCount);

            Specialty::find($specialtyId)->doctors()->attach($doctorId, ['created_at' => now(), 'updated_at' => now()]);
        }
    }
}
