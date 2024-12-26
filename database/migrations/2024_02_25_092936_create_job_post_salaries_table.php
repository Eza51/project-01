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
        Schema::create('job_post_salaries', function (Blueprint $table) {
            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('salary_type_attr_id')
                ->constrained('job_attributes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->unsignedMediumInteger('min_salary');
            $table->unsignedMediumInteger('max_salary')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_salaries');
    }
};
