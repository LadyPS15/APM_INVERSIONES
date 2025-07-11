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
        Schema::create('scoring_configuration', function(Blueprint $table) {
            $table->id();
            $table->decimal('min_score_for_approval', 3, 1)->default(3.0);
            $table->string('role_assignment_algorithm', 50)->default('weighted_score');
            $table->decimal('scrum_evaluation_weight', 3, 1)->default(0.6);
            $table->decimal('technical_evaluation_weight', 3, 1)->default(0.4);
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scoring_configuration');
    }
};
