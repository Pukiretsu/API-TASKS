<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TaskViewController extends Controller
{
    /**
     * Muestra la vista de listado de todas las tareas.
     * Corresponde a la ruta: GET /tasks
     *
     * @return \Illuminate\Contracts\View\View
     */

    public function index()
    {
        // Retorna la vista 'task_list.blade.php'.
        return view('task_list');
    }

    /**
     * Muestra la vista del formulario para crear una nueva tarea.
     * Corresponde a la ruta: GET /tasks/create
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Retorna la vista 'task_form.blade.php'.
        // Pasamos null como 'taskId' para indicarle a la vista que es un modo de creación.
        return view('task_form', [
            'taskId' => null
        ]);
    }

    /**
     * Muestra la vista del formulario para editar una tarea existente.
     * Corresponde a la ruta: GET /tasks/{taskId}/edit
     *
     * @param int $taskId El ID de la tarea a editar.
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($taskId)
    {
        // Retorna la vista 'task_form.blade.php'.
        // Pasamos el ID de la tarea para que el JavaScript pueda cargar sus datos.
        return view('task_form', [
            'taskId' => $taskId
        ]);
    }
}
