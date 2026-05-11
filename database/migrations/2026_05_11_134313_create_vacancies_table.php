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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('label');
            $table->boolean('is_active')->default(true);
            $table->foreignId('category_id')->constrained('vacancies_category');
            $table->decimal('salary', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->integer('number_of_vacancies')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
