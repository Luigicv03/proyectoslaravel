<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador personalizado
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@sgp.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Crear usuario project manager personalizado
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan@sgp.com',
            'password' => Hash::make('juan123'),
            'role' => 'pm',
        ]);

        // Crear usuario project manager adicional
        User::create([
            'name' => 'María García',
            'email' => 'maria@sgp.com',
            'password' => Hash::make('maria123'),
            'role' => 'pm',
        ]);

        echo "✅ Usuarios personalizados creados:\n";
        echo "   - Admin: admin@sgp.com / admin123\n";
        echo "   - PM: juan@sgp.com / juan123\n";
        echo "   - PM: maria@sgp.com / maria123\n";
    }
}
