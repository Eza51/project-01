<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->enum('account_type', ['Employer', 'Job Seeker'])->default('Job Seeker');
            $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('avatar_image')->nullable();
            $table->string('cover_image')->nullable();
            $table->boolean('is_public_profile')->nullable()->default(0);
            $table->unsignedInteger('views')->default(0);
            $table->char('password', 60);
            $table->timestamp('email_verified_at')->nullable();
            $table->char('remember_token', 60)->nullable();
            $table->enum('status', ['Pending', 'Approved', 'Suspended'])->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
