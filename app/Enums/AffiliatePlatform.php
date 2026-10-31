<?php

namespace App\Enums;

enum AffiliatePlatform: string
{
    case Amazon = 'amazon';
    case Shopee = 'shopee';
    case TikTokShop = 'tiktok_shop';
    case Tokopedia = 'tokopedia';
    case Direct = 'direct';
    case Other = 'other';

    /**
     * Get the human-readable label for the platform.
     */
    public function label(): string
    {
        return match ($this) {
            self::Amazon => 'Amazon',
            self::Shopee => 'Shopee',
            self::TikTokShop => 'TikTok Shop',
            self::Tokopedia => 'Tokopedia',
            self::Direct => 'Official Brand Store',
            self::Other => 'Official Partner',
        };
    }
}
