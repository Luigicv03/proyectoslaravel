<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFormat;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectExport;

class ProjectController extends Controller
{
    /**
     * Show list of projects
     */
    public function index()
    {
        $projects = Project::with('format')->orderBy('created_at', 'desc')->get();
        return view('projects.index', compact('projects'));
    }

    /**
     * Show create project form
     */
    public function create()
    {
        $formats = ProjectFormat::orderBy('name')->get();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('first_name')->get();
        return view('projects.create', compact('formats', 'teamMembers'));
    }

    /**
     * Store new project
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_format_id' => 'required|exists:project_formats,id',
            'soliciting_direction_general' => 'nullable|string|max:255',
            'soliciting_line_management' => 'nullable|string|max:255',
            'destination_direction_general' => 'nullable|string|max:255',
            'destination_line_management' => 'nullable|string|max:255',
            'project_code' => 'nullable|string|max:255',
            'priority' => 'required|in:baja,media,alta',
            'regulation_organizational' => 'boolean',
            'regulation_operational' => 'boolean',
            'regulation_audit_internal' => 'boolean',
            'regulation_audit_external' => 'boolean',
            'regulation_service' => 'boolean',
            'regulation_technical' => 'boolean',
            'regulation_mandatory' => 'boolean',
            'mandatory_commitment_date' => 'nullable|date',
            'sublegal_circular_official' => 'boolean',
            'sublegal_official_gazette' => 'boolean',
            'financial_plan_operational_efficiency' => 'boolean',
            'financial_plan_financial_stability' => 'boolean',
            'financial_plan_customer_solution' => 'boolean',
            'impact_business_high' => 'boolean',
            'impact_operational_medium' => 'boolean',
            'impact_technological_medium' => 'boolean',
            'impact_financial_high' => 'boolean',
            'impacted_system' => 'nullable|string',
            'project_leader' => 'nullable|string|max:255',
            'quality_environment' => 'boolean',
            'justification' => 'nullable|string',
            'prepared_by_name' => 'nullable|string|max:255',
            'prepared_by_position' => 'nullable|string|max:255',
            'prepared_by_extension' => 'nullable|string|max:255',
            'prepared_by_signature' => 'nullable|string|max:255',
            'authorized_by_name' => 'nullable|string|max:255',
            'authorized_by_position' => 'nullable|string|max:255',
            'authorized_by_signature' => 'nullable|string|max:255',
            'authorized_by_seal' => 'nullable|string|max:255',
            'received_by' => 'nullable|string|max:255',
            'received_signature_seal' => 'nullable|string|max:255',
            'request_date' => 'nullable|date',
        ]);

        // Preparar datos para crear el proyecto
        $projectData = $request->all();
        
        // Establecer valores por defecto para campos booleanos
        $booleanFields = [
            'regulation_organizational', 'regulation_operational', 'regulation_audit_internal',
            'regulation_audit_external', 'regulation_service', 'regulation_technical',
            'regulation_mandatory', 'sublegal_circular_official', 'sublegal_official_gazette',
            'financial_plan_operational_efficiency', 'financial_plan_financial_stability',
            'financial_plan_customer_solution', 'impact_business_high', 'impact_operational_medium',
            'impact_technological_medium', 'impact_financial_high', 'quality_environment'
        ];

        foreach ($booleanFields as $field) {
            $projectData[$field] = $request->has($field);
        }

        // Establecer estado inicial
        $projectData['status'] = 'reciente';
        $projectData['progress_percentage'] = 0;

        Project::create($projectData);

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Show project details
     */
    public function show(Project $project)
    {
        $project->load([
            'format', 
            'dataImports.snapshots', 
            'resources', 
            'statusHistory.changedBy'
        ]);
        return view('projects.show', compact('project'));
    }

    /**
     * Show edit project form
     */
    public function edit(Project $project)
    {
        $formats = ProjectFormat::orderBy('name')->get();
        $teamMembers = TeamMember::where('is_active', true)->orderBy('first_name')->get();
        return view('projects.edit', compact('project', 'formats', 'teamMembers'));
    }

    /**
     * Update project
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_format_id' => 'required|exists:project_formats,id',
            'soliciting_direction_general' => 'nullable|string|max:255',
            'soliciting_line_management' => 'nullable|string|max:255',
            'destination_direction_general' => 'nullable|string|max:255',
            'destination_line_management' => 'nullable|string|max:255',
            'project_code' => 'nullable|string|max:255',
            'priority' => 'required|in:baja,media,alta',
            'regulation_organizational' => 'boolean',
            'regulation_operational' => 'boolean',
            'regulation_audit_internal' => 'boolean',
            'regulation_audit_external' => 'boolean',
            'regulation_service' => 'boolean',
            'regulation_technical' => 'boolean',
            'regulation_mandatory' => 'boolean',
            'mandatory_commitment_date' => 'nullable|date',
            'sublegal_circular_official' => 'boolean',
            'sublegal_official_gazette' => 'boolean',
            'financial_plan_operational_efficiency' => 'boolean',
            'financial_plan_financial_stability' => 'boolean',
            'financial_plan_customer_solution' => 'boolean',
            'impact_business_high' => 'boolean',
            'impact_operational_medium' => 'boolean',
            'impact_technological_medium' => 'boolean',
            'impact_financial_high' => 'boolean',
            'impacted_system' => 'nullable|string',
            'project_leader' => 'nullable|string|max:255',
            'quality_environment' => 'boolean',
            'justification' => 'nullable|string',
            'prepared_by_name' => 'nullable|string|max:255',
            'prepared_by_position' => 'nullable|string|max:255',
            'prepared_by_extension' => 'nullable|string|max:255',
            'prepared_by_signature' => 'nullable|string|max:255',
            'authorized_by_name' => 'nullable|string|max:255',
            'authorized_by_position' => 'nullable|string|max:255',
            'authorized_by_signature' => 'nullable|string|max:255',
            'authorized_by_seal' => 'nullable|string|max:255',
            'received_by' => 'nullable|string|max:255',
            'received_signature_seal' => 'nullable|string|max:255',
            'request_date' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        // Preparar datos para actualizar el proyecto
        $projectData = $request->all();
        
        // Establecer valores por defecto para campos booleanos
        $booleanFields = [
            'regulation_organizational', 'regulation_operational', 'regulation_audit_internal',
            'regulation_audit_external', 'regulation_service', 'regulation_technical',
            'regulation_mandatory', 'sublegal_circular_official', 'sublegal_official_gazette',
            'financial_plan_operational_efficiency', 'financial_plan_financial_stability',
            'financial_plan_customer_solution', 'impact_business_high', 'impact_operational_medium',
            'impact_technological_medium', 'impact_financial_high', 'quality_environment'
        ];

        foreach ($booleanFields as $field) {
            $projectData[$field] = $request->has($field);
        }

        $project->update($projectData);

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    /**
     * Delete project
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Proyecto eliminado exitosamente.');
    }

    /**
     * Export project to Excel
     */
    public function export(Project $project)
    {
        // Cargar todas las relaciones necesarias
        $project->load([
            'format', 
            'dataImports.snapshots', 
            'resources', 
            'statusHistory.changedBy'
        ]);

        // Crear el nombre del archivo
        $fileName = 'proyecto_' . str_replace([' ', '/', '\\'], '_', $project->name) . '_' . date('Y-m-d_H-i-s') . '.xlsx';

        return Excel::download(new ProjectExport($project), $fileName);
    }
}
