<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{   
    use HasFactory;

    # Hacemos una lista blanca con los atributos de la tarea que se pueden llenar
    protected $fillable = [
    'title',
    'description',
    'status',
    ];

    # si la petición no lleva status se autocompleta con pending
    protected $attributes = [
        'status' => 'pending',
    ];

    /**
     * Scope dedicado: Tareas pendientes.
     * Uso: Task::pending()->get()
     */
    public function scopePending(Builder $query): void
    {
        $query->where('status', 'pending'); 
    }
    
    /**
     * Scope dedicado: Tareas en progreso.
     * Uso: Task::inProgress()->get()
     */
    public function scopeInProgress(Builder $query): void
    {
        $query->where('status', 'in_progress');
    }
    
    /**
     * Scope dedicado: Tareas terminadas.
     * Uso: Task::done()->get()
     */
    public function scopeDone(Builder $query): void
    {
        $query->where('status', 'done');
    }
}
