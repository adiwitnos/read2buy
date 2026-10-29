<?php

namespace App\Enums;

enum CommissionStatus: string
{
    case Estimated = 'estimated';
    case Approved = 'approved';
    case Paid = 'paid';
    case Rejected = 'rejected';

    /**
     * Get the human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::Estimated => 'Estimated (Pending)',
            self::Approved => 'Approved by Merchant',
            self::Paid => 'Paid (Settled)',
            self::Rejected => 'Rejected / Voided',
        };
    }
}
