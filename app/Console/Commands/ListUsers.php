<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class ListUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Listar todos los usuarios del sistema';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->info('No hay usuarios en el sistema');
            return 0;
        }

        $this->info('Usuarios del sistema:');
        $this->newLine();

        $headers = ['ID', 'Nombre', 'Email', 'Rol', 'Creado'];
        $rows = [];

        foreach ($users as $user) {
            $rows[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->role,
                $user->created_at->format('d/m/Y H:i')
            ];
        }

        $this->table($headers, $rows);

        return 0;
    }
}
