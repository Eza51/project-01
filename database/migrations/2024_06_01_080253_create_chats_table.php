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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_apply_id')
                    ->constrained('job_applies')
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

            $table->foreignId('employer_id')
                ->comment('account_id')
                ->constrained('accounts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('job_seeker_id')
                ->comment('account_id')
                ->constrained('accounts')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
