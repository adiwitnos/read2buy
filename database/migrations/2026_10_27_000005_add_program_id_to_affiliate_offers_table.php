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
        Schema::table('affiliate_offers', function (Blueprint $table): void {
            $table->foreignId('affiliate_program_id')
                ->nullable()
                ->after('product_id')
                ->constrained('affiliate_programs')
                ->nullOnDelete();
            $table->string('disclosure_label')->nullable()->after('affiliate_url');
            $table->boolean('is_eligible')->default(true)->after('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('affiliate_offers', function (Blueprint $table): void {
            $table->dropForeign(['affiliate_program_id']);
            $table->dropColumn(['affiliate_program_id', 'disclosure_label', 'is_eligible']);
        });
    }
};
