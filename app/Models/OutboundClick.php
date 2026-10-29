<?php

namespace App\Models;

use App\Enums\AffiliatePlatform;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'affiliate_offer_id',
    'product_id',
    'platform',
    'ip_address',
    'user_agent',
    'referrer',
])]
class OutboundClick extends Model
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
        ];
    }

    /**
     * The affiliate offer clicked.
     *
     * @return BelongsTo<AffiliateOffer, $this>
     */
    public function affiliateOffer(): BelongsTo
    {
        return $this->belongsTo(AffiliateOffer::class);
    }

    /**
     * The product associated with this click.
     *
     * @return BelongsTo<Product, $this>
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
