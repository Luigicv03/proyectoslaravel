# Sistema de Gestión de Proyectos (SGP)

Un sistema moderno de gestión de proyectos y análisis de datos desarrollado con Laravel, diseñado para importar, procesar y visualizar datos de avance de proyectos desde archivos Excel.

## 🚀 Características

- **Dashboard Interactivo**: Visualización de métricas y estadísticas en tiempo real
- **Gestión de Proyectos**: Creación y administración de proyectos con diferentes formatos
- **Importación de Excel**: Carga y procesamiento automático de archivos Excel con avances semanales
- **Análisis de Datos**: Gráficos y reportes de progreso por ambiente
- **Autenticación Segura**: Sistema de roles (Admin y Project Manager)
- **Interfaz Moderna**: Diseño responsive con Tailwind CSS

## 📋 Requisitos del Sistema

- PHP 8.2 o superior
- Composer
- MySQL/PostgreSQL/SQLite
- Node.js (opcional, para compilar assets)

## 🛠️ Instalación

### 1. Clonar el repositorio
```bash
git clone <repository-url>
cd project-management-system
```

### 2. Instalar dependencias
```bash
composer install
```

### 3. Configurar el entorno
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar la base de datos
Edita el archivo `.env` y configura tu base de datos:
```env
DB_CONNECTION=sqlite
DB_DATABASE=/path/to/database.sqlite
```

### 5. Ejecutar migraciones y seeders
```bash
php artisan migrate
php artisan db:seed
```

### 6. Configurar el servidor web
```bash
php artisan serve
```

## 👥 Usuarios por Defecto

El sistema incluye dos usuarios predefinidos:

- **Administrador**
  - Email: `admin@example.com`
  - Contraseña: `password`
  - Rol: Admin

- **Project Manager**
  - Email: `pm@example.com`
  - Contraseña: `password`
  - Rol: PM

## 📊 Formato del Archivo Excel

Para importar datos, el archivo Excel debe contener las siguientes columnas:

| Columna | Descripción | Ejemplo |
|---------|-------------|---------|
| `task_identifier` | Identificador único de la tarea | TASK-001 |
| `task_name` | Nombre de la tarea | Desarrollo de login |
| `environment` | Ambiente | Desarrollo, Calidad, Producción |
| `progress_percentage` | Porcentaje de progreso (0-100) | 75 |
| `start_date` | Fecha de inicio | 2024-01-01 |
| `estimated_end_date` | Fecha de fin estimada | 2024-01-15 |

### Ejemplo de estructura:
```csv
task_identifier,task_name,environment,progress_percentage,start_date,estimated_end_date
TASK-001,Desarrollo de login,Desarrollo,75,2024-01-01,2024-01-15
TASK-002,Pruebas unitarias,Calidad,100,2024-01-10,2024-01-12
```

## 🎯 Flujo de Trabajo

### 1. Crear un Proyecto
1. Inicia sesión como Project Manager
2. Ve a "Proyectos" → "Crear Proyecto"
3. Completa el nombre y selecciona un formato
4. Guarda el proyecto

### 2. Importar Datos
1. Ve al detalle del proyecto
2. Haz clic en "Importar Avance"
3. Selecciona tu archivo Excel
4. El sistema procesará automáticamente los datos

### 3. Visualizar Dashboard
1. Ve al Dashboard principal
2. Revisa las métricas y gráficos
3. Analiza las actividades recientes y próximas

## 🏗️ Arquitectura

### Modelos
- `User`: Usuarios y autenticación
- `Project`: Proyectos del sistema
- `ProjectFormat`: Formatos de proyecto
- `DataImport`: Historial de importaciones
- `ProjectSnapshot`: Estados de tareas por importación

### Controladores
- `AuthController`: Autenticación
- `DashboardController`: Dashboard principal
- `ProjectController`: Gestión de proyectos
- `DataImportController`: Importación de datos

### Vistas
- Dashboard con widgets y gráficos
- Gestión de proyectos (CRUD)
- Formulario de importación con drag & drop
- Visualización de datos importados

## 🔧 Configuración Avanzada

### Cambiar Base de Datos
Para usar MySQL o PostgreSQL, actualiza el archivo `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sgp_database
DB_USERNAME=root
DB_PASSWORD=
```

### Configurar Colas (Opcional)
Para archivos grandes, puedes configurar colas:

```bash
php artisan queue:table
php artisan migrate
```

### Configurar Cache
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 🚀 Despliegue

### Producción
1. Configura el servidor web (Apache/Nginx)
2. Establece variables de entorno de producción
3. Ejecuta optimizaciones:
```bash
composer install --optimize-autoloader --no-dev
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Docker (Opcional)
```bash
docker-compose up -d
```

## 📝 Licencia

Este proyecto está bajo la Licencia MIT.

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📞 Soporte

Para soporte técnico o preguntas, contacta al equipo de desarrollo.

---

**Desarrollado con ❤️ usando Laravel**
