@extends('layouts.app')

@section('title', 'Agregar Miembro del Equipo - Sistema de Gestión de Proyectos')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Agregar Nuevo Miembro del Equipo</h1>
                <p class="text-gray-600 mt-2">Complete la información del miembro del equipo</p>
            </div>
            <a href="{{ route('team-members.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a Miembros
            </a>
        </div>
    </div>

    <form action="{{ route('team-members.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <!-- Basic Information -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Información Personal
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">Nombre *</label>
                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('first_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Apellido *</label>
                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('last_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="employee_id" class="block text-sm font-medium text-gray-700 mb-2">ID de Empleado *</label>
                    <input type="text" name="employee_id" id="employee_id" value="{{ old('employee_id') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ej: EMP001">
                    @error('employee_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="hire_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Contratación</label>
                    <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('hire_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Department and Position -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Departamento y Cargo
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="department_id" class="block text-sm font-medium text-gray-700 mb-2">Departamento *</label>
                    <select name="department_id" id="department_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Seleccione un departamento</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}" {{ old('department_id') == $department->id ? 'selected' : '' }}>
                                {{ $department->name }} ({{ $department->code }})
                            </option>
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Cargo *</label>
                    <input type="text" name="position" id="position" value="{{ old('position') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Ej: Desarrollador Senior">
                    @error('position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Role and Seniority -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Rol y Experiencia
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Rol *</label>
                    <select name="role" id="role" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Seleccione un rol</option>
                        <option value="developer" {{ old('role') == 'developer' ? 'selected' : '' }}>Desarrollador</option>
                        <option value="analyst" {{ old('role') == 'analyst' ? 'selected' : '' }}>Analista</option>
                        <option value="manager" {{ old('role') == 'manager' ? 'selected' : '' }}>Gerente</option>
                        <option value="tester" {{ old('role') == 'tester' ? 'selected' : '' }}>Tester</option>
                        <option value="designer" {{ old('role') == 'designer' ? 'selected' : '' }}>Diseñador</option>
                        <option value="architect" {{ old('role') == 'architect' ? 'selected' : '' }}>Arquitecto</option>
                        <option value="devops" {{ old('role') == 'devops' ? 'selected' : '' }}>DevOps</option>
                        <option value="other" {{ old('role') == 'other' ? 'selected' : '' }}>Otro</option>
                    </select>
                    @error('role')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="seniority" class="block text-sm font-medium text-gray-700 mb-2">Nivel de Experiencia *</label>
                    <select name="seniority" id="seniority" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Seleccione el nivel</option>
                        <option value="junior" {{ old('seniority') == 'junior' ? 'selected' : '' }}>Junior</option>
                        <option value="mid" {{ old('seniority') == 'mid' ? 'selected' : '' }}>Mid-Level</option>
                        <option value="senior" {{ old('seniority') == 'senior' ? 'selected' : '' }}>Senior</option>
                        <option value="lead" {{ old('seniority') == 'lead' ? 'selected' : '' }}>Lead</option>
                    </select>
                    @error('seniority')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Skills and Bio -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Habilidades y Biografía
            </h2>
            
            <div class="space-y-6">
                <div>
                    <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Habilidades</label>
                    <textarea name="skills" id="skills" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Ej: PHP, Laravel, JavaScript, MySQL, Git (separadas por comas)">{{ old('skills') }}</textarea>
                    @error('skills')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Biografía</label>
                    <textarea name="bio" id="bio" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
                              placeholder="Breve descripción del miembro del equipo">{{ old('bio') }}</textarea>
                    @error('bio')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-end space-x-4">
                <a href="{{ route('team-members.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Agregar Miembro
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
