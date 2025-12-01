# Gestor de Tareas (Task Manager)
Aplicación web simple construida con Laravel 11 para la gestión de tareas (CRUD). La aplicación utiliza Blade para las vistas y jQuery/AJAX para interactuar con una API RESTful.

# Arquitectura del proyecto
Este proyecto sigue la arquitectura **Model-View-Controller (MVC)** de Laravel, pero incorpora una división clara entre el Frontend (Web) y el Backend (API).

1. **Backend (API)**
    - Controlador: ```App\Http\Controllers\Api\TaskController``` (Maneja las solicitudes CRUD a ```/api/tasks```).
    - Modelo: ```App\Models\Task``` (Interactúa con la base de datos y define _scopes_ para filtrar por estado).
2. **Frontend (Web):**
    - Controlador de Vistas: ```App\Http\Controllers\TaskViewController``` (Solo sirve las vistas de Blade: lista, crear, editar).
    - Vistas: ```task_list.blade.php``` y ```task_form.blade.php``` (El cuerpo de la aplicación).
    - Interacción: El JavaScript (```public\js\task-app.js``` usando jQuery/AJAX) se encarga de enviar y recibir datos del API, actualizando las vistas sin recargar la página.

# Esquema de la Base de Datos

El proyecto utiliza una única tabla principal, ```tasks```. El esquema se define en ```src/database/migrations/2025_11_29_000000_create_tasks_table.php```.

| Columna | Tipo | Descripción | Notas |
| :--- | --- | --- | --- |
| id | BIGINT UNSIGNED | Clave primaria. | Auto-incremental. |
| title | VARCHAR(255) | Título de la tarea. | Requerido. |
| description | TEXT | Descripción detallada. | Opcional (nullable). |
| status | ENUM | Estado actual de la tarea. | Valores: pending, in_progress, done. Por defecto: pending. |
| created_at | TIMESTAMP | Fecha de creación. | Automático. |
| updated_at | TIMESTAMP | Fecha de última actualización. | Automático. |

# Referencia de la API RESTful

Todas las interacciones de datos se realizan a través de la API, gestionada por ```TaskController.php```.

| Método | Endpoint | Descripción | Petición (Body) |
| :--- | --- | --- | --- |
| GET | /api/tasks | Lista todas las tareas. | Ninguno. Opcional: ?status=pending |
| GET | /api/tasks/{id} | Muestra una tarea específica. | Ninguno. |
| POST | /api/tasks | Crea una nueva tarea. | title (required), description, status |
| PUT | /api/tasks/{id} | Actualiza completamente una tarea. | title, description, status |
| DELETE | /api/tasks/{id} | Elimina una tarea. | Ninguno. |

El resto de endpoints de la app pueden ser consultados en
```
php artisan route:list
```

Autor: Angel Leonardo Gonzalez Padilla (Pukiretsu)
Versión: 1.0