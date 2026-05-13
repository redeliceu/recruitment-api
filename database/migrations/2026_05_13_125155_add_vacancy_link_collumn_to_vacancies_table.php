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
            $table->string('vacancy_link')->nullable()->after('description');
            $table->dateTime('active_update')->nullable()->after('vacancy_link');
            $table->integer('share_counter')->default(0)->after('active_update');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacancies', function (Blueprint $table) {
            //
            $table->dropColumn('vacancy_link');
            $table->dropColumn('active_update');
            $table->dropColumn('share_counter');
        });
    }
};
