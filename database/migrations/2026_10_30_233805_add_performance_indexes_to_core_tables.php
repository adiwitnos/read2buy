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
        Schema::table('products', function (Blueprint $table): void {
            $table->index(['is_active', 'published_at'], 'idx_products_active_published');
        });

        Schema::table('contents', function (Blueprint $table): void {
            $table->index(['type', 'status', 'published_at'], 'idx_contents_type_status_published');
        });

        Schema::table('outbound_clicks', function (Blueprint $table): void {
            $table->index(['affiliate_offer_id', 'created_at'], 'idx_clicks_offer_created');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table): void {
            $table->dropIndex('idx_products_active_published');
        });

        Schema::table('contents', function (Blueprint $table): void {
            $table->dropIndex('idx_contents_type_status_published');
        });

        Schema::table('outbound_clicks', function (Blueprint $table): void {
            $table->dropIndex('idx_clicks_offer_created');
        });
    }
};
