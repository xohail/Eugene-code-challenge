<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(TestNameSeeder::class);
        $this->call(SpecialtyTableSeeder::class);
        $this->call(DoctorsTableSeeder::class);
        $this->call(ClinicsTableSeeder::class);
        $this->call(ClinicsDoctorsTableSeeder::class);
        $this->call(DoctorsSpecialtyTableSeeder::class);
        $this->call(TestsTableSeeder::class);
    }
}
