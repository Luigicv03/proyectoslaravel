<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'project_status_history';

    protected $fillable = [
        'project_id',
        'from_status',
        'to_status',
        'notes',
        'changed_by',
    ];

    /**
     * Get the project that owns this history entry
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the user who made the change
     */
    public function changedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'changed_by');
    }

    /**
     * Get from status display name
     */
    public function getFromStatusDisplayAttribute(): string
    {
        if (!$this->from_status) return 'Nuevo Proyecto';
        
        switch($this->from_status) {
            case 'reciente':
                return 'Proyecto Reciente';
            case 'pendiente_activar':
                return 'Pendiente por Activar';
            case 'documento_devuelto':
                return 'Documento Devuelto';
            case 'desarrollo':
                return 'Ambiente de Desarrollo';
            case 'produccion':
                return 'Ambiente de Producción';
            default:
                return 'Estado Desconocido';
        }
    }

    /**
     * Get to status display name
     */
    public function getToStatusDisplayAttribute(): string
    {
        switch($this->to_status) {
            case 'reciente':
                return 'Proyecto Reciente';
            case 'pendiente_activar':
                return 'Pendiente por Activar';
            case 'documento_devuelto':
                return 'Documento Devuelto';
            case 'desarrollo':
                return 'Ambiente de Desarrollo';
            case 'produccion':
                return 'Ambiente de Producción';
            default:
                return 'Estado Desconocido';
        }
    }
}