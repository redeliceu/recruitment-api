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
        Schema::create('job_applications', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('job_name');

            $table->string('number_phone');
            $table->string('email')->unique();

            $table->string('location');
            $table->string('neighborhood')->nullable();

            $table->text('linkedin_url')->nullable();
            $table->boolean('has_experience');
            $table->boolean('has_previous_application');

            $table->decimal('salary_intention', 10, 2);
            $table->string('starts');

            $table->text('cv_url');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applications');
    }
};
