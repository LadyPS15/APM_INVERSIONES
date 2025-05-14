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
        Schema::create('role_resources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('scrum_roles');
            $table->string('title', 255);
            $table->text('description')->nullable();
            $table->string('resource_type', 50); // documentation, course, community, etc.
            $table->string('file_path', 255)->nullable();
            $table->string('external_link', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_resources');
    }
};
