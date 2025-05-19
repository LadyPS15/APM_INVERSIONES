<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      DB::table('schedules')->insert([
            [
                'description' => '08:00 AM a 2:00 PM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'description' => '2:00 PM a 8:00 PM',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
