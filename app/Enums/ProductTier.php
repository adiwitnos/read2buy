<?php

namespace App\Enums;

enum ProductTier: string
{
    case Essentials = 'essentials';
    case Select = 'select';
    case Signature = 'signature';

    /**
     * Get the human-readable label for the tier.
     */
    public function label(): string
    {
        return match ($this) {
            self::Essentials => 'Essentials',
            self::Select => 'Select',
            self::Signature => 'Signature',
        };
    }

    /**
     * Get the editorial definition of the tier according to The Read2Buy Standard.
     */
    public function definition(): string
    {
        return match ($this) {
            self::Essentials => 'Reliably meets core functional requirements with controlled cost.',
            self::Select => 'Optimal balance of performance, durability, and daily ownership value.',
            self::Signature => 'Uncompromising build, refined ergonomics, or specialized capability for intensive use.',
        };
    }

    /**
     * Badge CSS classes for styling.
     */
    public function badgeClasses(): string
    {
        return match ($this) {
            self::Essentials => 'bg-emerald-50 text-emerald-800 border-emerald-200',
            self::Select => 'bg-amber-50 text-amber-900 border-amber-200',
            self::Signature => 'bg-stone-900 text-stone-100 border-stone-800',
        };
    }
}
