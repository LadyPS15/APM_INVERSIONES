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
        Schema::table('applicants', function (Blueprint $table) {
        $table->string('programming_languages')->nullable()->after('specialization_id');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('applicants', function (Blueprint $table) {
        $table->dropColumn('programming_languages');
    });
}
};
