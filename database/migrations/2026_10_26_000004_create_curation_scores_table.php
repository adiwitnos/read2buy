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
        Schema::create('curation_scores', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->unique()->constrained()->cascadeOnDelete();

            // The Magnum Standard: 5 Dimensi Evaluasi (Skala 1.0 - 10.0)
            $table->decimal('score_purpose', 3, 1)->comment('Purpose: Solusi dan kegunaan nyata');
            $table->decimal('score_craft', 3, 1)->comment('Craft: Bahan, detail pengerjaan, dan estetika desain');
            $table->decimal('score_character', 3, 1)->comment('Character: Keselarasan dengan tema dan identitas');
            $table->decimal('score_longevity', 3, 1)->comment('Longevity: Daya tahan dan relevansi jangka panjang');
            $table->decimal('score_value', 3, 1)->comment('Value: Nilai manfaat sepadan dengan harga');
            $table->decimal('overall_score', 3, 1)->comment('Rerata tertimbang kurasi MagnumOpus.web.id');

            // Narasi Kurasi & Transparansi
            $table->text('verdict')->comment('Alasan produk ini layak masuk kurasi');
            $table->json('key_strengths')->nullable()->comment('Daftar kelebihan utama');
            $table->json('trade_offs')->nullable()->comment('Kelemahan atau kompromi yang perlu diketahui pembeli');
            $table->text('ideal_for')->comment('Profil pengguna yang paling cocok');
            $table->text('not_recommended_for')->comment('Profil pengguna yang sebaiknya menghindari produk ini');

            // Bukti Pengujian & Integritas Metodologi
            $table->string('evaluation_method')->default('specification_research');
            $table->date('tested_at')->nullable();
            $table->string('tested_by')->nullable();
            $table->text('testing_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curation_scores');
    }
};
