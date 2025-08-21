@extends('layouts.app')

@section('title', 'Importar Avance - ' . $project->name)

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white overflow-hidden shadow rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Importar Avance Semanal</h1>
                <p class="mt-1 text-sm text-gray-500">Proyecto: {{ $project->name }}</p>
                <p class="text-sm text-gray-500">Formato: {{ $project->format->name }}</p>
            </div>

            <form action="{{ route('data-import.store', $project) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="space-y-6">
                    <div>
                        <label for="excel_file" class="block text-sm font-medium text-gray-700">Archivo Excel</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="excel_file" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                        <span>Subir archivo</span>
                                        <input id="excel_file" name="excel_file" type="file" class="sr-only" accept=".xlsx,.xls" required>
                                    </label>
                                    <p class="pl-1">o arrastrar y soltar</p>
                                </div>
                                <p class="text-xs text-gray-500">XLSX, XLS hasta 10MB</p>
                            </div>
                        </div>
                        @error('excel_file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Format Instructions -->
                    <div class="bg-blue-50 border border-blue-200 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Formato del archivo Excel</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <p>El archivo debe contener las siguientes columnas:</p>
                                    <ul class="list-disc list-inside mt-1 space-y-1">
                                        <li><strong>task_identifier:</strong> Identificador único de la tarea</li>
                                        <li><strong>task_name:</strong> Nombre de la tarea</li>
                                        <li><strong>environment:</strong> Ambiente (Desarrollo, Calidad, Producción)</li>
                                        <li><strong>progress_percentage:</strong> Porcentaje de progreso (0-100)</li>
                                        <li><strong>start_date:</strong> Fecha de inicio (YYYY-MM-DD)</li>
                                        <li><strong>estimated_end_date:</strong> Fecha de fin estimada (YYYY-MM-DD)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Example Table -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-700 mb-2">Ejemplo de estructura:</h4>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 border border-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">task_identifier</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">task_name</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">environment</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">progress_percentage</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">start_date</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">estimated_end_date</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <tr>
                                        <td class="px-3 py-2 text-sm text-gray-900">TASK-001</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">Desarrollo de login</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">Desarrollo</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">75</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">2024-01-01</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">2024-01-15</td>
                                    </tr>
                                    <tr>
                                        <td class="px-3 py-2 text-sm text-gray-900">TASK-002</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">Pruebas unitarias</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">Calidad</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">100</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">2024-01-10</td>
                                        <td class="px-3 py-2 text-sm text-gray-900">2024-01-12</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('projects.show', $project) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Procesar Archivo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Drag and drop functionality
const dropZone = document.querySelector('.border-dashed');
const fileInput = document.getElementById('excel_file');

dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('border-indigo-400', 'bg-indigo-50');
});

dropZone.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-indigo-400', 'bg-indigo-50');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('border-indigo-400', 'bg-indigo-50');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files;
        updateFileName(files[0].name);
    }
});

fileInput.addEventListener('change', (e) => {
    if (e.target.files.length > 0) {
        updateFileName(e.target.files[0].name);
    }
});

function updateFileName(fileName) {
    const dropZone = document.querySelector('.border-dashed');
    const textElement = dropZone.querySelector('p');
    if (textElement) {
        textElement.textContent = `Archivo seleccionado: ${fileName}`;
    }
}
</script>
@endsection
