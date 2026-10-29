<?php

namespace App\Models;

use App\Enums\EvidenceStrength;
use App\Enums\ResearchMethod;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'product_id',
    'method',
    'evidence_strength',
    'sources',
    'useful_for',
    'price_reasonableness',
    'key_strengths',
    'limitations',
    'verdict',
    'manufacturer_sample_brand',
    'reviewed_by',
    'reviewed_at',
])]
class ResearchNote extends Model
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
            'method' => ResearchMethod::class,
            'evidence_strength' => EvidenceStrength::class,
            'sources' => 'array',
            'key_strengths' => 'array',
            'limitations' => 'array',
            'reviewed_at' => 'date',
        ];
    }

    /**
     * Product evaluated by this research note.
     *
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
