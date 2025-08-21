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
        // UNIDAD SOLICITANTE
        'soliciting_direction_general',
        'soliciting_line_management',
        // UNIDAD DESTINATARIA
        'destination_direction_general',
        'destination_line_management',
        // Prioridad
        'priority',
        // TIPO DE REGULACION
        'regulation_organizational',
        'regulation_operational',
        'regulation_audit_internal',
        'regulation_audit_external',
        'regulation_service',
        'regulation_technical',
        'regulation_mandatory',
        // Mandatorio/regulatorio
        'mandatory_commitment_date',
        // Rango Sub-Legal
        'sublegal_circular_official',
        'sublegal_official_gazette',
        // VINCULACION CON EL PLAN FINANCIERO
        'financial_plan_operational_efficiency',
        'financial_plan_financial_stability',
        'financial_plan_customer_solution',
        // IMPACTO A NIVEL DE ATENCION
        'impact_business_high',
        'impact_operational_medium',
        'impact_technological_medium',
        'impact_financial_high',
        // SISTEMA QUE IMPACTA
        'impacted_system',
        // LIDER DE PROYECTO
        'project_leader',
        // AMBIENTE DE CALIDAD
        'quality_environment',
        // JUSTIFICACION
        'justification',
        // ELABORADO POR
        'prepared_by_name',
        'prepared_by_position',
        'prepared_by_extension',
        'prepared_by_signature',
        // AUTORIZADO POR
        'authorized_by_name',
        'authorized_by_position',
        'authorized_by_signature',
        'authorized_by_seal',
        // Recibido
        'received_by',
        'received_signature_seal',
        // Fecha de solicitud
        'request_date',
    ];

    protected $casts = [
        'reception_date' => 'date',
        'development_certification_date' => 'date',
        'tentative_production_date' => 'date',
        'production_release_date' => 'date',
        'mandatory_commitment_date' => 'date',
        'request_date' => 'date',
        'passes_to_quality' => 'boolean',
        'regulation_organizational' => 'boolean',
        'regulation_operational' => 'boolean',
        'regulation_audit_internal' => 'boolean',
        'regulation_audit_external' => 'boolean',
        'regulation_service' => 'boolean',
        'regulation_technical' => 'boolean',
        'regulation_mandatory' => 'boolean',
        'sublegal_circular_official' => 'boolean',
        'sublegal_official_gazette' => 'boolean',
        'financial_plan_operational_efficiency' => 'boolean',
        'financial_plan_financial_stability' => 'boolean',
        'financial_plan_customer_solution' => 'boolean',
        'impact_business_high' => 'boolean',
        'impact_operational_medium' => 'boolean',
        'impact_technological_medium' => 'boolean',
        'impact_financial_high' => 'boolean',
        'quality_environment' => 'boolean',
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
