<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFormat;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProjectImportController extends Controller
{
    /**
     * Show import form
     */
    public function create()
    {
        $projectFormats = ProjectFormat::all();
        return view('projects.import.create', compact('projectFormats'));
    }

    /**
     * Handle file import
     */
    public function store(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls|max:10240', // 10MB max
            'project_format_id' => 'required|exists:project_formats,id',
        ]);

        try {
            $file = $request->file('excel_file');
            $projectFormatId = $request->input('project_format_id');
            
            // Import Excel data
            $data = Excel::toArray(new class implements ToArray, WithHeadingRow {
                public function array(array $array)
                {
                    return $array;
                }
            }, $file);

            // Process the data and create projects
            $createdProjects = $this->processExcelData($data[0], $projectFormatId);

            return redirect()->route('projects.index')
                ->with('success', "Se importaron exitosamente {$createdProjects} proyectos desde el archivo Excel.");

        } catch (\Exception $e) {
            return back()->withErrors(['excel_file' => 'Error al procesar el archivo: ' . $e->getMessage()]);
        }
    }

    /**
     * Process Excel data and create projects
     */
    private function processExcelData($data, $projectFormatId)
    {
        $createdCount = 0;

        foreach ($data as $row) {
            // Skip empty rows - check if at least one required field is present
            if (empty($row['id'] ?? null) && empty($row['identificador'] ?? null) && empty($row['nombre'] ?? null)) {
                continue;
            }

            // Check if project already exists by identifier
            $identifier = $row['identificador'] ?? $row['id'] ?? null;
            if ($identifier && Project::where('project_identifier', $identifier)->exists()) {
                continue; // Skip if project already exists
            }

            // Create new project
            Project::create([
                'name' => $row['nombre'] ?? $row['name'] ?? 'Proyecto sin nombre',
                'description' => $row['descripcion'] ?? $row['description'] ?? '',
                'project_identifier' => $identifier ?? 'ID-' . time() . '-' . $createdCount,
                'project_format_id' => $projectFormatId,
                'status' => 'reciente',
                'progress_percentage' => 0,
            ]);

            $createdCount++;
        }

        return $createdCount;
    }
}
