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
        Schema::create('job_post_locations', function (Blueprint $table) {
            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->unsignedSmallInteger('country_id')->nullable();
            $table->unsignedSmallInteger('state_id')->nullable();
            $table->mediumInteger('city_id')->nullable();
            $table->string('address')->nullable();

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->cascadeOnUpdate()
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_post_locations');
    }
};
