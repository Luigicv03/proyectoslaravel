<?php

namespace App\Exports;

use App\Models\Project;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ProjectsByStatusExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    protected $status;

    public function __construct($status)
    {
        $this->status = $status;
    }

    public function collection()
    {
        return Project::with(['format'])
            ->where('status', $this->status)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Identificador',
            'Nombre del Proyecto',
            'Código de Proyecto',
            'Prioridad',
            'Formato',
            'Estado',
            'Progreso (%)',
            'Unidad Solicitante - Dirección General',
            'Unidad Solicitante - Gerencia de Línea',
            'Unidad Destinataria - Dirección General',
            'Unidad Destinataria - Gerencia de Línea',
            'Tipo de Regulación - Organizativo',
            'Tipo de Regulación - Operativo',
            'Tipo de Regulación - Auditoría Interna',
            'Tipo de Regulación - Auditoría Externa',
            'Tipo de Regulación - Servicio',
            'Tipo de Regulación - Técnico',
            'Tipo de Regulación - Mandatorio/Regulatorio',
            'Fecha de Compromiso Mandatorio',
            'Rango Sub-Legal - Circular Oficial',
            'Rango Sub-Legal - Gaceta Oficial',
            'Plan Financiero - Eficiencia Operativa',
            'Plan Financiero - Estabilidad Financiera',
            'Plan Financiero - Solución al Cliente',
            'Impacto - Negocio (Alto)',
            'Impacto - Operativo (Medio)',
            'Impacto - Tecnológico (Medio)',
            'Impacto - Financiero (Alto)',
            'Sistema que Impacta',
            'Líder del Proyecto',
            'Ambiente de Calidad',
            'Justificación',
            'Elaborado por - Nombre',
            'Elaborado por - Cargo',
            'Elaborado por - Extensión',
            'Autorizado por - Nombre',
            'Autorizado por - Cargo',
            'Recibido por',
            'Fecha de Solicitud',
            'Fecha de Creación',
            'Última Actualización'
        ];
    }

    public function map($project): array
    {
        return [
            $project->id,
            $project->project_identifier ?? 'N/A',
            $project->name,
            $project->project_code ?? 'N/A',
            $project->priority ?? 'N/A',
            $project->format ? $project->format->name : 'N/A',
            $this->getStatusDisplayName($project->status),
            $project->progress_percentage . '%',
            $project->soliciting_direction_general ?? 'N/A',
            $project->soliciting_line_management ?? 'N/A',
            $project->destination_direction_general ?? 'N/A',
            $project->destination_line_management ?? 'N/A',
            $project->regulation_organizational ? 'Sí' : 'No',
            $project->regulation_operational ? 'Sí' : 'No',
            $project->regulation_audit_internal ? 'Sí' : 'No',
            $project->regulation_audit_external ? 'Sí' : 'No',
            $project->regulation_service ? 'Sí' : 'No',
            $project->regulation_technical ? 'Sí' : 'No',
            $project->regulation_mandatory ? 'Sí' : 'No',
            $project->mandatory_commitment_date ? $project->mandatory_commitment_date->format('d/m/Y') : 'N/A',
            $project->sublegal_circular_official ? 'Sí' : 'No',
            $project->sublegal_official_gazette ? 'Sí' : 'No',
            $project->financial_plan_operational_efficiency ? 'Sí' : 'No',
            $project->financial_plan_financial_stability ? 'Sí' : 'No',
            $project->financial_plan_customer_solution ? 'Sí' : 'No',
            $project->impact_business_high ? 'Sí' : 'No',
            $project->impact_operational_medium ? 'Sí' : 'No',
            $project->impact_technological_medium ? 'Sí' : 'No',
            $project->impact_financial_high ? 'Sí' : 'No',
            $project->impacted_system ?? 'N/A',
            $project->project_leader ?? 'N/A',
            $project->quality_environment ? 'Sí' : 'No',
            $project->justification ?? 'N/A',
            $project->prepared_by_name ?? 'N/A',
            $project->prepared_by_position ?? 'N/A',
            $project->prepared_by_extension ?? 'N/A',
            $project->authorized_by_name ?? 'N/A',
            $project->authorized_by_position ?? 'N/A',
            $project->received_by ?? 'N/A',
            $project->request_date ? $project->request_date->format('d/m/Y') : 'N/A',
            $project->created_at->format('d/m/Y H:i'),
            $project->updated_at->format('d/m/Y H:i')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilo para el encabezado
        $sheet->getStyle('A1:AP1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4F46E5'], // Indigo
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Estilo para las filas de datos
        $lastRow = $sheet->getHighestRow();
        if ($lastRow > 1) {
            $sheet->getStyle('A2:AP' . $lastRow)->applyFromArray([
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_LEFT,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'E5E7EB'],
                    ],
                ],
            ]);

            // Alternar colores de filas
            for ($row = 2; $row <= $lastRow; $row++) {
                if ($row % 2 == 0) {
                    $sheet->getStyle('A' . $row . ':AP' . $row)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->setStartColor(['rgb' => 'F9FAFB']);
                }
            }
        }

        // Autoajustar altura de filas
        $sheet->getDefaultRowDimension()->setRowHeight(20);

        return $sheet;
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,   // ID
            'B' => 15,  // Identificador
            'C' => 30,  // Nombre del Proyecto
            'D' => 15,  // Código de Proyecto
            'E' => 12,  // Prioridad
            'F' => 20,  // Formato
            'G' => 15,  // Estado
            'H' => 12,  // Progreso
            'I' => 25,  // Unidad Solicitante - Dirección General
            'J' => 25,  // Unidad Solicitante - Gerencia de Línea
            'K' => 25,  // Unidad Destinataria - Dirección General
            'L' => 25,  // Unidad Destinataria - Gerencia de Línea
            'M' => 15,  // Tipo de Regulación - Organizativo
            'N' => 15,  // Tipo de Regulación - Operativo
            'O' => 15,  // Tipo de Regulación - Auditoría Interna
            'P' => 15,  // Tipo de Regulación - Auditoría Externa
            'Q' => 15,  // Tipo de Regulación - Servicio
            'R' => 15,  // Tipo de Regulación - Técnico
            'S' => 15,  // Tipo de Regulación - Mandatorio/Regulatorio
            'T' => 20,  // Fecha de Compromiso Mandatorio
            'U' => 15,  // Rango Sub-Legal - Circular Oficial
            'V' => 15,  // Rango Sub-Legal - Gaceta Oficial
            'W' => 15,  // Plan Financiero - Eficiencia Operativa
            'X' => 15,  // Plan Financiero - Estabilidad Financiera
            'Y' => 15,  // Plan Financiero - Solución al Cliente
            'Z' => 15,  // Impacto - Negocio (Alto)
            'AA' => 15, // Impacto - Operativo (Medio)
            'AB' => 15, // Impacto - Tecnológico (Medio)
            'AC' => 15, // Impacto - Financiero (Alto)
            'AD' => 30, // Sistema que Impacta
            'AE' => 20, // Líder del Proyecto
            'AF' => 15, // Ambiente de Calidad
            'AG' => 40, // Justificación
            'AH' => 20, // Elaborado por - Nombre
            'AI' => 20, // Elaborado por - Cargo
            'AJ' => 15, // Elaborado por - Extensión
            'AK' => 20, // Autorizado por - Nombre
            'AL' => 20, // Autorizado por - Cargo
            'AM' => 20, // Recibido por
            'AN' => 18, // Fecha de Solicitud
            'AO' => 18, // Fecha de Creación
            'AP' => 18, // Última Actualización
        ];
    }

    private function getStatusDisplayName($status)
    {
        switch($status) {
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
