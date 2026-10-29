<?php

namespace App\Enums;

enum ContentType: string
{
    case Guide = 'guide';
    case Story = 'story';
    case Blog = 'blog';

    /**
     * Get the human-readable label for the content type.
     */
    public function label(): string
    {
        return match ($this) {
            self::Guide => 'Buying Guide',
            self::Story => 'Story Series',
            self::Blog => 'Research Article & Blog',
        };
    }

    /**
     * Get route prefix for this content type.
     */
    public function routePrefix(): string
    {
        return match ($this) {
            self::Guide => 'guides',
            self::Story => 'stories',
            self::Blog => 'blog',
        };
    }
}
