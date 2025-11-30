<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Tareas</title>
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

    <div class="max-w-4xl mx-auto bg-white shadow-2xl rounded-xl p-6 sm:p-8">
        <header class="mb-8 flex justify-between items-center border-b pb-4">
            <h1 class="text-3xl font-bold text-gray-800">📋 Lista de Tareas</h1>
            <a href="{{ route('tasks.create') }}" class="bg-primary-500 hover:bg-indigo-600 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-300">
                + Nueva Tarea
            </a>
        </header>

        <!-- Filtros de Tareas -->
        <section id="list-view">
            <div class="flex flex-wrap gap-4 mb-6">
                <button data-status="" class="filter-btn bg-gray-200 text-gray-700 hover:bg-gray-300 py-1 px-3 rounded-full text-sm font-medium transition duration-300">Todas</button>
                <button data-status="pending" class="filter-btn bg-red-100 text-red-700 hover:bg-red-200 py-1 px-3 rounded-full text-sm font-medium transition duration-300">Pending</button>
                <button data-status="in_progress" class="filter-btn bg-yellow-100 text-yellow-700 hover:bg-yellow-200 py-1 px-3 rounded-full text-sm font-medium transition duration-300">In Progress</button>
                <button data-status="done" class="filter-btn bg-green-100 text-green-700 hover:bg-green-200 py-1 px-3 rounded-full text-sm font-medium transition duration-300">Done</button>
            </div>
            
            <div id="tasks-container" class="space-y-4">
                <p class="text-gray-500 text-center">Cargando tareas...</p>
            </div>
        </section>
    
        @include('partials.message-modal')

    </div>

    <!-- Script de inicialización de la vista -->
    <script>
        $(document).ready(function() {
            // Manejador para los botones de filtro
            $('.filter-btn').on('click', function() {
                const status = $(this).data('status');
                if (window.taskApp) window.taskApp.loadTasks(status);
            });
            
            // Carga inicial de tareas
            if (window.taskApp) window.taskApp.loadTasks();
        });
    </script>
</body>
</html>