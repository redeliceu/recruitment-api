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
        //
        Schema::table('vacancies', function (Blueprint $table) {
            $table->string('location')->nullable()->after('description');
            $table->boolean('type')->nullable()->after('location'); //0 for CLT, 1 for PJ
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::table('vacancies', function (Blueprint $table) {
            $table->dropColumn('location');
            $table->dropColumn('type');
        });
    }
};
