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
        Schema::table('vacancies', function (Blueprint $table) {
            //
            $table->boolean('is_driven')->default(false)->after('number_of_vacancies');
            $table->foreignId('school_id')->constrained('schools')->nullable()->after('is_driven');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            //
            $table->dropColumn('is_driven');
            $table->dropForeign(['school_id']);
            $table->dropColumn('school_id');
        });
    }
};
