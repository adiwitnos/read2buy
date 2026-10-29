<?php

namespace App\Enums;

enum AffiliatePlatform: string
{
    case Shopee = 'shopee';
    case TikTokShop = 'tiktok_shop';
    case Other = 'other';

    /**
     * Get the human-readable label for the platform.
     */
    public function label(): string
    {
        return match ($this) {
            self::Shopee => 'Shopee',
            self::TikTokShop => 'TikTok Shop',
            self::Other => 'Official Partner',
        };
    }
}
