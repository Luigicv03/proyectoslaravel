@extends('layouts.app')

@section('title', 'Miembros del Equipo - Sistema de Gestión de Proyectos')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestión de Miembros del Equipo</h1>
                <p class="text-gray-600 mt-2">Administre los miembros del equipo de la organización</p>
            </div>
            <a href="{{ route('team-members.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Agregar Miembro
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

    <!-- Team Members List -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-medium text-gray-900">Lista de Miembros del Equipo</h2>
        </div>
        
        @if($teamMembers->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Miembro</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departamento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seniority</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($teamMembers as $member)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-indigo-100 flex items-center justify-center">
                                            <span class="text-sm font-medium text-indigo-800">
                                                {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $member->full_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                        <div class="text-xs text-gray-400">ID: {{ $member->employee_id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $member->department->name }}</div>
                                <div class="text-sm text-gray-500">{{ $member->department->code }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $member->position }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($member->role === 'developer') bg-blue-100 text-blue-800
                                    @elseif($member->role === 'analyst') bg-green-100 text-green-800
                                    @elseif($member->role === 'manager') bg-purple-100 text-purple-800
                                    @elseif($member->role === 'tester') bg-yellow-100 text-yellow-800
                                    @elseif($member->role === 'designer') bg-pink-100 text-pink-800
                                    @elseif($member->role === 'architect') bg-indigo-100 text-indigo-800
                                    @elseif($member->role === 'devops') bg-gray-100 text-gray-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ $member->role_display }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($member->seniority === 'junior') bg-green-100 text-green-800
                                    @elseif($member->seniority === 'mid') bg-blue-100 text-blue-800
                                    @elseif($member->seniority === 'senior') bg-yellow-100 text-yellow-800
                                    @elseif($member->seniority === 'lead') bg-red-100 text-red-800
                                    @endif">
                                    {{ $member->seniority_display }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($member->is_active) bg-green-100 text-green-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ $member->is_active ? 'Activo' : 'Inactivo' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="{{ route('team-members.show', $member) }}" class="text-indigo-600 hover:text-indigo-900">
                                        Ver
                                    </a>
                                    <a href="{{ route('team-members.edit', $member) }}" class="text-yellow-600 hover:text-yellow-900">
                                        Editar
                                    </a>
                                    <form action="{{ route('team-members.destroy', $member) }}" method="POST" class="inline" onsubmit="return confirm('¿Está seguro de que desea eliminar este miembro del equipo?')">
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay miembros del equipo</h3>
                <p class="mt-1 text-sm text-gray-500">Comience agregando su primer miembro del equipo.</p>
                <div class="mt-6">
                    <a href="{{ route('team-members.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Agregar Miembro
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
                <a href="{{ route('departments.create') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Crear Departamento
                </a>
                <a href="{{ route('departments.index') }}" class="flex items-center text-indigo-600 hover:text-indigo-900">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                    Ver Departamentos
                </a>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Estadísticas</h3>
            <div class="space-y-3">
                <div class="flex justify-between">
                    <span class="text-gray-600">Total Miembros:</span>
                    <span class="font-medium">{{ $teamMembers->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Miembros Activos:</span>
                    <span class="font-medium">{{ $teamMembers->where('is_active', true)->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Desarrolladores:</span>
                    <span class="font-medium">{{ $teamMembers->where('role', 'developer')->count() }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Senior/Lead:</span>
                    <span class="font-medium">{{ $teamMembers->whereIn('seniority', ['senior', 'lead'])->count() }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
