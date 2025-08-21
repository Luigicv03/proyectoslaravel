<?php

namespace App\Http\Controllers;

use App\Models\DataImport;
use App\Models\Project;
use App\Models\ProjectSnapshot;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DataImportController extends Controller
{
    /**
     * Show import form
     */
    public function create(Project $project)
    {
        return view('data-import.create', compact('project'));
    }

    /**
     * Handle file import
     */
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls|max:10240', // 10MB max
        ]);

        try {
            $file = $request->file('excel_file');
            
            // Create data import record
            $dataImport = DataImport::create([
                'project_id' => $project->id,
                'file_name' => $file->getClientOriginalName(),
                'import_date' => now(),
            ]);

            // Import Excel data
            $data = Excel::toArray(new class implements ToArray, WithHeadingRow {
                public function array(array $array)
                {
                    return $array;
                }
            }, $file);

            // Process the data
            $this->processExcelData($data[0], $dataImport);

            return redirect()->route('projects.show', $project)
                ->with('success', 'Archivo importado exitosamente.');

        } catch (\Exception $e) {
            return back()->withErrors(['excel_file' => 'Error al procesar el archivo: ' . $e->getMessage()]);
        }
    }

    /**
     * Process Excel data and create snapshots
     */
    private function processExcelData($data, DataImport $dataImport)
    {
        foreach ($data as $row) {
            // Skip empty rows
            if (empty($row['task_identifier'] ?? null)) {
                continue;
            }

            ProjectSnapshot::create([
                'data_import_id' => $dataImport->id,
                'task_identifier' => $row['task_identifier'] ?? '',
                'task_name' => $row['task_name'] ?? '',
                'environment' => $row['environment'] ?? 'Desarrollo',
                'progress_percentage' => (int) ($row['progress_percentage'] ?? 0),
                'start_date' => $row['start_date'] ?? null,
                'estimated_end_date' => $row['estimated_end_date'] ?? null,
            ]);
        }
    }
}
