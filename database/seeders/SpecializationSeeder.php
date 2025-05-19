<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('specializations')->insert([
            ['name' => 'Backend', 'description' => 'Desarrollo y gestión de la lógica del servidor y bases de datos.'],
            ['name' => 'Frontend', 'description' => 'Desarrollo de interfaces y experiencia de usuario.'],
            ['name' => 'DevOps', 'description' => 'Automatización y mantenimiento de infraestructuras.'],
            ['name' => 'QA', 'description' => 'Aseguramiento de la calidad y pruebas de software.'],
        ]);
    }
}
