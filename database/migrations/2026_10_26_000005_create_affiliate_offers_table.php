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
        Schema::create('affiliate_offers', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('platform')->default('shopee');
            $table->string('seller_name')->nullable();
            $table->string('seller_badge')->nullable();
            $table->text('affiliate_url');
            $table->unsignedBigInteger('price')->nullable();
            $table->string('currency', 3)->default('IDR');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_primary')->default(false);
            $table->timestamp('last_verified_at')->nullable();
            $table->string('compliance_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate_offers');
    }
};
