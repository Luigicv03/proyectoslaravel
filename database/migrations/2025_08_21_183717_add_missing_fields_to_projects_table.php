<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMissingFieldsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Prioridad
            $table->enum('priority', ['baja', 'media', 'alta'])->default('media');
            
            // TIPO DE REGULACION
            $table->boolean('regulation_organizational')->default(false);
            $table->boolean('regulation_operational')->default(false);
            $table->boolean('regulation_audit_internal')->default(false);
            $table->boolean('regulation_audit_external')->default(false);
            $table->boolean('regulation_service')->default(false);
            $table->boolean('regulation_technical')->default(false);
            $table->boolean('regulation_mandatory')->default(false);
            
            // Mandatorio/regulatorio - Fecha de compromiso
            $table->date('mandatory_commitment_date')->nullable();
            
            // Rango Sub-Legal
            $table->boolean('sublegal_circular_official')->default(false);
            $table->boolean('sublegal_official_gazette')->default(false);
            
            // VINCULACION CON EL PLAN FINANCIERO DEL BANCO
            $table->boolean('financial_plan_operational_efficiency')->default(false);
            $table->boolean('financial_plan_financial_stability')->default(false);
            $table->boolean('financial_plan_customer_solution')->default(false);
            
            // IMPACTO A NIVEL DE ATENCION
            $table->boolean('impact_business_high')->default(false);
            $table->boolean('impact_operational_medium')->default(false);
            $table->boolean('impact_technological_medium')->default(false);
            $table->boolean('impact_financial_high')->default(false);
            
            // SISTEMA QUE IMPACTA
            $table->text('impacted_system')->nullable();
            
            // LIDER DE PROYECTO
            $table->string('project_leader')->nullable();
            
            // AMBIENTE DE CALIDAD
            $table->boolean('quality_environment')->default(false);
            
            // JUSTIFICACION
            $table->text('justification')->nullable();
            
            // ELABORADO POR
            $table->string('prepared_by_name')->nullable();
            $table->string('prepared_by_position')->nullable();
            $table->string('prepared_by_extension')->nullable();
            $table->string('prepared_by_signature')->nullable();
            
            // AUTORIZADO POR
            $table->string('authorized_by_name')->nullable();
            $table->string('authorized_by_position')->nullable();
            $table->string('authorized_by_signature')->nullable();
            $table->string('authorized_by_seal')->nullable();
            
            // Recibido
            $table->string('received_by')->nullable();
            $table->string('received_signature_seal')->nullable();
            
            // Fecha de solicitud
            $table->date('request_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn([
                'priority',
                'regulation_organizational',
                'regulation_operational',
                'regulation_audit_internal',
                'regulation_audit_external',
                'regulation_service',
                'regulation_technical',
                'regulation_mandatory',
                'mandatory_commitment_date',
                'sublegal_circular_official',
                'sublegal_official_gazette',
                'financial_plan_operational_efficiency',
                'financial_plan_financial_stability',
                'financial_plan_customer_solution',
                'impact_business_high',
                'impact_operational_medium',
                'impact_technological_medium',
                'impact_financial_high',
                'impacted_system',
                'project_leader',
                'quality_environment',
                'justification',
                'prepared_by_name',
                'prepared_by_position',
                'prepared_by_extension',
                'prepared_by_signature',
                'authorized_by_name',
                'authorized_by_position',
                'authorized_by_signature',
                'authorized_by_seal',
                'received_by',
                'received_signature_seal',
                'request_date'
            ]);
        });
    }
}
