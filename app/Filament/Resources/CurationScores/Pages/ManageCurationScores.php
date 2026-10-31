<?php

namespace App\Filament\Resources\CurationScores\Pages;

use App\Filament\Resources\CurationScores\CurationScoreResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCurationScores extends ManageRecords
{
    protected static string $resource = CurationScoreResource::class;

    public function getTitle(): string
    {
        return 'The Read2Buy Standard — Curation Scores';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
