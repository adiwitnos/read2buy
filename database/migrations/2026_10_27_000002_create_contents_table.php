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
        Schema::create('contents', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->string('type')->default('guide'); // guide, story
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('headline')->nullable();
            $table->text('excerpt')->nullable();
            $table->longText('body');
            $table->string('status')->default('draft'); // draft, published
            $table->string('hero_image')->nullable();
            $table->unsignedSmallInteger('reading_time_minutes')->default(5);
            $table->timestamp('published_at')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
