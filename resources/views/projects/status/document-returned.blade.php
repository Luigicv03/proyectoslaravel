@extends('layouts.app')

@section('title', 'Cambiar a Documento Devuelto - ' . $project->name)

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
                    Nuevo estado: <span class="font-semibold text-red-600">Documento Devuelto</span>
                </p>
            </div>

            <div class="bg-red-50 border border-red-200 rounded-md p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">
                            Atención
                        </h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>Este estado indica que el documento del proyecto ha sido devuelto para correcciones o modificaciones.</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('projects.status.update-document-returned', $project) }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="observation" class="block text-sm font-medium text-gray-700">
                        Observación *
                    </label>
                    <p class="text-sm text-gray-500 mb-2">Explique el motivo por el cual se devuelve el documento</p>
                    <textarea id="observation" 
                              name="observation" 
                              rows="6"
                              class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('observation') border-red-500 @enderror"
                              placeholder="Detalle las correcciones necesarias, información faltante, o motivos por los cuales se devuelve el documento..."
                              required>{{ old('observation') }}</textarea>
                    @error('observation')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="bg-gray-50 border border-gray-200 rounded-md p-4">
                    <h4 class="text-sm font-medium text-gray-900 mb-2">Información del Proyecto</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-500">Tipo:</span>
                            <span class="ml-2 font-medium">{{ $project->project_type ?? 'No definido' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Código:</span>
                            <span class="ml-2 font-medium">{{ $project->project_code ?? 'No asignado' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Fecha de Recepción:</span>
                            <span class="ml-2 font-medium">{{ $project->reception_date ? $project->reception_date->format('d/m/Y') : 'No definida' }}</span>
                        </div>
                        <div>
                            <span class="text-gray-500">Responsable:</span>
                            <span class="ml-2 font-medium">{{ $project->leader() ? $project->leader()->name : 'No asignado' }}</span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('projects.show', $project) }}" 
                       class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Marcar como Documento Devuelto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
