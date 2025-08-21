@extends('layouts.app')

@section('title', $project->name . ' - Sistema de Gestión de Proyectos')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $project->name }}</h1>
                    <p class="mt-1 text-sm text-gray-500">Formato: {{ $project->format->name }}</p>
                    <p class="text-sm text-gray-500">Creado: {{ $project->created_at->format('d/m/Y H:i') }}</p>
                    <div class="mt-2">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($project->status === 'reciente') bg-gray-100 text-gray-800
                            @elseif($project->status === 'pendiente_activar') bg-yellow-100 text-yellow-800
                            @elseif($project->status === 'documento_devuelto') bg-red-100 text-red-800
                            @elseif($project->status === 'desarrollo') bg-blue-100 text-blue-800
                            @elseif($project->status === 'produccion') bg-green-100 text-green-800
                            @endif">
                            {{ $project->status_display }}
                        </span>
                    </div>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('data-import.create', $project) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Importar Avance
                    </a>
                    <a href="{{ route('projects.edit', $project) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Editar
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Project Status Management -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Gestión de Estados del Proyecto</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Pendiente por Activar -->
                @if($project->status === 'reciente' || $project->status === 'documento_devuelto')
                <a href="{{ route('projects.status.pending-activation', $project) }}" 
                   class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                    📝 Pendiente por Activar
                </a>
                @endif

                <!-- Documento Devuelto -->
                @if($project->status !== 'reciente' && $project->status !== 'produccion')
                <a href="{{ route('projects.status.document-returned', $project) }}" 
                   class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    ↩️ Documento Devuelto
                </a>
                @endif

                <!-- Ambiente de Desarrollo -->
                @if($project->status === 'pendiente_activar')
                <a href="{{ route('projects.status.development', $project) }}" 
                   class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    💻 Ambiente de Desarrollo
                </a>
                @endif

                <!-- Ambiente de Producción -->
                @if($project->status === 'desarrollo')
                <a href="{{ route('projects.status.production', $project) }}" 
                   class="inline-flex items-center justify-center px-4 py-3 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    🚀 Ambiente de Producción
                </a>
                @endif
            </div>

            <!-- Project Details based on status -->
            @if($project->status !== 'reciente')
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h4 class="text-md font-medium text-gray-900 mb-3">Información del Proyecto</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 text-sm">
                    @if($project->project_type)
                    <div>
                        <span class="text-gray-500">Tipo:</span>
                        <span class="ml-2 font-medium">{{ $project->project_type }}</span>
                    </div>
                    @endif
                    
                    @if($project->project_code)
                    <div>
                        <span class="text-gray-500">Código:</span>
                        <span class="ml-2 font-medium">{{ $project->project_code }}</span>
                    </div>
                    @endif
                    
                    @if($project->reception_date)
                    <div>
                        <span class="text-gray-500">Fecha de Recepción:</span>
                        <span class="ml-2 font-medium">{{ $project->reception_date->format('d/m/Y') }}</span>
                    </div>
                    @endif
                    
                    @if($project->progress_percentage > 0)
                    <div>
                        <span class="text-gray-500">Progreso:</span>
                        <span class="ml-2 font-medium">{{ $project->progress_percentage }}%</span>
                    </div>
                    @endif
                    
                    @if($project->development_certification_date)
                    <div>
                        <span class="text-gray-500">Certificación de Desarrollo:</span>
                        <span class="ml-2 font-medium">{{ $project->development_certification_date->format('d/m/Y') }}</span>
                    </div>
                    @endif
                    
                    @if($project->tentative_production_date)
                    <div>
                        <span class="text-gray-500">Fecha Tentativa de Producción:</span>
                        <span class="ml-2 font-medium">{{ $project->tentative_production_date->format('d/m/Y') }}</span>
                    </div>
                    @endif
                    
                    @if($project->production_release_date)
                    <div>
                        <span class="text-gray-500">Fecha de Salida a Producción:</span>
                        <span class="ml-2 font-medium">{{ $project->production_release_date->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>
                
                @if($project->observation)
                <div class="mt-4">
                    <span class="text-gray-500">Observación:</span>
                    <p class="mt-1 text-gray-700">{{ $project->observation }}</p>
                </div>
                @endif
            </div>
            @endif

            <!-- Resources assigned to project -->
            @if($project->resources->count() > 0)
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h4 class="text-md font-medium text-gray-900 mb-3">Recursos Asignados</h4>
                <div class="space-y-2">
                    @foreach($project->resources as $resource)
                    <div class="flex items-center justify-between bg-gray-50 px-3 py-2 rounded">
                        <div>
                            <span class="font-medium">{{ $resource->name }}</span>
                            <span class="ml-2 text-sm text-gray-500">({{ $resource->type_display }})</span>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                            @if($resource->status === 'asignado') bg-yellow-100 text-yellow-800
                            @elseif($resource->status === 'activo') bg-green-100 text-green-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($resource->status) }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Status History -->
            @if($project->statusHistory->count() > 0)
            <div class="mt-6 border-t border-gray-200 pt-6">
                <h4 class="text-md font-medium text-gray-900 mb-3">Historial de Estados</h4>
                <div class="space-y-3">
                    @foreach($project->statusHistory->sortByDesc('created_at') as $history)
                    <div class="bg-gray-50 px-3 py-2 rounded">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-sm">
                                    <span class="font-medium">{{ $history->from_status_display }}</span>
                                    →
                                    <span class="font-medium">{{ $history->to_status_display }}</span>
                                </span>
                                <span class="ml-2 text-xs text-gray-500">por {{ $history->changedBy->name }}</span>
                            </div>
                            <span class="text-xs text-gray-500">{{ $history->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        @if($history->notes)
                        <p class="text-sm text-gray-600 mt-1">{{ $history->notes }}</p>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Import History -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Historial de Importaciones</h3>
            
            @if($project->dataImports->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Archivo</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Importación</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tareas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($project->dataImports as $import)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $import->file_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $import->import_date->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $import->snapshots->count() }} tareas
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <button onclick="showImportDetails({{ $import->id }})" class="text-indigo-600 hover:text-indigo-900">
                                        Ver Detalles
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No hay importaciones</h3>
                    <p class="mt-1 text-sm text-gray-500">Comienza importando tu primer archivo de avance.</p>
                    <div class="mt-6">
                        <a href="{{ route('data-import.create', $project) }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Importar Archivo
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Latest Import Details -->
    @if($project->dataImports->count() > 0)
        @php $latestImport = $project->dataImports->sortByDesc('created_at')->first(); @endphp
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Última Importación - {{ $latestImport->file_name }}</h3>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarea</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ambiente</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Progreso</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Inicio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Fin Estimada</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($latestImport->snapshots as $snapshot)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $snapshot->task_name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($snapshot->environment === 'Desarrollo') bg-blue-100 text-blue-800
                                        @elseif($snapshot->environment === 'Calidad') bg-yellow-100 text-yellow-800
                                        @else bg-green-100 text-green-800
                                        @endif">
                                        {{ $snapshot->environment }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="h-2 rounded-full 
                                                @if($snapshot->progress_percentage >= 80) bg-green-600
                                                @elseif($snapshot->progress_percentage >= 50) bg-yellow-600
                                                @else bg-red-600
                                                @endif" 
                                                style="width: {{ $snapshot->progress_percentage }}%">
                                            </div>
                                        </div>
                                        <span class="text-sm text-gray-500">{{ $snapshot->progress_percentage }}%</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $snapshot->start_date ? $snapshot->start_date->format('d/m/Y') : 'N/A' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $snapshot->estimated_end_date ? $snapshot->estimated_end_date->format('d/m/Y') : 'N/A' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Import Details Modal -->
<div id="importModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-medium text-gray-900">Detalles de Importación</h3>
                <button onclick="closeImportModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            <div id="importDetails"></div>
        </div>
    </div>
</div>

<script>
function showImportDetails(importId) {
    // Aquí podrías hacer una llamada AJAX para obtener los detalles
    // Por ahora, solo mostramos el modal
    document.getElementById('importModal').classList.remove('hidden');
}

function closeImportModal() {
    document.getElementById('importModal').classList.add('hidden');
}

// Cerrar modal al hacer clic fuera de él
document.getElementById('importModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImportModal();
    }
});
</script>
@endsection
