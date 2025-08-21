@extends('layouts.app')

@section('title', 'Importar Proyectos desde Excel')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Importar Proyectos desde Excel</h1>
                <p class="text-gray-600 mt-2">Crea múltiples proyectos importando un archivo Excel con el formato correcto.</p>
            </div>
            <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a Proyectos
            </a>
        </div>
    </div>

    <!-- Import Form -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-md p-4 mb-6">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Formato requerido del archivo Excel</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p class="mb-2">El archivo debe contener las siguientes columnas:</p>
                        <ul class="list-disc list-inside space-y-1">
                            <li><span class="font-medium">ID</span> o <span class="font-medium">Identificador</span> - Identificador único del proyecto</li>
                            <li><span class="font-medium">Nombre</span> - Nombre del proyecto</li>
                            <li><span class="font-medium">Descripción</span> - Descripción del proyecto (opcional)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <form action="{{ route('projects.import.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            
            <div>
                <label for="project_format_id" class="block text-sm font-medium text-gray-700 mb-2">
                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                    Formato de Proyecto
                </label>
                <select name="project_format_id" id="project_format_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                    <option value="">Selecciona un formato de proyecto</option>
                    @foreach($projectFormats as $format)
                        <option value="{{ $format->id }}" {{ old('project_format_id') == $format->id ? 'selected' : '' }}>
                            {{ $format->name }}
                        </option>
                    @endforeach
                </select>
                @error('project_format_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="excel_file" class="block text-sm font-medium text-gray-700 mb-2">
                    <svg class="inline-block w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Archivo Excel (.xlsx, .xls)
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-gray-400 transition-colors">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600">
                            <label for="excel_file" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Selecciona un archivo</span>
                                <input id="excel_file" name="excel_file" type="file" class="sr-only" accept=".xlsx,.xls" required>
                            </label>
                            <p class="pl-1">o arrastra y suelta</p>
                        </div>
                        <p class="text-xs text-gray-500">Máximo 10MB. Formatos: .xlsx, .xls</p>
                    </div>
                </div>
                @error('excel_file')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-between">
                <div></div>
                <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Importar Proyectos
                </button>
            </div>
        </form>
    </div>

    <!-- Example Table -->
    <div class="bg-white shadow-md rounded-lg p-6">
        <h3 class="text-lg font-medium text-gray-900 mb-4">
            <svg class="inline-block w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            Ejemplo de formato del archivo Excel
        </h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Identificador</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descripción</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">1</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">PROJ-001</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Sistema de Gestión de Usuarios</td>
                        <td class="px-6 py-4 text-sm text-gray-900">Sistema para administrar usuarios y permisos</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">2</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">PROJ-002</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Portal Web Corporativo</td>
                        <td class="px-6 py-4 text-sm text-gray-900">Portal web para la empresa</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">3</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">PROJ-003</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Aplicación Móvil</td>
                        <td class="px-6 py-4 text-sm text-gray-900">App móvil para clientes</td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <div class="mt-4 flex justify-center">
            <a href="{{ asset('ejemplo_proyectos_import.csv') }}" 
               class="inline-flex items-center px-4 py-2 border border-blue-300 rounded-md shadow-sm text-sm font-medium text-blue-700 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Descargar Ejemplo CSV
            </a>
        </div>
    </div>
</div>

<script>
// Drag and drop functionality
const dropZone = document.querySelector('.border-dashed');
const fileInput = document.getElementById('excel_file');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, highlight, false);
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, unhighlight, false);
});

function highlight(e) {
    dropZone.classList.add('border-indigo-400', 'border-solid');
}

function unhighlight(e) {
    dropZone.classList.remove('border-indigo-400', 'border-solid');
}

dropZone.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    const dt = e.dataTransfer;
    const files = dt.files;
    
    if (files.length > 0) {
        fileInput.files = files;
        updateFileName(files[0].name);
    }
}

fileInput.addEventListener('change', function(e) {
    if (e.target.files.length > 0) {
        updateFileName(e.target.files[0].name);
    }
});

function updateFileName(name) {
    const nameDisplay = dropZone.querySelector('span');
    if (nameDisplay) {
        nameDisplay.textContent = 'Archivo seleccionado: ' + name;
    }
}
</script>
@endsection
