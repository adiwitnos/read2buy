<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class CustomizationPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPaintBrush;

    protected static ?string $navigationLabel = 'Site Customization';

    protected static ?string $title = 'Site Customization';

    protected static ?int $navigationSort = 3;

    protected string $view = 'filament.pages.customization-page';

    public string $siteName = '';

    public string $siteSlogan = '';

    public string $heroHeadline = '';

    public string $heroDescription = '';

    public string $contactEmail = '';

    public string $contactWhatsApp = '';

    public string $editorialStatement = '';

    public function mount(): void
    {
        $this->siteName = SiteSetting::get('site_name', 'Read2Buy.com') ?? 'Read2Buy.com';
        $this->siteSlogan = SiteSetting::get('site_slogan', 'Curated Selections for Conscious Decisions') ?? 'Curated Selections for Conscious Decisions';
        $this->heroHeadline = SiteSetting::get('hero_headline', 'Research-backed buying guides for conscious living.') ?? 'Research-backed buying guides for conscious living.';
        $this->heroDescription = SiteSetting::get('hero_description', 'Independent research desk evaluating technical merits and long-term durability.') ?? 'Independent research desk evaluating technical merits and long-term durability.';
        $this->contactEmail = SiteSetting::get('contact_email', 'editorial@read2buy.com') ?? 'editorial@read2buy.com';
        $this->contactWhatsApp = SiteSetting::get('contact_whatsapp', '+1-800-READ2BUY') ?? '+1-800-READ2BUY';
        $this->editorialStatement = SiteSetting::get('editorial_statement', 'Independent curation based on rigorous engineering research without paid placements.') ?? 'Independent curation based on rigorous engineering research without paid placements.';
    }

    public function save(): void
    {
        SiteSetting::set('site_name', $this->siteName, 'branding');
        SiteSetting::set('site_slogan', $this->siteSlogan, 'branding');
        SiteSetting::set('hero_headline', $this->heroHeadline, 'branding');
        SiteSetting::set('hero_description', $this->heroDescription, 'branding');
        SiteSetting::set('contact_email', $this->contactEmail, 'general');
        SiteSetting::set('contact_whatsapp', $this->contactWhatsApp, 'general');
        SiteSetting::set('editorial_statement', $this->editorialStatement, 'general');

        Notification::make()
            ->title('Site Customizations Saved Successfully')
            ->success()
            ->send();
    }
}
