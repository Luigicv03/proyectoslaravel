<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectFormat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $formats = ProjectFormat::all();
        return view('projects.create', compact('formats'));
    }

    /**
     * Store new project
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_format_id' => 'required|exists:project_formats,id',
        ]);

        Project::create($request->only(['name', 'project_format_id']));

        return redirect()->route('projects.index')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    /**
     * Show project details
     */
    public function show(Project $project)
    {
        $project->load(['format', 'dataImports.snapshots']);
        return view('projects.show', compact('project'));
    }

    /**
     * Show edit project form
     */
    public function edit(Project $project)
    {
        $formats = ProjectFormat::all();
        return view('projects.edit', compact('project', 'formats'));
    }

    /**
     * Update project
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'project_format_id' => 'required|exists:project_formats,id',
        ]);

        $project->update($request->only(['name', 'project_format_id']));

        return redirect()->route('projects.index')
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
}
