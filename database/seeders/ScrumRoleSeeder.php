<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ScrumRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('scrum_roles')->insert([
            ['name' => 'Scrum Master', 'description' => 'Facilita la metodología Scrum en el equipo.'],
            ['name' => 'Product Owner', 'description' => 'Representa los intereses del cliente y gestiona el backlog.'],
            ['name' => 'Developer', 'description' => 'Responsable del desarrollo y entrega del producto.'],
            ['name' => 'Tester', 'description' => 'Encargado de asegurar la calidad mediante pruebas.'],
        ]);
    }
}
