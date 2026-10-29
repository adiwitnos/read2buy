<?php

namespace App\Models;

use App\Enums\ProgramStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'name',
    'slug',
    'network',
    'status',
    'approved_channels',
    'terms_url',
    'commission_rate_notes',
    'compliance_notes',
    'last_checked_at',
])]
class AffiliateProgram extends Model
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
            'status' => ProgramStatus::class,
            'approved_channels' => 'array',
            'last_checked_at' => 'datetime',
        ];
    }

    /**
     * Affiliate offers linked to this merchant/program.
     *
     * @return HasMany<AffiliateOffer, $this>
     */
    public function offers(): HasMany
    {
        return $this->hasMany(AffiliateOffer::class);
    }

    /**
     * Recorded commission entries for this program.
     *
     * @return HasMany<CommissionEntry, $this>
     */
    public function commissionEntries(): HasMany
    {
        return $this->hasMany(CommissionEntry::class);
    }

    /**
     * Scope a query to only include active & approved programs.
     *
     * @param  Builder<AffiliateProgram>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', ProgramStatus::Active);
    }
}
