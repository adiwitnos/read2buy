<?php

namespace App\Filament\Pages;

use App\Models\SiteSetting;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class TrackingScriptsPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCodeBracketSquare;

    protected static ?string $navigationLabel = 'Tracking & Analytics Scripts';

    protected static ?string $title = 'Tracking & Analytics Scripts';

    protected static ?int $navigationSort = 4;

    protected string $view = 'filament.pages.tracking-scripts-page';

    public string $googleAnalyticsId = '';

    public string $metaPixelId = '';

    public string $googleTagManagerId = '';

    public string $customHeadScripts = '';

    public string $customBodyScripts = '';

    public function mount(): void
    {
        $this->googleAnalyticsId = SiteSetting::get('tracking_ga_id', '') ?? '';
        $this->metaPixelId = SiteSetting::get('tracking_meta_pixel_id', '') ?? '';
        $this->googleTagManagerId = SiteSetting::get('tracking_gtm_id', '') ?? '';
        $this->customHeadScripts = SiteSetting::get('tracking_custom_head', '') ?? '';
        $this->customBodyScripts = SiteSetting::get('tracking_custom_body', '') ?? '';
    }

    public function save(): void
    {
        SiteSetting::set('tracking_ga_id', $this->googleAnalyticsId, 'tracking');
        SiteSetting::set('tracking_meta_pixel_id', $this->metaPixelId, 'tracking');
        SiteSetting::set('tracking_gtm_id', $this->googleTagManagerId, 'tracking');
        SiteSetting::set('tracking_custom_head', $this->customHeadScripts, 'tracking');
        SiteSetting::set('tracking_custom_body', $this->customBodyScripts, 'tracking');

        Notification::make()
            ->title('Tracking & Analytics Scripts Saved Successfully')
            ->success()
            ->send();
    }
}
