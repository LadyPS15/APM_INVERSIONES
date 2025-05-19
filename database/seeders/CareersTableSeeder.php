<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CareersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('careers')->insert([
            [
            'name' => 'Ingeniería de Software',
            'description' => 'Formación en desarrollo y mantenimiento de software.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Ingeniería de Sistemas',
            'description' => 'Estudio de sistemas de información y tecnologías.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Desarrollador Web',
            'description' => 'Especialista en creación y mantenimiento de sitios y aplicaciones web.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Desarrollador de Software',
            'description' => 'Profesional en el diseño, desarrollo y prueba de aplicaciones de software.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Diseño Gráfico',
            'description' => 'Formación en diseño visual y creación de contenido gráfico digital.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Analista de Sistemas',
            'description' => 'Especialista en análisis, diseño y mejora de sistemas informáticos.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Ciberseguridad',
            'description' => 'Formación en protección de sistemas y redes informáticas.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Soporte Técnico en Informática',
            'description' => 'Especialista en asistencia y solución de problemas informáticos.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Administrador de Bases de Datos',
            'description' => 'Profesional en gestión y mantenimiento de bases de datos.',
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
        
    }
}