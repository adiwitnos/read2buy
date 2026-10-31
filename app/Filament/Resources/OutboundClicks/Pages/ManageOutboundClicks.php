<?php

namespace App\Filament\Resources\OutboundClicks\Pages;

use App\Filament\Resources\OutboundClicks\OutboundClickResource;
use Filament\Resources\Pages\ManageRecords;

class ManageOutboundClicks extends ManageRecords
{
    protected static string $resource = OutboundClickResource::class;

    public function getTitle(): string
    {
        return 'Outbound Affiliate Clicks & Referral Logs';
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
