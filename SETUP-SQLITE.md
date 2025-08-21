# 🔧 Configuración de SQLite - Solución al Error de Base de Datos

## Problema
El error indica que está intentando conectarse a una base de datos llamada 'laravel' que no existe.

## Solución Paso a Paso

### 1. Configurar SQLite
```bash
# Ejecutar el script de configuración
php setup-database.php
```

### 2. Generar clave de aplicación
```bash
php artisan key:generate
```

### 3. Ejecutar migraciones y seeders
```bash
php artisan migrate --seed
```

### 4. Verificar que todo funciona
```bash
php artisan serve
```

## 📋 Usuarios Disponibles

Después de ejecutar los seeders, tendrás estos usuarios:

### Usuarios por Defecto:
- **Admin:** `admin@example.com` / `password`
- **PM:** `pm@example.com` / `password`

### Usuarios Personalizados:
- **Admin Principal:** `admin@sgp.com` / `admin123`
- **Juan Pérez:** `juan@sgp.com` / `juan123`
- **María García:** `maria@sgp.com` / `maria123`

## 🛠️ Comandos para Gestionar Usuarios

### Crear nuevo usuario:
```bash
php artisan user:create "Nombre Usuario" "email@ejemplo.com" "contraseña" "admin"
```

### Cambiar contraseña:
```bash
php artisan user:password "email@ejemplo.com" "nueva_contraseña"
```

### Listar usuarios:
```bash
php artisan user:list
```

## 📁 Estructura de Archivos SQLite

```
project-management-system/
├── database/
│   ├── database.sqlite    # Base de datos SQLite
│   ├── migrations/        # Migraciones
│   └── seeders/          # Seeders
├── .env                   # Configuración (actualizada automáticamente)
└── setup-database.php    # Script de configuración
```

## ✅ Verificación

1. El archivo `database/database.sqlite` debe existir
2. El archivo `.env` debe tener:
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=database/database.sqlite
   ```
3. Las migraciones deben ejecutarse sin errores
4. Debes poder acceder a `http://localhost:8000/login`

## 🚨 Si sigues teniendo problemas:

1. **Limpiar cache:**
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Verificar permisos:**
   ```bash
   chmod 755 database/
   chmod 644 database/database.sqlite
   ```

3. **Recrear base de datos:**
   ```bash
   rm database/database.sqlite
   php setup-database.php
   php artisan migrate --seed
   ```

## 📞 Soporte

Si necesitas ayuda adicional, verifica:
- Que PHP tenga la extensión SQLite habilitada
- Que los permisos de archivo sean correctos
- Que el archivo `.env` esté configurado correctamente
