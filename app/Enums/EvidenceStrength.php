<?php

namespace App\Enums;

enum EvidenceStrength: string
{
    case Sufficient = 'sufficient';
    case Limited = 'limited';
    case Insufficient = 'insufficient';

    /**
     * Get the human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Sufficient => 'Robust',
            self::Limited => 'Moderate',
            self::Insufficient => 'Limited',
        };
    }

    /**
     * Get CSS badge styling.
     */
    public function badgeClasses(): string
    {
        return match ($this) {
            self::Sufficient => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            self::Limited => 'bg-amber-50 text-amber-800 border-amber-200',
            self::Insufficient => 'bg-rose-50 text-rose-800 border-rose-200',
        };
    }
}
