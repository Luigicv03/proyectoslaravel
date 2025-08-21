<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProjectExampleExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            [1, 'PRJ-2025-001', 'Sistema de Ventas Online', 'Desarrollo de plataforma e-commerce para ventas en línea con gestión de inventario y procesamiento de pagos'],
            [2, 'PRJ-2025-002', 'App Móvil Corporativa', 'Aplicación móvil para gestión interna de empleados y recursos empresariales con notificaciones push'],
            [3, 'PRJ-2025-003', 'Portal Web Institucional', 'Rediseño completo del sitio web corporativo con sistema de gestión de contenidos (CMS)'],
            [4, 'PRJ-2025-004', 'Sistema de Reportes', 'Dashboard ejecutivo con reportes automáticos y análisis de datos en tiempo real'],
            [5, 'PRJ-2025-005', 'Plataforma de Capacitación', 'Sistema de e-learning para capacitación de empleados con seguimiento de progreso'],
            [6, 'PRJ-2025-006', 'Sistema de Inventario', 'Aplicación para gestión de inventario con códigos QR y control de stock automático'],
            [7, 'PRJ-2025-007', 'API de Integración', 'Desarrollo de API REST para integración con sistemas externos y terceros'],
            [8, 'PRJ-2025-008', 'Sistema de Facturación', 'Plataforma para generación automática de facturas y control contable'],
            [9, 'PRJ-2025-009', 'Chat Bot Inteligente', 'Bot conversacional con IA para atención al cliente 24/7'],
            [10, 'PRJ-2025-010', 'Sistema de Backup', 'Solución automatizada de respaldo y recuperación de datos empresariales'],
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Identificador', 
            'Nombre',
            'Descripcion'
        ];
    }
}
