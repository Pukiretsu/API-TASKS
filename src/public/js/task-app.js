/**
 * task-app.js
 * * Contiene toda la lógica de AJAX y manipulación del DOM
 * para las vistas de Blade (task_list.blade.php y task_form.blade.php).
 * Se utiliza jQuery para simplificar las llamadas AJAX y la manipulación del DOM.
 * * Se exporta como una variable global (window.taskApp) para ser accesible
 * desde los scripts inline de Blade.
 */

// Objeto global para contener todas las funciones de la aplicación
window.taskApp = (function() {
    const API_BASE_URL = '/api/tasks';

    // Función para mostrar el modal de mensajes (se incluye en ambas vistas)
    function showModal(title, message) {
        $('#modal-title').text(title);
        $('#modal-message').html(message);
        $('#message-modal').removeClass('hidden').addClass('flex');
    }

    // Función para cerrar el modal
    function closeModal() {
        $('#message-modal').removeClass('flex').addClass('hidden');
    }

    // Carga la lista de tareas (GET /api/tasks?status=...)
    function loadTasks(status = '') {
        const url = status ? `${API_BASE_URL}?status=${status}` : API_BASE_URL;
        const container = $('#tasks-container');
        container.html('<p class="text-gray-500 text-center">Cargando tareas...</p>');

        // Logica para mostrar los botones activos para filtrar por etiqueta
        const ACTIVE_STATUS_CLASSES = {
            '': 'bg-gray-700 text-white shadow-inner',                  // Todas
            'pending': 'bg-red-700 text-white shadow-inner',            // Pending
            'in_progress': 'bg-yellow-500 text-white shadow-inner',     // In Progress
            'done': 'bg-green-700 text-white shadow-inner'              // Done
        };

        // Quitar todos los posibles estados activos y los colores de texto base.
        // Se añaden text-XXX-700 para forzar la eliminación del color de texto base.
        const classesToStrip = 'bg-primary-500 shadow-inner scale-105 ' +
                               'bg-gray-700 bg-red-700 bg-yellow-500 bg-green-700 text-white ' +
                               'text-gray-700 text-red-700 text-yellow-700 text-green-700';
        $('.filter-btn').removeClass(classesToStrip);
        
        // Determinar las clases a aplicar al botón activo
        const activeClasses = ACTIVE_STATUS_CLASSES[status] || ACTIVE_STATUS_CLASSES[''];
        
        // Aplicar el nuevo estado activo al botón seleccionado.
        // Esto sobreescribe los colores base claros (bg-XXX-100) del botón.
        $(`.filter-btn[data-status="${status}"]`).addClass(activeClasses);

        $.ajax({
            url: url,
            method: 'GET',
            success: function(tasks) {
                renderTasks(tasks);
            },
            error: function() { // handler cuando algo falla, sea el servidor o la DB
                container.html('<p class="text-danger-500 text-center font-semibold">Error al cargar tareas.</p>');
            }
        });
    }

    // Renderiza la lista de tareas en el contenedor
    function renderTasks(tasks) {
        const container = $('#tasks-container');
        container.empty();

        if (tasks.length === 0) {
            container.html('<p class="text-gray-500 text-center p-4 border rounded-lg bg-gray-50">No hay tareas que coincidan con el filtro.</p>');
            return;
        }

        tasks.forEach(task => {
            // Definición de colores: Usa el esquema de color (bg-100 y text-700) para coincidir con los botones de filtro.
            let statusColor = {
                'pending': 'bg-red-100 text-red-700',
                'in_progress': 'bg-yellow-100 text-yellow-700',
                'done': 'bg-green-100 text-green-700'
            }[task.status] || 'bg-gray-200 text-gray-700'; // Default usa gris para consistencia.

            // Formateo del texto de los estados
            let displayStatus = task.status.replace('_', ' ').split(' ').map(w => w.charAt(0).toUpperCase() + w.slice(1)).join(' ');

            // Formatea la fecha al locale del usuario usando el campo created
            // created_at es una cadena de fecha válida 
            let formattedDate = new Intl.DateTimeFormat(navigator.language, { 
                year: 'numeric', 
                month: 'short', 
                day: 'numeric', 
                hour: '2-digit', 
                minute: '2-digit'
            }).format(new Date(task.created_at));

            const taskElement = `
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200 shadow-sm transition hover:shadow-md">
                    <div class="grow mb-3 sm:mb-0">
                        <!-- Título de la tarea -->
                        <h3 class="text-lg font-semibold text-gray-800">${task.title}</h3>
                        
                        <div class="flex items-center space-x-3 mt-1 mb-2">
                            <!-- Estado (Status) -->
                            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full ${statusColor}">
                                ${displayStatus}
                            </span>
                            <!-- Fecha de Creación -->
                            <span class="text-xs text-gray-500">
                                ${formattedDate}
                            </span>
                        </div>

                        <!-- Descripción -->
                        <p class="text-sm text-gray-600">${task.description}</p>
                    </div>
                    <div class="flex space-x-2 shrink-0">
                        <!-- Botón para editar: redirige a la nueva ruta /tasks/{id}/edit -->
                        <button onclick="taskApp.redirectToEdit(${task.id})" class="text-primary-500 hover:text-indigo-700 p-2 rounded-full hover:bg-indigo-50 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M17 3a2.85 2.85 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5Z"/></svg>
                        </button>
                        <!-- Botón para eliminar: Llama a la nueva función de confirmación -->
                        <button onclick="taskApp.confirmDelete(${task.id})" class="text-danger-500 hover:text-red-700 p-2 rounded-full hover:bg-red-50 transition duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M10 11v6"/><path d="M14 11v6"/><path d="M12 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                        </button>
                    </div>
                </div>
            `;
            container.append(taskElement);
        });
    }
    
    /**
     * Muestra el modal de confirmación con botones personalizados antes de eliminar.
     */
    function confirmDelete(id) {
        const title = 'Confirmar Eliminación';
        const message = `
            <p class="text-gray-700 mb-6 text-base">¿Estás seguro de que deseas eliminar la tarea? </p>
            <p><b>Esta acción no se puede deshacer.</p>
            <div class="flex justify-end space-x-3 mt-4">
                <button onclick="taskApp.closeModal()" class="px-5 py-2 bg-gray-300 text-gray-800 font-semibold rounded-lg hover:bg-gray-400 transition shadow">
                    Cancelar
                </button>
                <button onclick="taskApp.deleteTask(${id})" class="px-5 py-2 bg-danger-500 text-white font-semibold rounded-lg hover:bg-danger-600 transition shadow">
                    Eliminar
                </button>
            </div>
        `;
        showModal(title, message);
    }

    /**
     * Función que solo realiza la redirección a la ruta de edición.
     * Se usa en la vista de lista (task_list.blade.php).
     */
    function redirectToEdit(id) {
        window.location.href = `/tasks/${id}/edit`; 
    }

    // Elimina una tarea (DELETE /api/tasks/{id})
    function deleteTask(id) {
        // Cierra el modal de confirmación antes de enviar la solicitud AJAX
        closeModal(); 
        
        $.ajax({
            url: `${API_BASE_URL}/${id}`,
            method: 'DELETE',
            // Laravel usa la etiqueta @csrf para generar el token.
            // Para peticiones AJAX, jQuery lo obtiene del campo oculto.
            headers: { // En Laravel, el token CSRF se obtiene del campo oculto o de las cookies
                'X-CSRF-TOKEN': $('input[name="_token"]').val() 
            },
            success: function() {
                showModal('Éxito', 'Tarea eliminada correctamente.');
                loadTasks(); // Recargar la lista
            },
            error: function() {
                showModal('Error', 'No se pudo eliminar la tarea.');
            }
        });
    }

    return {
        loadTasks,
        deleteTask,
        showModal,
        closeModal,
        confirmDelete,
        redirectToEdit,
    };
})();