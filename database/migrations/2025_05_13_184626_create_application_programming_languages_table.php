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
            Schema::create('application_programming_languages', function (Blueprint $table) {
                $table->foreignId('application_id')->constrained()->onDelete('cascade');
                $table->foreignId('programming_language_id')->constrained()
                    ->name('application_programming_languages_programming_language_id_foreign'); // Nombre personalizado
                $table->integer('proficiency_level')->default(3); // Level 1-5
                $table->primary(['application_id', 'programming_language_id']);
            });
        }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('application_programming_languages');
    }
};
