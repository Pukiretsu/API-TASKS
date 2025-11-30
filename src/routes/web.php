<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskViewController;

// Redirige la ruta raíz a la lista de tareas
Route::redirect('/', '/tasks');

Route::controller(TaskViewController::class)->group(function () {
    // 1. Ruta para la lista de tareas: /tasks
    Route::get('/tasks', 'index')->name('tasks.index');

    // 2. Ruta para el formulario de creación: /tasks/create
    Route::get('/tasks/create', 'create')->name('tasks.create');

    // 3. Ruta para el formulario de edición: /tasks/{task}/edit
    Route::get('/tasks/{taskId}/edit', 'edit')->name('tasks.edit');
});
