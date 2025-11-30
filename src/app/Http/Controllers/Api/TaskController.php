<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     * Ruta: 
     * GET /api/tasks
     */
    public function index(Request $request)
    {
        $status = $request->query('status');

        $query = Task::query();

        /**
         * Si el status existe trae el scope dinamico
         * inutiliza los scopes dedicados sin embargo
         * vuelve más facil implementar nuevos estados solo cambiando
         * el enum de la migración
         */
        if ($status) {
            $query->byStatus($status);
        }

        return response()->json($query->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     * Ruta:
     * POST /api/tasks
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            // Validamos que el valor de status estè dentro del enum
            'status' => 'sometimes|in:pending,in_progress,done',
        ]);

        $task = Task::create($validatedData);
        
        # Retornamos un 201 Created
        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     * Ruta:
     * GET /api/tasks/{task}
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * Ruta:
     * PUT/PATCH /api/tasks/{task}
     */
    public function update(Request $request, Task $task)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * Ruta:
     * DELETE /api/tasks/{task}
     */
    public function destroy(Task $task)
    {
        //
    }
}
