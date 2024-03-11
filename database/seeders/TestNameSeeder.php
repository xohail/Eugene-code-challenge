<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Carrier Screening - Individual', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Carrier Screening - Couple', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cancer Screening', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cardiac Screening', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('test_names')->insert($data);
    }
}
