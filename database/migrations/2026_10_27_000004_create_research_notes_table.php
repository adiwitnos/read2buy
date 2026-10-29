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
        Schema::create('research_notes', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('method')->default('online_research'); // online_research, manufacturer_sample
            $table->string('evidence_strength')->default('sufficient'); // sufficient, limited, insufficient
            $table->json('sources')->nullable(); // array of [url, inspected_at, notes, publisher]
            $table->text('useful_for')->nullable(); // 1. Berguna untuk siapa?
            $table->text('price_reasonableness')->nullable(); // 2. Harganya masuk akal?
            $table->json('key_strengths')->nullable(); // 3. Apa kelebihannya?
            $table->json('limitations')->nullable(); // 4. Apa kekurangannya / trade-offs?
            $table->text('verdict')->nullable(); // Kesimpulan rekomendasi kontekstual
            $table->string('manufacturer_sample_brand')->nullable(); // jika metode sampel produsen
            $table->string('reviewed_by')->nullable();
            $table->date('reviewed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('research_notes');
    }
};
