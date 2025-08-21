@extends('layouts.app')

@section('title', 'Crear Nuevo Proyecto')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Crear Nuevo Proyecto</h1>
                <p class="text-gray-600 mt-2">Complete todos los campos requeridos para crear un nuevo proyecto</p>
            </div>
            <a href="{{ route('projects.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver a Proyectos
            </a>
        </div>
    </div>

    <form action="{{ route('projects.store') }}" method="POST" class="space-y-8">
        @csrf
        
        <!-- INFORMACIÓN BÁSICA -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Información Básica
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Proyecto *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="project_format_id" class="block text-sm font-medium text-gray-700 mb-2">Formato de Proyecto *</label>
                    <select name="project_format_id" id="project_format_id" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Selecciona un formato</option>
                        @foreach($formats as $format)
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
                    <label for="project_code" class="block text-sm font-medium text-gray-700 mb-2">Código de Proyecto</label>
                    <input type="text" name="project_code" id="project_code" value="{{ old('project_code') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('project_code')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-2">Prioridad *</label>
                    <select name="priority" id="priority" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Selecciona la prioridad</option>
                        <option value="baja" {{ old('priority') == 'baja' ? 'selected' : '' }}>Baja</option>
                        <option value="media" {{ old('priority') == 'media' ? 'selected' : '' }}>Media</option>
                        <option value="alta" {{ old('priority') == 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>
                    @error('priority')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="request_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Solicitud</label>
                    <input type="date" name="request_date" id="request_date" value="{{ old('request_date') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('request_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- UNIDAD SOLICITANTE -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                UNIDAD SOLICITANTE
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="soliciting_direction_general" class="block text-sm font-medium text-gray-700 mb-2">Dirección General / Gerencia General</label>
                    <input type="text" name="soliciting_direction_general" id="soliciting_direction_general" value="{{ old('soliciting_direction_general') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('soliciting_direction_general')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="soliciting_line_management" class="block text-sm font-medium text-gray-700 mb-2">Gerencia de Línea / Coordinación</label>
                    <input type="text" name="soliciting_line_management" id="soliciting_line_management" value="{{ old('soliciting_line_management') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('soliciting_line_management')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- UNIDAD DESTINATARIA -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                UNIDAD DESTINATARIA
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="destination_direction_general" class="block text-sm font-medium text-gray-700 mb-2">Dirección General / Gerencia General</label>
                    <input type="text" name="destination_direction_general" id="destination_direction_general" value="{{ old('destination_direction_general') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('destination_direction_general')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="destination_line_management" class="block text-sm font-medium text-gray-700 mb-2">Gerencia de Línea / Coordinación</label>
                    <input type="text" name="destination_line_management" id="destination_line_management" value="{{ old('destination_line_management') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('destination_line_management')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- TIPO DE REGULACIÓN -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                </svg>
                TIPO DE REGULACIÓN
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <label class="flex items-center">
                    <input type="checkbox" name="regulation_organizational" value="1" {{ old('regulation_organizational') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Organizativo</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="regulation_operational" value="1" {{ old('regulation_operational') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Operativo</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="regulation_audit_internal" value="1" {{ old('regulation_audit_internal') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Auditoría (Interna)</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="regulation_audit_external" value="1" {{ old('regulation_audit_external') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Auditoría (Externa)</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="regulation_service" value="1" {{ old('regulation_service') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Servicio</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="regulation_technical" value="1" {{ old('regulation_technical') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Técnico</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="regulation_mandatory" value="1" {{ old('regulation_mandatory') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Mandatorio/Regulatorio</span>
                </label>
            </div>

            <!-- Fecha de compromiso (solo si se marca mandatorio) -->
            <div id="mandatory_date_section" class="mt-4" style="display: none;">
                <label for="mandatory_commitment_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Compromiso</label>
                <input type="date" name="mandatory_commitment_date" id="mandatory_commitment_date" value="{{ old('mandatory_commitment_date') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('mandatory_commitment_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rango Sub-Legal -->
            <div class="mt-6">
                <h3 class="text-md font-medium text-gray-900 mb-4">Rango Sub-Legal</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="sublegal_circular_official" value="1" {{ old('sublegal_circular_official') ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Nro. Circular Oficial</span>
                    </label>

                    <label class="flex items-center">
                        <input type="checkbox" name="sublegal_official_gazette" value="1" {{ old('sublegal_official_gazette') ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Gaceta Oficial</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- VINCULACIÓN CON EL PLAN FINANCIERO -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
                VINCULACIÓN CON EL PLAN FINANCIERO DEL BANCO
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <label class="flex items-center">
                    <input type="checkbox" name="financial_plan_operational_efficiency" value="1" {{ old('financial_plan_operational_efficiency') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Eficiencia Operativa</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="financial_plan_financial_stability" value="1" {{ old('financial_plan_financial_stability') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Estabilidad Financiera</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="financial_plan_customer_solution" value="1" {{ old('financial_plan_customer_solution') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Solución al Cliente</span>
                </label>
            </div>
        </div>

        <!-- IMPACTO A NIVEL DE ATENCIÓN -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                IMPACTO A NIVEL DE ATENCIÓN
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <label class="flex items-center">
                    <input type="checkbox" name="impact_business_high" value="1" {{ old('impact_business_high') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Negocio (Alto Impacto)</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="impact_operational_medium" value="1" {{ old('impact_operational_medium') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Operativo (Medio Impacto)</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="impact_technological_medium" value="1" {{ old('impact_technological_medium') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Tecnológico (Medio Impacto)</span>
                </label>

                <label class="flex items-center">
                    <input type="checkbox" name="impact_financial_high" value="1" {{ old('impact_financial_high') ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <span class="ml-2 text-sm text-gray-700">Financiero (Alto Impacto)</span>
                </label>
            </div>
        </div>

        <!-- INFORMACIÓN ADICIONAL -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Información Adicional
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="impacted_system" class="block text-sm font-medium text-gray-700 mb-2">Sistema que Impacta</label>
                    <textarea name="impacted_system" id="impacted_system" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('impacted_system') }}</textarea>
                    @error('impacted_system')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="project_leader" class="block text-sm font-medium text-gray-700 mb-2">Líder de Proyecto</label>
                    <select name="project_leader" id="project_leader" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Seleccione un líder del equipo</option>
                        @foreach($teamMembers as $member)
                            <option value="{{ $member->full_name }}" {{ old('project_leader') == $member->full_name ? 'selected' : '' }}>
                                {{ $member->full_name }} - {{ $member->position }} ({{ $member->department->name }})
                            </option>
                        @endforeach
                    </select>
                    @error('project_leader')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="justification" class="block text-sm font-medium text-gray-700 mb-2">Justificación</label>
                    <textarea name="justification" id="justification" rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('justification') }}</textarea>
                    @error('justification')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Ambiente de Calidad</label>
                    <label class="flex items-center">
                        <input type="checkbox" name="quality_environment" value="1" {{ old('quality_environment') ? 'checked' : '' }}
                               class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                        <span class="ml-2 text-sm text-gray-700">Sí</span>
                    </label>
                    @error('quality_environment')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- ELABORADO POR -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                ELABORADO POR
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="prepared_by_name" class="block text-sm font-medium text-gray-700 mb-2">Nombre y Apellido</label>
                    <input type="text" name="prepared_by_name" id="prepared_by_name" value="{{ old('prepared_by_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('prepared_by_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prepared_by_position" class="block text-sm font-medium text-gray-700 mb-2">Cargo</label>
                    <input type="text" name="prepared_by_position" id="prepared_by_position" value="{{ old('prepared_by_position') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('prepared_by_position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prepared_by_extension" class="block text-sm font-medium text-gray-700 mb-2">Extensión</label>
                    <input type="text" name="prepared_by_extension" id="prepared_by_extension" value="{{ old('prepared_by_extension') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('prepared_by_extension')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prepared_by_signature" class="block text-sm font-medium text-gray-700 mb-2">Firma</label>
                    <input type="text" name="prepared_by_signature" id="prepared_by_signature" value="{{ old('prepared_by_signature') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('prepared_by_signature')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- AUTORIZADO POR -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                AUTORIZADO POR
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="authorized_by_name" class="block text-sm font-medium text-gray-700 mb-2">Nombre y Apellido</label>
                    <input type="text" name="authorized_by_name" id="authorized_by_name" value="{{ old('authorized_by_name') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('authorized_by_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="authorized_by_position" class="block text-sm font-medium text-gray-700 mb-2">Cargo</label>
                    <input type="text" name="authorized_by_position" id="authorized_by_position" value="{{ old('authorized_by_position') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('authorized_by_position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="authorized_by_signature" class="block text-sm font-medium text-gray-700 mb-2">Firma</label>
                    <input type="text" name="authorized_by_signature" id="authorized_by_signature" value="{{ old('authorized_by_signature') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('authorized_by_signature')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="authorized_by_seal" class="block text-sm font-medium text-gray-700 mb-2">Firma y Sello</label>
                    <input type="text" name="authorized_by_seal" id="authorized_by_seal" value="{{ old('authorized_by_seal') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('authorized_by_seal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- RECIBIDO -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                Recibido
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="received_by" class="block text-sm font-medium text-gray-700 mb-2">Recibido por</label>
                    <input type="text" name="received_by" id="received_by" value="{{ old('received_by') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('received_by')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="received_signature_seal" class="block text-sm font-medium text-gray-700 mb-2">Firma y Sello</label>
                    <input type="text" name="received_signature_seal" id="received_signature_seal" value="{{ old('received_signature_seal') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('received_signature_seal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-4">
            <a href="{{ route('projects.index') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-md shadow-sm text-base font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Cancelar
            </a>
            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Crear Proyecto
            </button>
        </div>
    </form>
</div>

<script>
// Mostrar/ocultar fecha de compromiso cuando se marca mandatorio
document.addEventListener('DOMContentLoaded', function() {
    const mandatoryCheckbox = document.querySelector('input[name="regulation_mandatory"]');
    const mandatoryDateSection = document.getElementById('mandatory_date_section');
    
    function toggleMandatoryDate() {
        if (mandatoryCheckbox.checked) {
            mandatoryDateSection.style.display = 'block';
        } else {
            mandatoryDateSection.style.display = 'none';
        }
    }
    
    mandatoryCheckbox.addEventListener('change', toggleMandatoryDate);
    toggleMandatoryDate(); // Ejecutar al cargar la página
});
</script>
@endsection
