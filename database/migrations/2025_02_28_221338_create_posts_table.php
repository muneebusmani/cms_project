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
        // Create the posts table
        Schema::create('posts', function (Blueprint $table) {
            // The unique identifier for the post
            $table->id();

            // The foreign key for the user who created the post
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // The title of the post
            $table->string('title');

            // The SEO-friendly slug of the post
            $table->string('slug')->unique();

            // The content of the post
            $table->longText('content');

            // A short summary of the post
            $table->text('excerpt');

            // The status of the post (draft, published, archived)
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            // The timestamp when the post was published
            $table->timestamp('published_at')->nullable();

            // The timestamp when the post was deleted
            $table->softDeletes();

            // The timestamps for the post
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
