@extends('layouts.app')

@section('title', 'Departamentos - Sistema de Gestión de Proyectos')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestión de Departamentos</h1>
                <p class="text-gray-600 mt-2">Administre los departamentos de la organización</p>
            </div>
            <a href="{{ route('departments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Crear Departamento
            </a>
        </div>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    <!-- Departments List -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Lista de Departamentos</h2>
        </div>
        
        @if($departments->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departamento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gerente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Miembros</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($departments as $department)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $department->name }}</div>
                                    @if($department->description)
                                        <div class="text-sm text-gray-500">{{ Str::limit($department->description, 50) }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $department->code }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($department->manager_name)
                                    <div class="text-sm text-gray-900">{{ $department->manager_name }}</div>
                                    @if($department->manager_email)
                                        <div class="text-sm text-gray-500">{{ $department->manager_email }}</div>
                                    @endif
                                @else
                                    <span class="text-sm text-gray-500">No asignado</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $department->team_members_count }} miembros
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($department->is_active) bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $department->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('departments.show', $department) }}" class="text-indigo-600 hover:text-indigo-900">
                                        Ver
                                    </a>
                                    <a href="{{ route('departments.edit', $department) }}" class="text-yellow-600 hover:text-yellow-900">
                                        Editar
                                    </a>
                                    <form action="{{ route('departments.destroy', $department) }}" method="POST" class="inline" onsubmit="return confirm('¿Está seguro de que desea eliminar este departamento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            Eliminar
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay departamentos</h3>
                <p class="mt-1 text-sm text-gray-500">Comience creando su primer departamento.</p>
                <div class="mt-6">
                    <a href="{{ route('departments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear Departamento
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Quick Actions -->
    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Acciones Rápidas</h3>
            <div class="space-y-3">
                <a href="{{ route('team-members.create') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Agregar Miembro del Equipo
                </a>
                <a href="{{ route('team-members.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    Ver Todos los Miembros
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Estadísticas</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Departamentos:</span>
                    <span class="font-medium">{{ $departments->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Departamentos Activos:</span>
                    <span class="font-medium">{{ $departments->where('is_active', true)->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Miembros:</span>
                    <span class="font-medium">{{ $departments->sum('team_members_count') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
