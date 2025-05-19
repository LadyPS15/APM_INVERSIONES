<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class ProgrammingLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('programming_languages')->insert([
            ['name' => 'PHP'],
            ['name' => 'Python'],
            ['name' => 'JavaScript'],
            ['name' => 'C#'],
            ['name' => 'Java'],
            ['name' => 'Ruby'],
        ]);
    }
}
