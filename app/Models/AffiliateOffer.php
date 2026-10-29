<?php

namespace App\Models;

use App\Enums\AffiliatePlatform;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'product_id',
    'affiliate_program_id',
    'platform',
    'seller_name',
    'seller_badge',
    'affiliate_url',
    'disclosure_label',
    'price',
    'currency',
    'is_active',
    'is_primary',
    'is_eligible',
    'last_verified_at',
    'compliance_notes',
])]
class AffiliateOffer extends Model
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
            'platform' => AffiliatePlatform::class,
            'price' => 'integer',
            'is_active' => 'boolean',
            'is_primary' => 'boolean',
            'is_eligible' => 'boolean',
            'last_verified_at' => 'datetime',
        ];
    }

    /**
     * Product linked to this affiliate offer.
     *
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Registered merchant affiliate program.
     *
     * @return BelongsTo<AffiliateProgram, $this>
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(AffiliateProgram::class, 'affiliate_program_id');
    }

    /**
     * Scope a query to only include active offers.
     *
     * @param  Builder<AffiliateOffer>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('is_active', true);
    }

    /**
     * Scope a query to only include primary offers.
     *
     * @param  Builder<AffiliateOffer>  $query
     */
    public function scopePrimary(Builder $query): void
    {
        $query->where('is_primary', true);
    }
}
