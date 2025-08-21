@extends('layouts.app')

@section('title', 'Proyectos - Sistema de Gestión de Proyectos')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Proyectos</h1>
                    <p class="mt-1 text-sm text-gray-500">Gestiona todos tus proyectos</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('projects.import.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        Importar desde Excel
                    </a>
                    <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Proyecto
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Projects Grid -->
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
        @forelse($projects as $project)
        <div class="bg-white overflow-hidden shadow rounded-lg border-t-4 relative
            @if($project->status === 'reciente') border-gray-400
            @elseif($project->status === 'pendiente_activar') border-yellow-500
            @elseif($project->status === 'documento_devuelto') border-red-500
            @elseif($project->status === 'desarrollo') border-blue-500
            @elseif($project->status === 'produccion') border-green-500
            @else border-gray-400
            @endif">
            <!-- Estado Badge -->
            <div class="absolute top-2 right-2">
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                    @if($project->status === 'reciente') bg-gray-100 text-gray-800
                    @elseif($project->status === 'pendiente_activar') bg-yellow-100 text-yellow-800
                    @elseif($project->status === 'documento_devuelto') bg-red-100 text-red-800
                    @elseif($project->status === 'desarrollo') bg-blue-100 text-blue-800
                    @elseif($project->status === 'produccion') bg-green-100 text-green-800
                    @else bg-gray-100 text-gray-800
                    @endif">
                    {{ $project->status_display }}
                </span>
            </div>
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-4 flex-1">
                        <h3 class="text-lg font-medium text-gray-900">{{ $project->name }}</h3>
                        <p class="text-sm text-gray-500">{{ $project->format->name }}</p>
                    </div>
                </div>
                
                <div class="mt-4">
                    <div class="flex justify-between text-sm text-gray-500 mb-2">
                        <span>Importaciones: {{ $project->dataImports->count() }}</span>
                        <span>{{ $project->created_at->format('d/m/Y') }}</span>
                    </div>
                    <!-- Barra de progreso -->
                    <div class="flex items-center">
                        <div class="w-full bg-gray-200 rounded-full h-2 mr-2">
                            <div class="h-2 rounded-full 
                                @if($project->progress_percentage >= 80) bg-green-600
                                @elseif($project->progress_percentage >= 50) bg-yellow-600
                                @else bg-blue-600
                                @endif" 
                                style="width: {{ $project->progress_percentage }}%">
                            </div>
                        </div>
                        <span class="text-xs text-gray-500">{{ $project->progress_percentage }}%</span>
                    </div>
                </div>

                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('projects.show', $project) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Ver Detalles
                    </a>
                    <a href="{{ route('projects.export', $project) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Exportar
                    </a>
                </div>
                
                <div class="mt-3 flex space-x-2">
                    <a href="{{ route('projects.edit', $project) }}" class="flex-1 inline-flex justify-center items-center px-3 py-2 border border-blue-300 shadow-sm text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Editar
                    </a>
                    <form action="{{ route('projects.destroy', $project) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este proyecto? Esta acción no se puede deshacer.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full inline-flex justify-center items-center px-3 py-2 border border-red-300 shadow-sm text-sm leading-4 font-medium rounded-md text-red-700 bg-red-50 hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Eliminar
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full">
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay proyectos</h3>
                <p class="mt-1 text-sm text-gray-500">Comienza creando tu primer proyecto.</p>
                <div class="mt-6">
                    <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Crear Proyecto
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
