<?php

namespace App\Enums;

enum ContentStatus: string
{
    case Draft = 'draft';
    case Published = 'published';

    /**
     * Get the human-readable label for content status.
     */
    public function label(): string
    {
        return match ($this) {
            self::Draft => 'Draf',
            self::Published => 'Diterbitkan',
        };
    }
}
