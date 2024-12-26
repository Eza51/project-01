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
        Schema::create('job_applies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')
                ->constrained('accounts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('job_post_id')
                ->constrained('job_posts')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->text('cover_letter')->nullable();
            $table->string('resume_path')->nullable();
            $table->text('feedback')->nullable();
            $table->dateTime('interview_date')->nullable();
            $table->enum('status', [
                'Submitted',
                'Under Review',
                'Shortlisted',
                'Interview Scheduled',
                'Rejected',
                'Withdrawn',
                'Hired',
            ])->default('Submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_applies');
    }
};
