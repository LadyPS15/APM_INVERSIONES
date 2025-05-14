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
        Schema::create('question_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id'); // Cambiado a unsignedBigInteger
            $table->text('option_text');
            $table->integer('points');
            $table->timestamps();

            // Agregar la clave foránea después de definir la columna
            $table->foreign('question_id')->references('id')->on('evaluation_questions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_options');
    }
};
