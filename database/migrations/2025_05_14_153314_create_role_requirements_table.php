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
        Schema::create('role_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('scrum_roles');
            $table->decimal('min_scrum_score', 3, 1);
            $table->decimal('min_general_score', 3, 1);
            $table->foreignId('preferred_specialization_id')->nullable()->constrained('specializations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_requirements');
    }
};
