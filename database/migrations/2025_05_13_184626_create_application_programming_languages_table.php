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
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('programming_language_id');
            $table->integer('proficiency_level')->default(3);

            $table->primary(['application_id', 'programming_language_id']);

            $table->foreign('application_id', 'fk_applang_app')
                ->references('id')->on('applications')
                ->onDelete('cascade');

            $table->foreign('programming_language_id', 'fk_applang_proglang')
                ->references('id')->on('programming_languages')
                ->onDelete('restrict');
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
