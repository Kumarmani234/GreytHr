<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('clients_with_projects', function (Blueprint $table) {
            $table->id();
            $table->string('client_id');
            $table->string('project_name');
            $table->text('project_description')->nullable();
            $table->date('project_start_date')->nullable();
            $table->date('project_end_date')->nullable();
            $table->foreign('client_id')
            ->references('client_id') // Assuming the primary key of the companies table is 'id'
            ->on('clients')
            ->onDelete('restrict')
            ->onUpdate('cascade');
            $table->foreign('project_name')
            ->references('project_name') // Assuming the primary key of the companies table is 'id'
            ->on('clients')
            ->onDelete('restrict')
            ->onUpdate('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients_with_projects');
    }
};
