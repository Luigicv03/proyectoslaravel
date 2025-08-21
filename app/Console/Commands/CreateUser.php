<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:create {name} {email} {password} {role=pm}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crear un nuevo usuario en el sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');
        $password = $this->argument('password');
        $role = $this->argument('role');

        // Validar que el rol sea válido
        if (!in_array($role, ['admin', 'pm'])) {
            $this->error('El rol debe ser "admin" o "pm"');
            return 1;
        }

        // Verificar si el usuario ya existe
        if (User::where('email', $email)->exists()) {
            $this->error('Ya existe un usuario con ese email');
            return 1;
        }

        // Crear el usuario
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => $role,
        ]);

        $this->info("✅ Usuario creado exitosamente:");
        $this->line("   Nombre: $name");
        $this->line("   Email: $email");
        $this->line("   Rol: $role");
        $this->line("   Contraseña: $password");

        return 0;
    }
}
