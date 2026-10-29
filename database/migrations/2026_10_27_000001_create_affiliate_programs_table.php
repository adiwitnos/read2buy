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
        Schema::create('affiliate_programs', function (Blueprint $table): void {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('network')->nullable(); // e.g. Direct, ACCESSTRADE, Involve Asia
            $table->string('status')->default('pending'); // active, pending, paused
            $table->json('approved_channels')->nullable(); // allowed domains/channels
            $table->string('terms_url')->nullable();
            $table->text('commission_rate_notes')->nullable();
            $table->text('compliance_notes')->nullable();
            $table->timestamp('last_checked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_programs');
    }
};
