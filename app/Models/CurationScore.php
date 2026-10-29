<?php

namespace App\Models;

use App\Enums\EvaluationMethod;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'product_id',
    'score_purpose',
    'score_craft',
    'score_character',
    'score_longevity',
    'score_value',
    'overall_score',
    'verdict',
    'key_strengths',
    'trade_offs',
    'ideal_for',
    'not_recommended_for',
    'evaluation_method',
    'tested_at',
    'tested_by',
    'testing_notes',
])]
class CurationScore extends Model
{
    use HasFactory;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'score_purpose' => 'float',
            'score_craft' => 'float',
            'score_character' => 'float',
            'score_longevity' => 'float',
            'score_value' => 'float',
            'overall_score' => 'float',
            'key_strengths' => 'array',
            'trade_offs' => 'array',
            'evaluation_method' => EvaluationMethod::class,
            'tested_at' => 'date',
        ];
    }

    /**
     * Product evaluated under The Read2Buy Standard.
     *
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Compute the arithmetic average score across the 5 curation dimensions.
     */
    public function computeAverageScore(): float
    {
        $sum = (float) $this->score_purpose
            + (float) $this->score_craft
            + (float) $this->score_character
            + (float) $this->score_longevity
            + (float) $this->score_value;

        return round($sum / 5, 1);
    }
}
