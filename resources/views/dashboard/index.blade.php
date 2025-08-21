@extends('layouts.app')

@section('title', 'Dashboard - Sistema de Gestión de Proyectos')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>
            <p class="mt-1 text-sm text-gray-500">Resumen del Sistema de Gestión de Proyectos</p>
        </div>
    </div>

    <!-- Project Status Cards -->
    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">
        <!-- Total Projects -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Total Proyectos</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $statusCounts['total'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-gray-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Recientes</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $statusCounts['reciente'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Activation -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Pendiente Activar</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $statusCounts['pendiente_activar'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Returned Documents -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-red-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Doc. Devuelto</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $statusCounts['documento_devuelto'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Development -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-600 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Desarrollo</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $statusCounts['desarrollo'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <!-- Production -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-5">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">Producción</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ $statusCounts['produccion'] }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Project Status Distribution Chart -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Distribución por Estados</h3>
                <div class="mt-4">
                    <canvas id="statusChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>

        <!-- Projects by Resource Chart -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">Proyectos por Recurso</h3>
                <div class="mt-4">
                    <canvas id="resourceChart" width="400" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Development Progress and Upcoming Dates -->
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <!-- Development Progress -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Progreso de Proyectos en Desarrollo</h3>
                
                <!-- Progress Summary -->
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="text-center">
                        <div class="text-2xl font-bold text-blue-600">{{ number_format($developmentProgress['average_progress'], 1) }}%</div>
                        <div class="text-sm text-gray-500">Progreso Promedio</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-green-600">{{ $developmentProgress['completed_count'] }}</div>
                        <div class="text-sm text-gray-500">Completados</div>
                    </div>
                    <div class="text-center">
                        <div class="text-2xl font-bold text-yellow-600">{{ $developmentProgress['high_progress_count'] }}</div>
                        <div class="text-sm text-gray-500">Avanzados (80%+)</div>
                    </div>
                </div>

                <!-- Progress Chart -->
                <canvas id="developmentChart" width="400" height="250"></canvas>
            </div>
        </div>

        <!-- Upcoming Transition Dates -->
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Fechas Próximas de Transición</h3>
                
                <!-- Development Certifications -->
                @if($upcomingDates['development_certifications']->count() > 0)
                <div class="mb-6">
                    <h4 class="text-md font-medium text-blue-600 mb-2">🔍 Certificaciones de Desarrollo (Esta Semana)</h4>
                    <div class="space-y-2">
                        @foreach($upcomingDates['development_certifications'] as $project)
                        <div class="flex justify-between items-center bg-blue-50 p-2 rounded">
                            <span class="text-sm font-medium">{{ $project->name }}</span>
                            <span class="text-xs text-blue-600">{{ $project->development_certification_date ? $project->development_certification_date->format('d/m/Y') : '' }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Tentative Productions -->
                @if($upcomingDates['tentative_productions']->count() > 0)
                <div class="mb-6">
                    <h4 class="text-md font-medium text-green-600 mb-2">🚀 Paso a Producción (Esta Semana)</h4>
                    <div class="space-y-2">
                        @foreach($upcomingDates['tentative_productions'] as $project)
                        <div class="flex justify-between items-center bg-green-50 p-2 rounded">
                            <span class="text-sm font-medium">{{ $project->name }}</span>
                            <span class="text-xs text-green-600">{{ $project->tentative_production_date ? $project->tentative_production_date->format('d/m/Y') : '' }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Quality Projects -->
                @if($upcomingDates['quality_projects']->count() > 0)
                <div class="mb-4">
                    <h4 class="text-md font-medium text-yellow-600 mb-2">⚡ Proyectos que Pasan a Calidad</h4>
                    <div class="space-y-2">
                        @foreach($upcomingDates['quality_projects'] as $project)
                        <div class="flex justify-between items-center bg-yellow-50 p-2 rounded">
                            <span class="text-sm font-medium">{{ $project->name }}</span>
                            <span class="text-xs text-yellow-600">{{ $project->progress_percentage }}% completado</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if($upcomingDates['development_certifications']->count() == 0 && 
                    $upcomingDates['tentative_productions']->count() == 0 && 
                    $upcomingDates['quality_projects']->count() == 0)
                <div class="text-center text-gray-500 py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="mt-2 text-sm">No hay fechas próximas de transición</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Recent Status Changes -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Cambios de Estado Recientes</h3>
            <div class="flow-root">
                <ul class="-mb-8">
                    @forelse($recentChanges as $change)
                    <li>
                        <div class="relative pb-8">
                            @if(!$loop->last)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full 
                                        @if($change->to_status === 'produccion') bg-green-500
                                        @elseif($change->to_status === 'desarrollo') bg-blue-500
                                        @elseif($change->to_status === 'documento_devuelto') bg-red-500
                                        @elseif($change->to_status === 'pendiente_activar') bg-yellow-500
                                        @else bg-gray-500
                                        @endif
                                        flex items-center justify-center ring-8 ring-white">
                                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                        </svg>
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-900">
                                            <span class="font-medium">{{ $change->project->name }}</span>
                                            cambió de <span class="font-medium">{{ $change->from_status_display }}</span> 
                                            a <span class="font-medium">{{ $change->to_status_display }}</span>
                                        </p>
                                        <p class="text-xs text-gray-500">por {{ $change->changedBy->name }}</p>
                                        @if($change->notes)
                                        <p class="text-xs text-gray-400 mt-1">{{ Str::limit($change->notes, 60) }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                        <time>{{ $change->created_at->diffForHumans() }}</time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @empty
                    <li class="text-sm text-gray-500 text-center py-4">No hay cambios de estado recientes</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Project Status Distribution Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
const statusData = @json($statusCounts);

new Chart(statusCtx, {
    type: 'doughnut',
    data: {
        labels: ['Recientes', 'Pendiente Activar', 'Doc. Devuelto', 'Desarrollo', 'Producción'],
        datasets: [{
            data: [
                statusData.reciente,
                statusData.pendiente_activar,
                statusData.documento_devuelto,
                statusData.desarrollo,
                statusData.produccion
            ],
            backgroundColor: [
                '#6B7280', // gray
                '#F59E0B', // yellow
                '#EF4444', // red
                '#3B82F6', // blue
                '#10B981'  // green
            ],
            borderColor: [
                '#6B7280',
                '#F59E0B',
                '#EF4444',
                '#3B82F6',
                '#10B981'
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            }
        }
    }
});

// Projects by Resource Chart
const resourceCtx = document.getElementById('resourceChart').getContext('2d');
const resourceData = @json($projectsByResource);

new Chart(resourceCtx, {
    type: 'bar',
    data: {
        labels: resourceData.map(item => item.name),
        datasets: [{
            label: 'Proyectos Asignados',
            data: resourceData.map(item => item.project_count),
            backgroundColor: resourceData.map(item => {
                if (item.type === 'lider') return 'rgba(59, 130, 246, 0.8)';
                if (item.type === 'proveedor') return 'rgba(245, 158, 11, 0.8)';
                return 'rgba(16, 185, 129, 0.8)';
            }),
            borderColor: resourceData.map(item => {
                if (item.type === 'lider') return 'rgba(59, 130, 246, 1)';
                if (item.type === 'proveedor') return 'rgba(245, 158, 11, 1)';
                return 'rgba(16, 185, 129, 1)';
            }),
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 1
                }
            }
        }
    }
});

// Development Progress Chart
const devCtx = document.getElementById('developmentChart').getContext('2d');
const devData = @json($developmentProgress['projects']);

new Chart(devCtx, {
    type: 'bar',
    data: {
        labels: devData.map(project => project.name.length > 15 ? project.name.substring(0, 15) + '...' : project.name),
        datasets: [{
            label: 'Progreso (%)',
            data: devData.map(project => project.progress_percentage),
            backgroundColor: devData.map(project => {
                if (project.progress_percentage >= 90) return 'rgba(16, 185, 129, 0.8)';
                if (project.progress_percentage >= 70) return 'rgba(59, 130, 246, 0.8)';
                if (project.progress_percentage >= 50) return 'rgba(245, 158, 11, 0.8)';
                return 'rgba(239, 68, 68, 0.8)';
            }),
            borderColor: devData.map(project => {
                if (project.progress_percentage >= 90) return 'rgba(16, 185, 129, 1)';
                if (project.progress_percentage >= 70) return 'rgba(59, 130, 246, 1)';
                if (project.progress_percentage >= 50) return 'rgba(245, 158, 11, 1)';
                return 'rgba(239, 68, 68, 1)';
            }),
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                max: 100,
                ticks: {
                    callback: function(value) {
                        return value + '%';
                    }
                }
            }
        }
    }
});
</script>
@endsection