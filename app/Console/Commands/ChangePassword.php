<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ChangePassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:password {email} {new_password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambiar la contraseña de un usuario';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $newPassword = $this->argument('new_password');

        // Buscar el usuario
        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error('No se encontró un usuario con ese email');
            return 1;
        }

        // Actualizar la contraseña
        $user->update([
            'password' => Hash::make($newPassword)
        ]);

        $this->info("✅ Contraseña actualizada exitosamente para:");
        $this->line("   Usuario: {$user->name}");
        $this->line("   Email: $email");
        $this->line("   Nueva contraseña: $newPassword");

        return 0;
    }
}
