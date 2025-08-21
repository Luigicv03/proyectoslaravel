<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectResource;
use App\Models\ProjectStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProjectStatusController extends Controller
{
    /**
     * Show form to change project to "pendiente_activar"
     */
    public function showPendingActivation(Project $project)
    {
        return view('projects.status.pending-activation', compact('project'));
    }

    /**
     * Update project to "pendiente_activar" status
     */
    public function updateToPendingActivation(Request $request, Project $project)
    {
        $request->validate([
            'reception_date' => 'required|date',
            'project_type' => 'required|string|max:255',
            'project_code' => 'required|string|max:255',
            'assigned_to' => 'required|string|max:255',
            'observation' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $project) {
            // Update project
            $project->update([
                'status' => 'pendiente_activar',
                'reception_date' => $request->reception_date,
                'project_type' => $request->project_type,
                'project_code' => $request->project_code,
                'observation' => $request->observation,
            ]);

            // Add or update assigned resource
            ProjectResource::updateOrCreate(
                ['project_id' => $project->id, 'type' => 'lider'],
                [
                    'name' => $request->assigned_to,
                    'type' => 'lider',
                    'status' => 'asignado',
                    'description' => 'Líder asignado para la activación del proyecto',
                ]
            );

            // Record status change
            ProjectStatusHistory::create([
                'project_id' => $project->id,
                'from_status' => 'reciente',
                'to_status' => 'pendiente_activar',
                'notes' => $request->observation,
                'changed_by' => Auth::id(),
            ]);
        });

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyecto actualizado a "Pendiente por Activar"');
    }

    /**
     * Show form to change project to "documento_devuelto"
     */
    public function showDocumentReturned(Project $project)
    {
        return view('projects.status.document-returned', compact('project'));
    }

    /**
     * Update project to "documento_devuelto" status
     */
    public function updateToDocumentReturned(Request $request, Project $project)
    {
        $request->validate([
            'observation' => 'required|string',
        ]);

        DB::transaction(function () use ($request, $project) {
            $oldStatus = $project->status;
            
            $project->update([
                'status' => 'documento_devuelto',
                'observation' => $request->observation,
            ]);

            // Record status change
            ProjectStatusHistory::create([
                'project_id' => $project->id,
                'from_status' => $oldStatus,
                'to_status' => 'documento_devuelto',
                'notes' => $request->observation,
                'changed_by' => Auth::id(),
            ]);
        });

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyecto marcado como "Documento Devuelto"');
    }

    /**
     * Show form to change project to "desarrollo"
     */
    public function showDevelopment(Project $project)
    {
        $existingResources = $project->resources;
        return view('projects.status.development', compact('project', 'existingResources'));
    }

    /**
     * Update project to "desarrollo" status
     */
    public function updateToDevelopment(Request $request, Project $project)
    {
        $request->validate([
            'resources' => 'required|array',
            'resources.*' => 'required|string|max:255',
            'resource_types' => 'required|array',
            'resource_types.*' => 'required|in:lider,integrante,proveedor',
            'progress_percentage' => 'required|integer|min:0|max:100',
            'development_certification_date' => 'required|date',
            'passes_to_quality' => 'required|boolean',
            'tentative_production_date' => 'required|date',
            'observation' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $project) {
            $oldStatus = $project->status;
            
            // Update project
            $project->update([
                'status' => 'desarrollo',
                'progress_percentage' => $request->progress_percentage,
                'development_certification_date' => $request->development_certification_date,
                'passes_to_quality' => $request->passes_to_quality,
                'tentative_production_date' => $request->tentative_production_date,
                'observation' => $request->observation,
            ]);

            // Clear existing resources and add new ones
            $project->resources()->delete();
            
            foreach ($request->resources as $index => $resourceName) {
                ProjectResource::create([
                    'project_id' => $project->id,
                    'name' => $resourceName,
                    'type' => $request->resource_types[$index],
                    'status' => 'activo',
                    'description' => 'Recurso asignado para desarrollo',
                ]);
            }

            // Record status change
            ProjectStatusHistory::create([
                'project_id' => $project->id,
                'from_status' => $oldStatus,
                'to_status' => 'desarrollo',
                'notes' => $request->observation,
                'changed_by' => Auth::id(),
            ]);
        });

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyecto movido a "Ambiente de Desarrollo"');
    }

    /**
     * Show form to change project to "produccion"
     */
    public function showProduction(Project $project)
    {
        $leader = $project->leader();
        return view('projects.status.production', compact('project', 'leader'));
    }

    /**
     * Update project to "produccion" status
     */
    public function updateToProduction(Request $request, Project $project)
    {
        $request->validate([
            'assigned_resource' => 'required|string|max:255',
            'production_release_date' => 'required|date',
            'observation' => 'nullable|string',
        ]);

        DB::transaction(function () use ($request, $project) {
            $oldStatus = $project->status;
            
            // Update project
            $project->update([
                'status' => 'produccion',
                'production_release_date' => $request->production_release_date,
                'observation' => $request->observation,
            ]);

            // Update the assigned resource for production
            ProjectResource::updateOrCreate(
                ['project_id' => $project->id, 'type' => 'lider'],
                [
                    'name' => $request->assigned_resource,
                    'type' => 'lider',
                    'status' => 'activo',
                    'description' => 'Responsable de producción',
                ]
            );

            // Record status change
            ProjectStatusHistory::create([
                'project_id' => $project->id,
                'from_status' => $oldStatus,
                'to_status' => 'produccion',
                'notes' => $request->observation,
                'changed_by' => Auth::id(),
            ]);
        });

        return redirect()->route('projects.show', $project)
            ->with('success', 'Proyecto movido a "Ambiente de Producción"');
    }
}