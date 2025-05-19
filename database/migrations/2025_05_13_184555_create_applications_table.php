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
       Schema::create('applications', function(Blueprint $table) {
            $table->id();
            $table->foreignId('applicant_id')->constrained('applicants')->onDelete('cascade');
            $table->foreignId('institution_id')->nullable()->constrained('educational_institutions')->nullOnDelete();
            $table->foreignId('career_id')->constrained('careers')->onDelete('restrict');
            $table->string('academic_cycle', 20);
            $table->foreignId('specialization_id')->nullable()->constrained('specializations')->nullOnDelete();
            $table->foreignId('schedule_id')->nullable()->constrained('schedules')->nullOnDelete();
            $table->integer('agile_experience_months')->default(0);
            $table->foreignId('previous_role_id')->nullable()->constrained('scrum_roles')->nullOnDelete();
            $table->text('project_experience')->nullable();
            $table->string('status', 20)->default('pending');
            $table->decimal('general_score', 3, 1)->default(0.0);
            $table->decimal('scrum_score', 3, 1)->default(0.0);
            $table->foreignId('assigned_role_id')->nullable()->constrained('scrum_roles')->nullOnDelete();
            $table->foreignId('reviewer_id')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('review_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
