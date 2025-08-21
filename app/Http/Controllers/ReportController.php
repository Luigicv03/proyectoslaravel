<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectsByStatusExport;

class ReportController extends Controller
{
    /**
     * Show reports index page
     */
    public function index()
    {
        $stats = [
            'total' => Project::count(),
            'reciente' => Project::where('status', 'reciente')->count(),
            'pendiente_activar' => Project::where('status', 'pendiente_activar')->count(),
            'documento_devuelto' => Project::where('status', 'documento_devuelto')->count(),
            'desarrollo' => Project::where('status', 'desarrollo')->count(),
            'produccion' => Project::where('status', 'produccion')->count(),
        ];

        return view('reports.index', compact('stats'));
    }

    /**
     * Generate and download report by status
     */
    public function exportByStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:reciente,pendiente_activar,documento_devuelto,desarrollo,produccion',
        ]);

        $status = $request->input('status');
        $statusDisplay = $this->getStatusDisplayName($status);
        
        $filename = "proyectos_{$statusDisplay}_" . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new ProjectsByStatusExport($status), $filename);
    }

    /**
     * Show projects by status (for preview)
     */
    public function showByStatus($status)
    {
        $validStatuses = ['reciente', 'pendiente_activar', 'documento_devuelto', 'desarrollo', 'produccion'];
        
        if (!in_array($status, $validStatuses)) {
            abort(404);
        }

        $projects = Project::with(['format'])
            ->where('status', $status)
            ->orderBy('created_at', 'desc')
            ->get();

        $statusDisplay = $this->getStatusDisplayName($status);

        return view('reports.show-by-status', compact('projects', 'status', 'statusDisplay'));
    }

    /**
     * Get status display name
     */
    private function getStatusDisplayName($status)
    {
        switch($status) {
            case 'reciente':
                return 'Proyectos_Recientes';
            case 'pendiente_activar':
                return 'Pendientes_por_Activar';
            case 'documento_devuelto':
                return 'Documento_Devuelto';
            case 'desarrollo':
                return 'En_Desarrollo';
            case 'produccion':
                return 'En_Produccion';
            default:
                return 'Desconocido';
        }
    }
}
