<?php

// Script para configurar la base de datos SQLite
echo "Configurando base de datos SQLite...\n";

// 1. Crear el directorio database si no existe
if (!is_dir('database')) {
    mkdir('database', 0755, true);
    echo "✓ Directorio database creado\n";
}

// 2. Crear el archivo de base de datos SQLite
$dbPath = 'database/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
    echo "✓ Archivo de base de datos SQLite creado: $dbPath\n";
} else {
    echo "✓ Archivo de base de datos SQLite ya existe\n";
}

// 3. Verificar que el archivo .env existe
if (!file_exists('.env')) {
    echo "❌ Error: El archivo .env no existe. Cópialo desde .env.example\n";
    exit(1);
}

// 4. Actualizar la configuración de base de datos en .env
$envContent = file_get_contents('.env');
$envContent = preg_replace('/DB_CONNECTION=.*/', 'DB_CONNECTION=sqlite', $envContent);
$envContent = preg_replace('/DB_DATABASE=.*/', 'DB_DATABASE=database/database.sqlite', $envContent);

// Remover líneas de MySQL/PostgreSQL
$envContent = preg_replace('/DB_HOST=.*\n/', '', $envContent);
$envContent = preg_replace('/DB_PORT=.*\n/', '', $envContent);
$envContent = preg_replace('/DB_USERNAME=.*\n/', '', $envContent);
$envContent = preg_replace('/DB_PASSWORD=.*\n/', '', $envContent);

file_put_contents('.env', $envContent);
echo "✓ Configuración de base de datos actualizada en .env\n";

echo "\n✅ Base de datos SQLite configurada correctamente!\n";
echo "Ahora ejecuta: php artisan migrate --seed\n";
