<?php

namespace App\Filament\Resources\ResearchNotes\Pages;

use App\Filament\Resources\ResearchNotes\ResearchNoteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageResearchNotes extends ManageRecords
{
    protected static string $resource = ResearchNoteResource::class;

    public function getTitle(): string
    {
        return '5-Question Research Notes & Audits';
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
