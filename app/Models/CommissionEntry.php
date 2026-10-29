<?php

namespace App\Models;

use App\Enums\CommissionStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'affiliate_program_id',
    'provider_ref',
    'period',
    'status',
    'amount',
    'currency',
    'paid_at',
    'notes',
])]
class CommissionEntry extends Model
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
            'status' => CommissionStatus::class,
            'amount' => 'integer',
            'paid_at' => 'datetime',
        ];
    }

    /**
     * Program that generated this commission.
     *
     * @return BelongsTo<AffiliateProgram, $this>
     */
    public function program(): BelongsTo
    {
        return $this->belongsTo(AffiliateProgram::class, 'affiliate_program_id');
    }
}
