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
        Schema::create('applicants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name', 150);
            $table->string('email', 150)->unique();
            $table->unsignedBigInteger('career_id');
            $table->integer('academic_cycle');
            $table->string('access_token', 150)->nullable()->unique();
            $table->unsignedBigInteger('specialization_id')->nullable();
            $table->string('programming_languages')->nullable();
            $table->string('availability')->nullable();
            $table->unsignedBigInteger('schedule_id')->nullable();
            $table->unsignedBigInteger('scrum_role_id')->nullable();
            $table->string('otros_lenguajes')->nullable();
            $table->string('experiencia_scrum')->nullable();
            $table->string('tiempo_experiencia')->nullable();
            $table->text('tipo_proyectos')->nullable();
            $table->string('rol_principal')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('career_id')->references('id')->on('careers')->onDelete('restrict');
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('set null');
            $table->foreign('schedule_id')->references('id')->on('schedules')->onDelete('set null');
            $table->foreign('scrum_role_id')->references('id')->on('scrum_roles')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('applicants');
    }
};
