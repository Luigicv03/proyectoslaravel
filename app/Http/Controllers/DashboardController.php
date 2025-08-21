<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectResource;
use App\Models\ProjectStatusHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the main dashboard
     */
    public function index()
    {
        $user = Auth::user();
        
        // Get project counts by status
        $statusCounts = $this->getProjectStatusCounts();
        
        // Get upcoming dates for transitions
        $upcomingDates = $this->getUpcomingTransitionDates();
        
        // Get projects by assigned resources
        $projectsByResource = $this->getProjectsByResource();
        
        // Get development progress data
        $developmentProgress = $this->getDevelopmentProgress();
        
        // Get recent status changes
        $recentChanges = $this->getRecentStatusChanges();

        return view('dashboard.index', compact(
            'statusCounts',
            'upcomingDates',
            'projectsByResource',
            'developmentProgress',
            'recentChanges'
        ));
    }

    /**
     * Get project counts by status
     */
    private function getProjectStatusCounts()
    {
        return [
            'total' => Project::count(),
            'reciente' => Project::where('status', 'reciente')->count(),
            'pendiente_activar' => Project::where('status', 'pendiente_activar')->count(),
            'documento_devuelto' => Project::where('status', 'documento_devuelto')->count(),
            'desarrollo' => Project::where('status', 'desarrollo')->count(),
            'produccion' => Project::where('status', 'produccion')->count(),
        ];
    }

    /**
     * Get upcoming transition dates
     */
    private function getUpcomingTransitionDates()
    {
        $today = Carbon::today();
        $nextWeek = $today->copy()->addWeek();
        
        return [
            'development_certifications' => Project::where('status', 'desarrollo')
                ->whereNotNull('development_certification_date')
                ->whereBetween('development_certification_date', [$today, $nextWeek])
                ->with('resources')
                ->get(),
            'tentative_productions' => Project::where('status', 'desarrollo')
                ->whereNotNull('tentative_production_date')
                ->whereBetween('tentative_production_date', [$today, $nextWeek])
                ->with('resources')
                ->get(),
            'quality_projects' => Project::where('status', 'desarrollo')
                ->where('passes_to_quality', true)
                ->with('resources')
                ->get(),
        ];
    }

    /**
     * Get projects count by assigned resources
     */
    private function getProjectsByResource()
    {
        return ProjectResource::select('name', 'type', DB::raw('count(*) as project_count'))
            ->groupBy('name', 'type')
            ->having('project_count', '>', 0)
            ->orderBy('project_count', 'desc')
            ->limit(10)
            ->get();
    }

    /**
     * Get development progress data
     */
    private function getDevelopmentProgress()
    {
        $developmentProjects = Project::where('status', 'desarrollo')
            ->select('name', 'progress_percentage', 'development_certification_date', 'tentative_production_date')
            ->orderBy('progress_percentage', 'desc')
            ->get();

        return [
            'projects' => $developmentProjects,
            'average_progress' => $developmentProjects->avg('progress_percentage') ?? 0,
            'completed_count' => $developmentProjects->where('progress_percentage', 100)->count(),
            'high_progress_count' => $developmentProjects->where('progress_percentage', '>=', 80)->count(),
        ];
    }

    /**
     * Get recent status changes
     */
    private function getRecentStatusChanges()
    {
        return ProjectStatusHistory::with(['project', 'changedBy'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
    }
}
