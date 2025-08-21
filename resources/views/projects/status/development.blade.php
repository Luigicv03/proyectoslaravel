@extends('layouts.app')

@section('title', 'Cambiar a Ambiente de Desarrollo - ' . $project->name)

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
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
                    Nuevo estado: <span class="font-semibold text-blue-600">Ambiente de Desarrollo</span>
                </p>
            </div>

            <form action="{{ route('projects.status.update-development', $project) }}" method="POST" class="space-y-6">
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

                <!-- Recursos Asignados -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Recursos Asignados
                    </label>
                    <div id="resources-container" class="space-y-3">
                        @if($existingResources->count() > 0)
                            @foreach($existingResources as $index => $resource)
                                <div class="flex gap-3 items-end resource-row">
                                    <div class="flex-1">
                                        <input type="text" 
                                               name="resources[]" 
                                               value="{{ $resource->name }}"
                                               class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                               placeholder="Nombre del recurso"
                                               required>
                                    </div>
                                    <div class="w-40">
                                        <select name="resource_types[]" 
                                                class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                                required>
                                            <option value="lider" {{ $resource->type === 'lider' ? 'selected' : '' }}>Líder</option>
                                            <option value="integrante" {{ $resource->type === 'integrante' ? 'selected' : '' }}>Integrante</option>
                                            <option value="proveedor" {{ $resource->type === 'proveedor' ? 'selected' : '' }}>Proveedor</option>
                                        </select>
                                    </div>
                                    <button type="button" 
                                            class="px-3 py-2 text-red-600 hover:text-red-800 remove-resource"
                                            onclick="removeResource(this)">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex gap-3 items-end resource-row">
                                <div class="flex-1">
                                    <input type="text" 
                                           name="resources[]" 
                                           value="{{ $project->leader() ? $project->leader()->name : '' }}"
                                           class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                           placeholder="Nombre del recurso"
                                           required>
                                </div>
                                <div class="w-40">
                                    <select name="resource_types[]" 
                                            class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                                            required>
                                        <option value="lider" selected>Líder</option>
                                        <option value="integrante">Integrante</option>
                                        <option value="proveedor">Proveedor</option>
                                    </select>
                                </div>
                                <button type="button" 
                                        class="px-3 py-2 text-red-600 hover:text-red-800 remove-resource"
                                        onclick="removeResource(this)">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>
                    <button type="button" 
                            id="add-resource" 
                            class="mt-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        + Agregar Recurso
                    </button>
                    @error('resources')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="progress_percentage" class="block text-sm font-medium text-gray-700">
                            Porcentaje de Progreso del Proyecto
                        </label>
                        <div class="mt-1 relative">
                            <input type="number" 
                                   id="progress_percentage" 
                                   name="progress_percentage" 
                                   min="0" 
                                   max="100"
                                   value="{{ old('progress_percentage', $project->progress_percentage) }}"
                                   class="block w-full px-3 py-2 pr-8 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('progress_percentage') border-red-500 @enderror"
                                   required>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-gray-500 text-sm">%</span>
                            </div>
                        </div>
                        @error('progress_percentage')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="development_certification_date" class="block text-sm font-medium text-gray-700">
                            Fecha de Certificación de Desarrollo
                        </label>
                        <input type="date" 
                               id="development_certification_date" 
                               name="development_certification_date" 
                               value="{{ old('development_certification_date', $project->development_certification_date ? $project->development_certification_date->format('Y-m-d') : '') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('development_certification_date') border-red-500 @enderror"
                               required>
                        @error('development_certification_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            ¿Pasa a Calidad?
                        </label>
                        <div class="space-y-2">
                            <div class="flex items-center">
                                <input id="passes_to_quality_yes" 
                                       name="passes_to_quality" 
                                       type="radio" 
                                       value="1"
                                       {{ old('passes_to_quality', $project->passes_to_quality) ? 'checked' : '' }}
                                       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="passes_to_quality_yes" class="ml-3 block text-sm font-medium text-gray-700">
                                    Sí
                                </label>
                            </div>
                            <div class="flex items-center">
                                <input id="passes_to_quality_no" 
                                       name="passes_to_quality" 
                                       type="radio" 
                                       value="0"
                                       {{ !old('passes_to_quality', $project->passes_to_quality) ? 'checked' : '' }}
                                       class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="passes_to_quality_no" class="ml-3 block text-sm font-medium text-gray-700">
                                    No
                                </label>
                            </div>
                        </div>
                        @error('passes_to_quality')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tentative_production_date" class="block text-sm font-medium text-gray-700">
                            Fecha Tentativa de Paso a Producción
                        </label>
                        <input type="date" 
                               id="tentative_production_date" 
                               name="tentative_production_date" 
                               value="{{ old('tentative_production_date', $project->tentative_production_date ? $project->tentative_production_date->format('Y-m-d') : '') }}"
                               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('tentative_production_date') border-red-500 @enderror"
                               required>
                        @error('tentative_production_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="observation" class="block text-sm font-medium text-gray-700">
                        Observación
                    </label>
                    <textarea id="observation" 
                              name="observation" 
                              rows="4"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('observation') border-red-500 @enderror"
                              placeholder="Breve descripción del proyecto en desarrollo...">{{ old('observation', $project->observation) }}</textarea>
                    @error('observation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('projects.show', $project) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Mover a Ambiente de Desarrollo
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const addResourceBtn = document.getElementById('add-resource');
    const resourcesContainer = document.getElementById('resources-container');

    addResourceBtn.addEventListener('click', function() {
        const newResourceRow = document.createElement('div');
        newResourceRow.className = 'flex gap-3 items-end resource-row';
        newResourceRow.innerHTML = `
            <div class="flex-1">
                <input type="text" 
                       name="resources[]" 
                       class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Nombre del recurso"
                       required>
            </div>
            <div class="w-40">
                <select name="resource_types[]" 
                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <option value="lider">Líder</option>
                    <option value="integrante" selected>Integrante</option>
                    <option value="proveedor">Proveedor</option>
                </select>
            </div>
            <button type="button" 
                    class="px-3 py-2 text-red-600 hover:text-red-800 remove-resource"
                    onclick="removeResource(this)">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        `;
        resourcesContainer.appendChild(newResourceRow);
    });
});

function removeResource(button) {
    const resourceRow = button.closest('.resource-row');
    const container = document.getElementById('resources-container');
    if (container.children.length > 1) {
        resourceRow.remove();
    } else {
        alert('Debe mantener al menos un recurso asignado.');
    }
}
</script>
@endsection
