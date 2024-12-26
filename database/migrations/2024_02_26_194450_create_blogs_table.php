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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blog_category_id')
                ->constrained('blog_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreignId('account_id')
                ->nullable()
                ->constrained('accounts')
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('posted_by')->nullable();
            $table->string('posted_on')->nullable();
            $table->string('image')->nullable();
            $table->string('short_description');
            $table->longText('description');
            $table->unsignedInteger('views')->default(0);
            $table->enum('status', ['Pending', 'Publish', 'Unpublished']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
