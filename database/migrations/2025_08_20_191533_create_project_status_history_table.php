<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectStatusHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_status_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->enum('from_status', [
                'reciente', 
                'pendiente_activar', 
                'documento_devuelto', 
                'desarrollo', 
                'produccion'
            ])->nullable();
            $table->enum('to_status', [
                'reciente', 
                'pendiente_activar', 
                'documento_devuelto', 
                'desarrollo', 
                'produccion'
            ]);
            $table->text('notes')->nullable();
            $table->foreignId('changed_by')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_status_history');
    }
}
