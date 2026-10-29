<?php

namespace App\Enums;

enum ProgramStatus: string
{
    case Active = 'active';
    case Pending = 'pending';
    case Paused = 'paused';

    /**
     * Get the human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Active => 'Active & Approved',
            self::Pending => 'Pending Approval',
            self::Paused => 'Paused / Under Review',
        };
    }

    /**
     * Check if program is eligible to display public affiliate links.
     */
    public function isEligibleForPublicLinks(): bool
    {
        return $this === self::Active;
    }

    /**
     * Get the badge color CSS classes.
     */
    public function badgeColor(): string
    {
        return match ($this) {
            self::Active => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
            self::Pending => 'bg-amber-100 text-amber-800 border border-amber-200',
            self::Paused => 'bg-stone-200 text-stone-700 border border-stone-300',
        };
    }
}
