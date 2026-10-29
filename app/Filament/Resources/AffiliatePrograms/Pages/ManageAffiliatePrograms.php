<?php

namespace App\Filament\Resources\AffiliatePrograms\Pages;

use App\Filament\Resources\AffiliatePrograms\AffiliateProgramResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAffiliatePrograms extends ManageRecords
{
    protected static string $resource = AffiliateProgramResource::class;

    public function getTitle(): string
    {
        return 'Affiliate Partner Programs';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
