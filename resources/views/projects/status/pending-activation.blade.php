@extends('layouts.app')

@section('title', 'Cambiar a Pendiente por Activar - ' . $project->name)

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
                    Nuevo estado: <span class="font-semibold text-yellow-600">Pendiente por Activar</span>
                </p>
            </div>

            <form action="{{ route('projects.status.update-pending-activation', $project) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="reception_date" class="block text-sm font-medium text-gray-700">
                        Fecha de Recepción del Documento
                    </label>
                    <input type="date" 
                           id="reception_date" 
                           name="reception_date" 
                           value="{{ old('reception_date') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('reception_date') border-red-500 @enderror"
                           required>
                    @error('reception_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="project_type" class="block text-sm font-medium text-gray-700">
                        Tipo de Proyecto
                    </label>
                    <input type="text" 
                           id="project_type" 
                           name="project_type" 
                           value="{{ old('project_type', $project->project_type) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('project_type') border-red-500 @enderror"
                           placeholder="Ej: Desarrollo Web, Sistema Interno, etc."
                           required>
                    @error('project_type')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="project_code" class="block text-sm font-medium text-gray-700">
                        Código del Proyecto
                    </label>
                    <input type="text" 
                           id="project_code" 
                           name="project_code" 
                           value="{{ old('project_code', $project->project_code) }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('project_code') border-red-500 @enderror"
                           placeholder="Ej: PRJ-2025-001"
                           required>
                    @error('project_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="assigned_to" class="block text-sm font-medium text-gray-700">
                        Persona Encargada (Por Asignar)
                    </label>
                    <input type="text" 
                           id="assigned_to" 
                           name="assigned_to" 
                           value="{{ old('assigned_to', $project->leader() ? $project->leader()->name : '') }}"
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('assigned_to') border-red-500 @enderror"
                           placeholder="Nombre del líder del proyecto"
                           required>
                    @error('assigned_to')
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
                              placeholder="Descripción del proyecto en este estado...">{{ old('observation', $project->observation) }}</textarea>
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
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-yellow-600 hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Cambiar a Pendiente por Activar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
