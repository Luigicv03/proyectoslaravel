<?php

namespace Database\Seeders;

use App\Models\ProjectFormat;
use Illuminate\Database\Seeder;

class ProjectFormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProjectFormat::create([
            'name' => 'Formato Estándar',
            'description' => 'Formato estándar para proyectos de desarrollo de software',
        ]);

        ProjectFormat::create([
            'name' => 'Formato Ágil',
            'description' => 'Formato adaptado para metodologías ágiles',
        ]);

        ProjectFormat::create([
            'name' => 'Formato Personalizado',
            'description' => 'Formato personalizable según necesidades específicas',
        ]);
    }
}
