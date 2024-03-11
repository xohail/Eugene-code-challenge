<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [['name' => 'General Practitioner', 'created_at' => now(), 'updated_at' => now()], ['name' => 'Gynaecologist', 'created_at' => now(), 'updated_at' => now()], ['name' => 'OB-GYN', 'created_at' => now(), 'updated_at' => now()], ['name' => 'Obstetrician', 'created_at' => now(), 'updated_at' => now()],];

        DB::table('specialty')->insert($data);
    }
}
