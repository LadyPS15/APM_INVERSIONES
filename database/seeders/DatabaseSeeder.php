<?php

namespace Database\Seeders;
use App\Models\Careers;


use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CareersTableSeeder::class,
            SpecializationSeeder::class,
            ProgrammingLanguageSeeder::class,
            ScheduleSeeder::class,
            ScrumRoleSeeder::class,
        ]);


        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
