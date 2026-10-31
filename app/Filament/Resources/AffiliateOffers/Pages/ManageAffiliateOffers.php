<?php

namespace App\Filament\Resources\AffiliateOffers\Pages;

use App\Filament\Resources\AffiliateOffers\AffiliateOfferResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAffiliateOffers extends ManageRecords
{
    protected static string $resource = AffiliateOfferResource::class;

    public function getTitle(): string
    {
        return 'Affiliate Offers & Merchant Links';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
