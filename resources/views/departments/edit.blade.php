@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Editar Departamento</h2>
                        <p class="text-gray-600">{{ $department->name }}</p>
                    </div>
                    <a href="{{ route('departments.show', $department) }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Cancelar
                    </a>
                </div>

                <form method="POST" action="{{ route('departments.update', $department) }}" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Basic Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Básica</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Departamento *</label>
                                <input type="text" name="name" id="name" 
                                       value="{{ old('name', $department->name) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('name') border-red-500 @enderror"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Code -->
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">Código del Departamento *</label>
                                <input type="text" name="code" id="code" 
                                       value="{{ old('code', $department->code) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('code') border-red-500 @enderror"
                                       required>
                                @error('code')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="mt-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción</label>
                            <textarea name="description" id="description" rows="3"
                                      class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('description') border-red-500 @enderror"
                                      placeholder="Descripción del departamento...">{{ old('description', $department->description) }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Manager Information -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Gerente</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Manager Name -->
                            <div>
                                <label for="manager_name" class="block text-sm font-medium text-gray-700">Nombre del Gerente</label>
                                <input type="text" name="manager_name" id="manager_name" 
                                       value="{{ old('manager_name', $department->manager_name) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('manager_name') border-red-500 @enderror"
                                       placeholder="Nombre completo del gerente">
                                @error('manager_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Manager Email -->
                            <div>
                                <label for="manager_email" class="block text-sm font-medium text-gray-700">Email del Gerente</label>
                                <input type="email" name="manager_email" id="manager_email" 
                                       value="{{ old('manager_email', $department->manager_email) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('manager_email') border-red-500 @enderror"
                                       placeholder="gerente@empresa.com">
                                @error('manager_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Manager Phone -->
                            <div>
                                <label for="manager_phone" class="block text-sm font-medium text-gray-700">Teléfono del Gerente</label>
                                <input type="tel" name="manager_phone" id="manager_phone" 
                                       value="{{ old('manager_phone', $department->manager_phone) }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm @error('manager_phone') border-red-500 @enderror"
                                       placeholder="+1 234 567 8900">
                                @error('manager_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Estado</h3>
                        
                        <div class="flex items-center">
                            <input type="checkbox" name="is_active" id="is_active" 
                                   value="1" 
                                   {{ old('is_active', $department->is_active) ? 'checked' : '' }}
                                   class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                            <label for="is_active" class="ml-2 block text-sm text-gray-900">
                                Departamento activo
                            </label>
                        </div>
                        <p class="mt-1 text-sm text-gray-500">
                            Los departamentos inactivos no aparecerán en las listas de selección para nuevos proyectos.
                        </p>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('departments.show', $department) }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Actualizar Departamento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
