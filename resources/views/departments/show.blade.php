@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <!-- Header -->
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">{{ $department->name }}</h2>
                        <p class="text-gray-600">Código: {{ $department->code }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('departments.edit', $department) }}" 
                           class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Editar
                        </a>
                        <a href="{{ route('departments.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Volver
                        </a>
                    </div>
                </div>

                <!-- Status Badge -->
                <div class="mb-6">
                    @if($department->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            Activo
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            Inactivo
                        </span>
                    @endif
                </div>

                <!-- Department Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Basic Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Información Básica</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nombre</dt>
                                <dd class="text-sm text-gray-900">{{ $department->name }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Código</dt>
                                <dd class="text-sm text-gray-900">{{ $department->code }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Descripción</dt>
                                <dd class="text-sm text-gray-900">{{ $department->description ?: 'Sin descripción' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <!-- Manager Information -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Información del Gerente</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Nombre del Gerente</dt>
                                <dd class="text-sm text-gray-900">{{ $department->manager_name ?: 'No asignado' }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email del Gerente</dt>
                                <dd class="text-sm text-gray-900">
                                    @if($department->manager_email)
                                        <a href="mailto:{{ $department->manager_email }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $department->manager_email }}
                                        </a>
                                    @else
                                        No asignado
                                    @endif
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Teléfono del Gerente</dt>
                                <dd class="text-sm text-gray-900">
                                    @if($department->manager_phone)
                                        <a href="tel:{{ $department->manager_phone }}" class="text-blue-600 hover:text-blue-800">
                                            {{ $department->manager_phone }}
                                        </a>
                                    @else
                                        No asignado
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Team Members -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Miembros del Equipo</h3>
                        <a href="{{ route('team-members.create', ['department_id' => $department->id]) }}" 
                           class="inline-flex items-center px-3 py-1.5 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Agregar Miembro
                        </a>
                    </div>

                    @if($department->teamMembers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Posición</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rol</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Seniority</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($department->teamMembers as $member)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 h-10 w-10">
                                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                                            <span class="text-sm font-medium text-gray-700">
                                                                {{ strtoupper(substr($member->first_name, 0, 1) . substr($member->last_name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4">
                                                        <div class="text-sm font-medium text-gray-900">{{ $member->full_name }}</div>
                                                        <div class="text-sm text-gray-500">{{ $member->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->position }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->role_display }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $member->seniority_display }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($member->is_active)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        Activo
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        Inactivo
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <a href="{{ route('team-members.show', $member) }}" class="text-blue-600 hover:text-blue-900 mr-3">Ver</a>
                                                <a href="{{ route('team-members.edit', $member) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No hay miembros</h3>
                            <p class="mt-1 text-sm text-gray-500">Este departamento aún no tiene miembros asignados.</p>
                        </div>
                    @endif
                </div>

                <!-- Timestamps -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Creado el</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $department->created_at->format('d/m/Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Última actualización</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $department->updated_at->format('d/m/Y H:i') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
