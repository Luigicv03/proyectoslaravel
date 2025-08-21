<?php

require_once 'vendor/autoload.php';

// Cargar la aplicación Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Probando conexión a la base de datos...\n";

try {
    // Verificar la configuración
    echo "DB_CONNECTION: " . env('DB_CONNECTION') . "\n";
    echo "DB_DATABASE: " . env('DB_DATABASE') . "\n";
    
    // Usar la función database_path de Laravel
    $dbPath = database_path('database.sqlite');
    echo "Ruta de BD: " . $dbPath . "\n";
    echo "Archivo de BD existe: " . (file_exists($dbPath) ? 'SÍ' : 'NO') . "\n";
    
    if (file_exists($dbPath)) {
        echo "Tamaño del archivo: " . filesize($dbPath) . " bytes\n";
    }
    
    // Intentar conectar
    $pdo = new PDO('sqlite:' . $dbPath);
    echo "✅ Conexión PDO exitosa\n";
    
    // Verificar tablas
    $tables = $pdo->query("SELECT name FROM sqlite_master WHERE type='table'")->fetchAll(PDO::FETCH_COLUMN);
    echo "Tablas encontradas: " . implode(', ', $tables) . "\n";
    
    // Verificar usuarios
    $users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
    echo "Usuarios en la BD: " . $users . "\n";
    
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
}
