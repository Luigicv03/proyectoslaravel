@extends('layouts.app')

@section('title', 'Editar Proyecto - ' . $project->name)

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Editar Proyecto</h1>
                <p class="text-gray-600 mt-2">Modifique los campos necesarios para actualizar el proyecto</p>
            </div>
            <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver al Proyecto
            </a>
        </div>
    </div>

    <form action="{{ route('projects.update', $project) }}" method="POST" class="space-y-8">
        @csrf
        @method('PUT')
        
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
                    <input type="text" name="name" id="name" value="{{ old('name', $project->name) }}" required
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
                            <option value="{{ $format->id }}" {{ old('project_format_id', $project->project_format_id) == $format->id ? 'selected' : '' }}>
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
                    <input type="text" name="project_code" id="project_code" value="{{ old('project_code', $project->project_code) }}"
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
                        <option value="baja" {{ old('priority', $project->priority) == 'baja' ? 'selected' : '' }}>Baja</option>
                        <option value="media" {{ old('priority', $project->priority) == 'media' ? 'selected' : '' }}>Media</option>
                        <option value="alta" {{ old('priority', $project->priority) == 'alta' ? 'selected' : '' }}>Alta</option>
                    </select>
                    @error('priority')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="request_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Solicitud</label>
                    <input type="date" name="request_date" id="request_date" value="{{ old('request_date', $project->request_date ? $project->request_date->format('Y-m-d') : '') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('request_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $project->description) }}</textarea>
                    @error('description')
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
                Unidad Solicitante
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="soliciting_direction_general" class="block text-sm font-medium text-gray-700 mb-2">Dirección General Solicitante</label>
                    <input type="text" name="soliciting_direction_general" id="soliciting_direction_general" value="{{ old('soliciting_direction_general', $project->soliciting_direction_general) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('soliciting_direction_general')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="soliciting_line_management" class="block text-sm font-medium text-gray-700 mb-2">Línea de Gestión Solicitante</label>
                    <input type="text" name="soliciting_line_management" id="soliciting_line_management" value="{{ old('soliciting_line_management', $project->soliciting_line_management) }}"
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
                Unidad Destinataria
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="destination_direction_general" class="block text-sm font-medium text-gray-700 mb-2">Dirección General Destinataria</label>
                    <input type="text" name="destination_direction_general" id="destination_direction_general" value="{{ old('destination_direction_general', $project->destination_direction_general) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('destination_direction_general')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="destination_line_management" class="block text-sm font-medium text-gray-700 mb-2">Línea de Gestión Destinataria</label>
                    <input type="text" name="destination_line_management" id="destination_line_management" value="{{ old('destination_line_management', $project->destination_line_management) }}"
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
                <svg class="w-5 h-5 mr-2 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Tipo de Regulación
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div class="flex items-center">
                    <input type="checkbox" name="regulation_organizational" id="regulation_organizational" value="1" {{ old('regulation_organizational', $project->regulation_organizational) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="regulation_organizational" class="ml-2 block text-sm text-gray-900">Regulación Organizacional</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="regulation_operational" id="regulation_operational" value="1" {{ old('regulation_operational', $project->regulation_operational) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="regulation_operational" class="ml-2 block text-sm text-gray-900">Regulación Operacional</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="regulation_audit_internal" id="regulation_audit_internal" value="1" {{ old('regulation_audit_internal', $project->regulation_audit_internal) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="regulation_audit_internal" class="ml-2 block text-sm text-gray-900">Auditoría Interna</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="regulation_audit_external" id="regulation_audit_external" value="1" {{ old('regulation_audit_external', $project->regulation_audit_external) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="regulation_audit_external" class="ml-2 block text-sm text-gray-900">Auditoría Externa</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="regulation_service" id="regulation_service" value="1" {{ old('regulation_service', $project->regulation_service) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="regulation_service" class="ml-2 block text-sm text-gray-900">Regulación de Servicio</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="regulation_technical" id="regulation_technical" value="1" {{ old('regulation_technical', $project->regulation_technical) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="regulation_technical" class="ml-2 block text-sm text-gray-900">Regulación Técnica</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="regulation_mandatory" id="regulation_mandatory" value="1" {{ old('regulation_mandatory', $project->regulation_mandatory) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="regulation_mandatory" class="ml-2 block text-sm text-gray-900">Regulación Obligatoria</label>
                </div>
            </div>

            <div class="mt-6">
                <label for="mandatory_commitment_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha de Compromiso Obligatorio</label>
                <input type="date" name="mandatory_commitment_date" id="mandatory_commitment_date" value="{{ old('mandatory_commitment_date', $project->mandatory_commitment_date ? $project->mandatory_commitment_date->format('Y-m-d') : '') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                @error('mandatory_commitment_date')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- RANGO SUB-LEGAL -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                Rango Sub-Legal
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="flex items-center">
                    <input type="checkbox" name="sublegal_circular_official" id="sublegal_circular_official" value="1" {{ old('sublegal_circular_official', $project->sublegal_circular_official) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="sublegal_circular_official" class="ml-2 block text-sm text-gray-900">Circular Oficial Sub-Legal</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="sublegal_official_gazette" id="sublegal_official_gazette" value="1" {{ old('sublegal_official_gazette', $project->sublegal_official_gazette) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="sublegal_official_gazette" class="ml-2 block text-sm text-gray-900">Gaceta Oficial Sub-Legal</label>
                </div>
            </div>
        </div>

        <!-- VINCULACIÓN CON PLAN FINANCIERO -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                </svg>
                Vinculación con Plan Financiero
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="flex items-center">
                    <input type="checkbox" name="financial_plan_operational_efficiency" id="financial_plan_operational_efficiency" value="1" {{ old('financial_plan_operational_efficiency', $project->financial_plan_operational_efficiency) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="financial_plan_operational_efficiency" class="ml-2 block text-sm text-gray-900">Eficiencia Operacional</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="financial_plan_financial_stability" id="financial_plan_financial_stability" value="1" {{ old('financial_plan_financial_stability', $project->financial_plan_financial_stability) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="financial_plan_financial_stability" class="ml-2 block text-sm text-gray-900">Estabilidad Financiera</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="financial_plan_customer_solution" id="financial_plan_customer_solution" value="1" {{ old('financial_plan_customer_solution', $project->financial_plan_customer_solution) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="financial_plan_customer_solution" class="ml-2 block text-sm text-gray-900">Solución al Cliente</label>
                </div>
            </div>
        </div>

        <!-- IMPACTO A NIVEL DE ATENCIÓN -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
                Impacto a Nivel de Atención
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="flex items-center">
                    <input type="checkbox" name="impact_business_high" id="impact_business_high" value="1" {{ old('impact_business_high', $project->impact_business_high) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="impact_business_high" class="ml-2 block text-sm text-gray-900">Alto Impacto en Negocio</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="impact_operational_medium" id="impact_operational_medium" value="1" {{ old('impact_operational_medium', $project->impact_operational_medium) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="impact_operational_medium" class="ml-2 block text-sm text-gray-900">Medio Impacto Operacional</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="impact_technological_medium" id="impact_technological_medium" value="1" {{ old('impact_technological_medium', $project->impact_technological_medium) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="impact_technological_medium" class="ml-2 block text-sm text-gray-900">Medio Impacto Tecnológico</label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="impact_financial_high" id="impact_financial_high" value="1" {{ old('impact_financial_high', $project->impact_financial_high) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="impact_financial_high" class="ml-2 block text-sm text-gray-900">Alto Impacto Financiero</label>
                </div>
            </div>

            <div class="mt-6">
                <label for="impacted_system" class="block text-sm font-medium text-gray-700 mb-2">Sistema Impactado</label>
                <textarea name="impacted_system" id="impacted_system" rows="3"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('impacted_system', $project->impacted_system) }}</textarea>
                @error('impacted_system')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- LIDERAZGO Y CALIDAD -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Liderazgo y Calidad
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="project_leader" class="block text-sm font-medium text-gray-700 mb-2">Líder del Proyecto</label>
                    <select name="project_leader" id="project_leader" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Seleccione un líder del equipo</option>
                        @foreach($teamMembers as $member)
                            <option value="{{ $member->full_name }}" {{ old('project_leader', $project->project_leader) == $member->full_name ? 'selected' : '' }}>
                                {{ $member->full_name }} - {{ $member->position }} ({{ $member->department->name }})
                            </option>
                        @endforeach
                    </select>
                    @error('project_leader')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="quality_environment" id="quality_environment" value="1" {{ old('quality_environment', $project->quality_environment) ? 'checked' : '' }}
                           class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label for="quality_environment" class="ml-2 block text-sm text-gray-900">Ambiente de Calidad</label>
                </div>
            </div>
        </div>

        <!-- JUSTIFICACIÓN -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                Justificación
            </h2>
            
            <div>
                <label for="justification" class="block text-sm font-medium text-gray-700 mb-2">Justificación del Proyecto</label>
                <textarea name="justification" id="justification" rows="4"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">{{ old('justification', $project->justification) }}</textarea>
                @error('justification')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- ELABORADO POR -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                Elaborado Por
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="prepared_by_name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                    <input type="text" name="prepared_by_name" id="prepared_by_name" value="{{ old('prepared_by_name', $project->prepared_by_name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('prepared_by_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prepared_by_position" class="block text-sm font-medium text-gray-700 mb-2">Cargo</label>
                    <input type="text" name="prepared_by_position" id="prepared_by_position" value="{{ old('prepared_by_position', $project->prepared_by_position) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('prepared_by_position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prepared_by_extension" class="block text-sm font-medium text-gray-700 mb-2">Extensión</label>
                    <input type="text" name="prepared_by_extension" id="prepared_by_extension" value="{{ old('prepared_by_extension', $project->prepared_by_extension) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('prepared_by_extension')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="prepared_by_signature" class="block text-sm font-medium text-gray-700 mb-2">Firma</label>
                    <input type="text" name="prepared_by_signature" id="prepared_by_signature" value="{{ old('prepared_by_signature', $project->prepared_by_signature) }}"
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
                <svg class="w-5 h-5 mr-2 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Autorizado Por
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="authorized_by_name" class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                    <input type="text" name="authorized_by_name" id="authorized_by_name" value="{{ old('authorized_by_name', $project->authorized_by_name) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('authorized_by_name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="authorized_by_position" class="block text-sm font-medium text-gray-700 mb-2">Cargo</label>
                    <input type="text" name="authorized_by_position" id="authorized_by_position" value="{{ old('authorized_by_position', $project->authorized_by_position) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('authorized_by_position')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="authorized_by_signature" class="block text-sm font-medium text-gray-700 mb-2">Firma</label>
                    <input type="text" name="authorized_by_signature" id="authorized_by_signature" value="{{ old('authorized_by_signature', $project->authorized_by_signature) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('authorized_by_signature')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="authorized_by_seal" class="block text-sm font-medium text-gray-700 mb-2">Sello</label>
                    <input type="text" name="authorized_by_seal" id="authorized_by_seal" value="{{ old('authorized_by_seal', $project->authorized_by_seal) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('authorized_by_seal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- RECIBIDO POR -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                <svg class="w-5 h-5 mr-2 text-cyan-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                Recibido Por
            </h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="received_by" class="block text-sm font-medium text-gray-700 mb-2">Recibido Por</label>
                    <input type="text" name="received_by" id="received_by" value="{{ old('received_by', $project->received_by) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('received_by')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="received_signature_seal" class="block text-sm font-medium text-gray-700 mb-2">Firma y Sello</label>
                    <input type="text" name="received_signature_seal" id="received_signature_seal" value="{{ old('received_signature_seal', $project->received_signature_seal) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                    @error('received_signature_seal')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- BOTONES DE ACCIÓN -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-end space-x-4">
                <a href="{{ route('projects.show', $project) }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Cancelar
                </a>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="-ml-1 mr-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Actualizar Proyecto
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
