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

            $table->boolean('is_driven')
                ->default(false)
                ->after('number_of_vacancies');

            $table->unsignedBigInteger('school_id')
                ->nullable()
                ->after('is_driven');

            $table->unsignedBigInteger('context_id')
                ->nullable()
                ->after('school_id');
        });

        Schema::table('vacancies', function (Blueprint $table) {

            $table->foreign('school_id')
                ->references('id')
                ->on('schools');

            $table->foreign('vacancy_context_id')
                ->references('id')
                ->on('vacancies_context');
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
            $table->dropForeign(['context_id']);
            $table->dropColumn('context_id');
        });
    }
};
