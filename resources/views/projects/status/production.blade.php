@extends('layouts.app')

@section('title', 'Cambiar a Ambiente de Producción - ' . $project->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Cambiar Estado del Proyecto</h1>
                <p class="text-gray-600 mt-2">
                    Proyecto: <span class="font-semibold">{{ $project->name }}</span>
                </p>
                <p class="text-gray-600">
                    Estado actual: <span class="font-semibold">{{ $project->status_display }}</span>
                </p>
                <p class="text-gray-600">
                    Nuevo estado: <span class="font-semibold text-green-600">Ambiente de Producción</span>
                </p>
            </div>

            <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-green-800">
                            ¡Enhorabuena!
                        </h3>
                        <div class="mt-2 text-sm text-green-700">
                            <p>El proyecto está listo para pasar a producción. Este es el estado final del flujo de desarrollo.</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('projects.status.update-production', $project) }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nombre del Proyecto
                        </label>
                        <input type="text" 
                               value="{{ $project->name }}" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50"
                               readonly>
                        <p class="text-xs text-gray-500 mt-1">Se toma automáticamente del proyecto</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Tipo y Código
                        </label>
                        <input type="text" 
                               value="{{ $project->project_type }} - {{ $project->project_code }}" 
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50"
                               readonly>
                        <p class="text-xs text-gray-500 mt-1">Se toma automáticamente del estado anterior</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Estado Anterior
                    </label>
                    <input type="text" 
                           value="{{ $project->status_display }}" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50"
                           readonly>
                    <p class="text-xs text-gray-500 mt-1">Última etiqueta del proyecto</p>
                </div>

                <div>
                    <label for="assigned_resource" class="block text-sm font-medium text-gray-700">
                        Recurso Asignado (Responsable de Producción)
                    </label>
                    <input type="text" 
                           id="assigned_resource" 
                           name="assigned_resource" 
                           value="{{ old('assigned_resource', $leader ? $leader->name : '') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('assigned_resource') border-red-500 @enderror"
                           placeholder="Nombre del responsable de producción"
                           required>
                    <p class="text-xs text-gray-500 mt-1">Seleccionar el responsable que se eligió como encargado</p>
                    @error('assigned_resource')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="production_release_date" class="block text-sm font-medium text-gray-700">
                        Fecha de Salida a Producción
                    </label>
                    <input type="date" 
                           id="production_release_date" 
                           name="production_release_date" 
                           value="{{ old('production_release_date') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('production_release_date') border-red-500 @enderror"
                           required>
                    @error('production_release_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="observation" class="block text-sm font-medium text-gray-700">
                        Observación
                    </label>
                    <textarea id="observation" 
                              name="observation" 
                              rows="4"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('observation') border-red-500 @enderror"
                              placeholder="Notas finales sobre el paso a producción...">{{ old('observation') }}</textarea>
                    @error('observation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Resumen del proyecto -->
                <div class="bg-gray-50 border border-gray-200 rounded-md p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-3">Resumen del Proyecto</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Progreso:</span>
                            <span class="ml-2 font-medium">{{ $project->progress_percentage }}%</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Certificación de Desarrollo:</span>
                            <span class="ml-2 font-medium">{{ $project->development_certification_date ? $project->development_certification_date->format('d/m/Y') : 'No definida' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Pasa a Calidad:</span>
                            <span class="ml-2 font-medium">{{ $project->passes_to_quality ? 'Sí' : 'No' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Fecha Tentativa:</span>
                            <span class="ml-2 font-medium">{{ $project->tentative_production_date ? $project->tentative_production_date->format('d/m/Y') : 'No definida' }}</span>
                        </div>
                    </div>
                    @if($project->observation)
                        <div class="mt-3">
                            <span class="text-gray-500">Observación anterior:</span>
                            <p class="mt-1 text-gray-700 text-sm">{{ $project->observation }}</p>
                        </div>
                    @endif
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('projects.show', $project) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Mover a Producción
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
