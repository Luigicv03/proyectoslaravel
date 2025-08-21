<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class ProjectExport implements FromArray, WithTitle, WithStyles
{
    protected $project;

    public function __construct($project)
    {
        $this->project = $project;
    }

    public function array(): array
    {
        $data = [];

        // Título principal
        $data[] = ['INFORME COMPLETO DEL PROYECTO'];
        $data[] = [''];

        // INFORMACIÓN GENERAL
        $data[] = ['INFORMACIÓN GENERAL DEL PROYECTO'];
        $data[] = ['Campo', 'Valor'];
        $data[] = ['Nombre del Proyecto', $this->project->name];
        $data[] = ['Formato', $this->project->format->name];
        $data[] = ['Código del Proyecto', $this->project->project_code ?: 'No especificado'];
        $data[] = ['Tipo de Proyecto', $this->project->project_type ?: 'No especificado'];
        $data[] = ['Identificador', $this->project->project_identifier ?: 'No especificado'];
        $data[] = ['Estado', $this->project->status_display];
        $data[] = ['Progreso', $this->project->progress_percentage . '%'];
        $data[] = ['Prioridad', ucfirst($this->project->priority)];
        $data[] = ['Descripción', $this->project->description ?: 'No especificada'];
        $data[] = ['Fecha de Creación', $this->project->created_at->format('d/m/Y H:i:s')];
        $data[] = ['Última Actualización', $this->project->updated_at->format('d/m/Y H:i:s')];
        $data[] = [''];

        // FECHAS IMPORTANTES
        $data[] = ['FECHAS IMPORTANTES DEL PROYECTO'];
        $data[] = ['Campo', 'Fecha'];
        $data[] = ['Fecha de Solicitud', $this->project->request_date ? $this->project->request_date->format('d/m/Y') : 'No especificada'];
        $data[] = ['Fecha de Recepción', $this->project->reception_date ? $this->project->reception_date->format('d/m/Y') : 'No especificada'];
        $data[] = ['Certificación de Desarrollo', $this->project->development_certification_date ? $this->project->development_certification_date->format('d/m/Y') : 'No especificada'];
        $data[] = ['Fecha Tentativa de Producción', $this->project->tentative_production_date ? $this->project->tentative_production_date->format('d/m/Y') : 'No especificada'];
        $data[] = ['Fecha de Salida a Producción', $this->project->production_release_date ? $this->project->production_release_date->format('d/m/Y') : 'No especificada'];
        $data[] = ['Fecha de Compromiso Obligatorio', $this->project->mandatory_commitment_date ? $this->project->mandatory_commitment_date->format('d/m/Y') : 'No especificada'];
        $data[] = [''];

        // UNIDADES ORGANIZACIONALES
        $data[] = ['UNIDADES ORGANIZACIONALES'];
        $data[] = ['UNIDAD SOLICITANTE'];
        $data[] = ['Campo', 'Valor'];
        $data[] = ['Dirección General', $this->project->soliciting_direction_general ?: 'No especificada'];
        $data[] = ['Línea de Gestión', $this->project->soliciting_line_management ?: 'No especificada'];
        $data[] = [''];
        $data[] = ['UNIDAD DESTINATARIA'];
        $data[] = ['Campo', 'Valor'];
        $data[] = ['Dirección General', $this->project->destination_direction_general ?: 'No especificada'];
        $data[] = ['Línea de Gestión', $this->project->destination_line_management ?: 'No especificada'];
        $data[] = [''];

        // TIPO DE REGULACIÓN
        $data[] = ['TIPO DE REGULACIÓN'];
        $data[] = ['Regulación', 'Aplicable'];
        $data[] = ['Regulación Organizacional', $this->project->regulation_organizational ? 'Sí' : 'No'];
        $data[] = ['Regulación Operacional', $this->project->regulation_operational ? 'Sí' : 'No'];
        $data[] = ['Auditoría Interna', $this->project->regulation_audit_internal ? 'Sí' : 'No'];
        $data[] = ['Auditoría Externa', $this->project->regulation_audit_external ? 'Sí' : 'No'];
        $data[] = ['Regulación de Servicio', $this->project->regulation_service ? 'Sí' : 'No'];
        $data[] = ['Regulación Técnica', $this->project->regulation_technical ? 'Sí' : 'No'];
        $data[] = ['Regulación Obligatoria', $this->project->regulation_mandatory ? 'Sí' : 'No'];
        $data[] = [''];
        $data[] = ['RANGO SUB-LEGAL'];
        $data[] = ['Regulación', 'Aplicable'];
        $data[] = ['Circular Oficial Sub-Legal', $this->project->sublegal_circular_official ? 'Sí' : 'No'];
        $data[] = ['Gaceta Oficial Sub-Legal', $this->project->sublegal_official_gazette ? 'Sí' : 'No'];
        $data[] = [''];

        // VINCULACIÓN CON PLAN FINANCIERO
        $data[] = ['VINCULACIÓN CON PLAN FINANCIERO'];
        $data[] = ['Plan Financiero', 'Vinculado'];
        $data[] = ['Eficiencia Operacional', $this->project->financial_plan_operational_efficiency ? 'Sí' : 'No'];
        $data[] = ['Estabilidad Financiera', $this->project->financial_plan_financial_stability ? 'Sí' : 'No'];
        $data[] = ['Solución al Cliente', $this->project->financial_plan_customer_solution ? 'Sí' : 'No'];
        $data[] = [''];

        // IMPACTO A NIVEL DE ATENCIÓN
        $data[] = ['IMPACTO A NIVEL DE ATENCIÓN'];
        $data[] = ['Tipo de Impacto', 'Aplicable'];
        $data[] = ['Alto Impacto en Negocio', $this->project->impact_business_high ? 'Sí' : 'No'];
        $data[] = ['Medio Impacto Operacional', $this->project->impact_operational_medium ? 'Sí' : 'No'];
        $data[] = ['Medio Impacto Tecnológico', $this->project->impact_technological_medium ? 'Sí' : 'No'];
        $data[] = ['Alto Impacto Financiero', $this->project->impact_financial_high ? 'Sí' : 'No'];
        $data[] = ['Sistema Impactado', $this->project->impacted_system ?: 'No especificado'];
        $data[] = [''];

        // LIDERAZGO Y CALIDAD
        $data[] = ['LIDERAZGO Y CALIDAD'];
        $data[] = ['Campo', 'Valor'];
        $data[] = ['Líder del Proyecto', $this->project->project_leader ?: 'No especificado'];
        $data[] = ['Ambiente de Calidad', $this->project->quality_environment ? 'Sí' : 'No'];
        $data[] = ['Justificación', $this->project->justification ?: 'No especificada'];
        $data[] = [''];

        // ELABORADO POR
        $data[] = ['ELABORADO POR'];
        $data[] = ['Campo', 'Valor'];
        $data[] = ['Nombre', $this->project->prepared_by_name ?: 'No especificado'];
        $data[] = ['Cargo', $this->project->prepared_by_position ?: 'No especificado'];
        $data[] = ['Extensión', $this->project->prepared_by_extension ?: 'No especificado'];
        $data[] = ['Firma', $this->project->prepared_by_signature ?: 'No especificado'];
        $data[] = [''];

        // AUTORIZADO POR
        $data[] = ['AUTORIZADO POR'];
        $data[] = ['Campo', 'Valor'];
        $data[] = ['Nombre', $this->project->authorized_by_name ?: 'No especificado'];
        $data[] = ['Cargo', $this->project->authorized_by_position ?: 'No especificado'];
        $data[] = ['Firma', $this->project->authorized_by_signature ?: 'No especificado'];
        $data[] = ['Sello', $this->project->authorized_by_seal ?: 'No especificado'];
        $data[] = [''];

        // RECIBIDO POR
        $data[] = ['RECIBIDO POR'];
        $data[] = ['Campo', 'Valor'];
        $data[] = ['Recibido Por', $this->project->received_by ?: 'No especificado'];
        $data[] = ['Firma y Sello', $this->project->received_signature_seal ?: 'No especificado'];
        $data[] = ['Observaciones', $this->project->observation ?: 'No especificadas'];
        $data[] = [''];

        // HISTORIAL DE ESTADOS
        $data[] = ['HISTORIAL DE ESTADOS'];
        $data[] = ['Estado Anterior', 'Estado Nuevo', 'Cambiado Por', 'Fecha', 'Notas'];
        
        if ($this->project->statusHistory->count() > 0) {
            foreach ($this->project->statusHistory->sortByDesc('created_at') as $history) {
                $data[] = [
                    $history->from_status_display,
                    $history->to_status_display,
                    $history->changedBy->name,
                    $history->created_at->format('d/m/Y H:i:s'),
                    $history->notes ?: 'Sin notas'
                ];
            }
        } else {
            $data[] = ['No hay historial de cambios de estado', '', '', '', ''];
        }
        $data[] = [''];

        // RECURSOS ASIGNADOS
        $data[] = ['RECURSOS ASIGNADOS'];
        $data[] = ['Nombre', 'Tipo', 'Estado', 'Descripción'];
        
        if ($this->project->resources->count() > 0) {
            foreach ($this->project->resources as $resource) {
                $data[] = [
                    $resource->name,
                    $resource->type_display,
                    ucfirst($resource->status),
                    $resource->description ?: 'Sin descripción'
                ];
            }
        } else {
            $data[] = ['No hay recursos asignados', '', '', ''];
        }
        $data[] = [''];

        // HISTORIAL DE IMPORTACIONES
        $data[] = ['HISTORIAL DE IMPORTACIONES'];
        $data[] = ['Archivo', 'Fecha de Importación', 'Tareas Importadas'];
        
        if ($this->project->dataImports->count() > 0) {
            foreach ($this->project->dataImports as $import) {
                $data[] = [
                    $import->file_name,
                    $import->import_date->format('d/m/Y H:i:s'),
                    $import->snapshots->count() . ' tareas'
                ];
            }
        } else {
            $data[] = ['No hay importaciones registradas', '', ''];
        }

        return $data;
    }

    public function title(): string
    {
        return 'Proyecto - ' . $this->project->name;
    }

    public function styles(Worksheet $sheet)
    {
        $styles = [];
        
        // Título principal
        $styles[1] = ['font' => ['bold' => true, 'size' => 18]];
        
        // Secciones principales
        $sectionRows = [4, 17, 26, 35, 47, 53, 60, 66, 73, 80, 87, 94, 102, 110];
        
        foreach ($sectionRows as $row) {
            $styles[$row] = ['font' => ['bold' => true, 'size' => 14]];
        }
        
        // Encabezados de tabla
        $headerRows = [5, 18, 27, 28, 36, 48, 54, 61, 67, 74, 81, 88, 95, 103, 111];
        
        foreach ($headerRows as $row) {
            $styles[$row] = ['font' => ['bold' => true]];
        }
        
        // Ajustar ancho de columnas
        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(25);
        $sheet->getColumnDimension('D')->setWidth(25);
        $sheet->getColumnDimension('E')->setWidth(20);
        
        return $styles;
    }
}
