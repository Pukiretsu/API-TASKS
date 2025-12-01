<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@if($taskId) Editar Tarea #{{ $taskId }} @else Crear Tarea @endif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="/js/task-app.js"></script> 
    <style>
        body { font-family: ui-sans-serif, system-ui; background-color: #f3f4f6; }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary-500': '#4f46e5',
                        'success-500': '#10b981',
                        'danger-500': '#ef4444',
                    }
                }
            }
        }
    </script>
</head>
<body class="min-h-screen p-4 sm:p-8">

    <div class="max-w-xl mx-auto bg-white shadow-2xl rounded-xl p-6 sm:p-8">
        
        <h2 id="form-title" class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-3">
            @if($taskId) Editar Tarea @else Crear Nueva Tarea @endif
        </h2>
        
        <form id="task-form" class="space-y-4">
            
            <!-- Token de seguridad de Laravel. ¡CRÍTICO para evitar el error 500 si no se le hace handling! -->
            @csrf 
            
            <!-- Pasa el ID al script JS si existe -->
            <input type="hidden" id="task-id" value="{{ $taskId }}">
            
            <!-- Campo para simular el método HTTP (PUT/POST) -->
            <input type="hidden" id="form-method" name="_method" value="{{ $taskId ? 'PUT' : 'POST' }}">

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título</label>
                <input type="text" id="title" name="title" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 shadow-sm">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                <textarea id="description" name="description" rows="4" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 shadow-sm"></textarea>
            </div>

            <div id="status-group">
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select id="status" name="status" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-primary-500 focus:border-primary-500 shadow-sm">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="done">Done</option>
                </select>
            </div>

            <div class="flex justify-end space-x-3 pt-4">
                <a href="/tasks" class="bg-gray-200 text-gray-700 hover:bg-gray-300 font-semibold py-2 px-4 rounded-lg transition duration-300">
                    Cancelar
                </a>
                <button type="submit" id="submit-btn" class="bg-success-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                    @if($taskId) Actualizar Tarea @else Guardar Tarea @endif
                </button>
            </div>
        </form>
    </div>

    @include('partials.message-modal')

    <!-- Script de inicialización de la vista -->
    <script>
        $(document).ready(function() {
            const taskId = $('#task-id').val();
            
            // 1. Carga los datos de la tarea si estamos en modo edición
            if (taskId && window.taskApp) {
                window.taskApp.loadTaskForEdit(taskId);
            }
            
            if (window.taskApp) {
                $('#task-form').on('submit', function(e) {
                    e.preventDefault();
                    window.taskApp.handleFormSubmit(taskId);
                });
            } else {
                 console.error('ERROR: task-app.js no se ha cargado correctamente. El envío del formulario será tradicional.');
            }
        });
    </script>
</body>
</html>