<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'project_format_id',
        'status',
        'project_code',
        'project_type',
        'reception_date',
        'observation',
        'progress_percentage',
        'development_certification_date',
        'passes_to_quality',
        'tentative_production_date',
        'production_release_date',
        'description',
        'project_identifier',
    ];

    protected $casts = [
        'reception_date' => 'date',
        'development_certification_date' => 'date',
        'tentative_production_date' => 'date',
        'production_release_date' => 'date',
        'passes_to_quality' => 'boolean',
    ];

    /**
     * Get the format for this project
     */
    public function format(): BelongsTo
    {
        return $this->belongsTo(ProjectFormat::class, 'project_format_id');
    }

    /**
     * Get the data imports for this project
     */
    public function dataImports(): HasMany
    {
        return $this->hasMany(DataImport::class);
    }

    /**
     * Get the latest import for this project
     */
    public function latestImport()
    {
        return $this->hasOne(DataImport::class)->latest();
    }

    /**
     * Get the resources for this project
     */
    public function resources(): HasMany
    {
        return $this->hasMany(ProjectResource::class);
    }

    /**
     * Get the status history for this project
     */
    public function statusHistory(): HasMany
    {
        return $this->hasMany(ProjectStatusHistory::class);
    }

    /**
     * Get status display name
     */
    public function getStatusDisplayAttribute(): string
    {
        switch($this->status) {
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
     * Get the assigned leader
     */
    public function leader()
    {
        return $this->resources()->where('type', 'lider')->first();
    }
}
