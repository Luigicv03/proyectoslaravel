<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('project_snapshots', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_import_id')->constrained('data_imports')->onDelete('cascade');
            $table->string('task_identifier'); // ID de la tarea desde el Excel
            $table->text('task_name')->nullable();
            $table->string('environment', 100); // 'Desarrollo', 'Calidad', 'Producción'
            $table->integer('progress_percentage');
            $table->date('start_date')->nullable();
            $table->date('estimated_end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('project_snapshots');
    }
};
