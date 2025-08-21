<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'type',
        'status',
        'description',
    ];

    /**
     * Get the project that owns this resource
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get type display name
     */
    public function getTypeDisplayAttribute(): string
    {
        switch($this->type) {
            case 'lider':
                return 'Líder de Proyecto';
            case 'integrante':
                return 'Integrante del Equipo';
            case 'proveedor':
                return 'Proveedor Externo';
            default:
                return 'Tipo Desconocido';
        }
    }
}