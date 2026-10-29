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
        Schema::create('commission_entries', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('affiliate_program_id')->constrained('affiliate_programs')->cascadeOnDelete();
            $table->string('provider_ref')->nullable(); // external invoice / transaction / report ref
            $table->string('period', 7); // e.g. '2026-10'
            $table->string('status')->default('estimated'); // estimated, approved, paid, rejected
            $table->unsignedBigInteger('amount'); // in IDR
            $table->string('currency', 3)->default('IDR');
            $table->timestamp('paid_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_entries');
    }
};
