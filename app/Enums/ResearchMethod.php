<?php

namespace App\Enums;

enum ResearchMethod: string
{
    case OnlineResearch = 'online_research';
    case ManufacturerSample = 'manufacturer_sample';

    /**
     * Get the human-readable label.
     */
    public function label(): string
    {
        return match ($this) {
            self::OnlineResearch => 'Independent Research',
            self::ManufacturerSample => 'Manufacturer Sample Testing',
        };
    }

    /**
     * Get the public disclosure statement.
     */
    public function disclosure(string $brandName = ''): string
    {
        return match ($this) {
            self::OnlineResearch => 'Analyzed from published technical specifications and public benchmark data; not physically lab-tested.',
            self::ManufacturerSample => 'Product tested with a complimentary sample provided by the official manufacturer'.($brandName ? " ($brandName)" : '').', without editorial conditions.',
        };
    }
}
