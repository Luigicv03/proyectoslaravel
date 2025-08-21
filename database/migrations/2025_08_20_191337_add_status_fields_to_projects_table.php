<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusFieldsToProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->enum('status', [
                'reciente', 
                'pendiente_activar', 
                'documento_devuelto', 
                'desarrollo', 
                'produccion'
            ])->default('reciente');
            $table->string('project_code')->nullable();
            $table->string('project_type')->nullable();
            $table->date('reception_date')->nullable();
            $table->text('observation')->nullable();
            $table->integer('progress_percentage')->default(0);
            $table->date('development_certification_date')->nullable();
            $table->boolean('passes_to_quality')->default(false);
            $table->date('tentative_production_date')->nullable();
            $table->date('production_release_date')->nullable();
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
                'status',
                'project_code',
                'project_type',
                'reception_date',
                'observation',
                'progress_percentage',
                'development_certification_date',
                'passes_to_quality',
                'tentative_production_date',
                'production_release_date'
            ]);
        });
    }
}
