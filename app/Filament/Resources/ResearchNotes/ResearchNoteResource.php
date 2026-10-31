<?php

namespace App\Filament\Resources\ResearchNotes;

use App\Enums\EvidenceStrength;
use App\Enums\ResearchMethod;
use App\Filament\Resources\ResearchNotes\Pages\ManageResearchNotes;
use App\Models\ResearchNote;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResearchNoteResource extends Resource
{
    protected static ?string $model = ResearchNote::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentCheck;

    protected static ?string $navigationLabel = 'Research Notes';

    protected static ?string $modelLabel = 'Research Note';

    protected static ?string $pluralModelLabel = 'Research Notes';

    protected static ?int $navigationSort = 3;

    protected static ?string $recordTitleAttribute = 'useful_for';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('research_method')
                    ->label('Research Method')
                    ->options([
                        ResearchMethod::SpecificationAudit->value => 'Technical Specification Audit',
                        ResearchMethod::UserExperienceAggregation->value => 'User Experience Aggregation',
                        ResearchMethod::ManufacturerDataVerification->value => 'Manufacturer Data Verification',
                        ResearchMethod::IndependentLabReview->value => 'Independent Lab Review',
                    ])
                    ->default(ResearchMethod::SpecificationAudit->value)
                    ->required(),

                Select::make('evidence_strength')
                    ->label('Evidence Strength')
                    ->options([
                        EvidenceStrength::VerifiedDirect->value => 'Verified Direct (Primary Technical Sheets)',
                        EvidenceStrength::VerifiedAggregated->value => 'Verified Aggregated (Corroborated by 3+ independent sources)',
                        EvidenceStrength::PreliminaryReview->value => 'Preliminary Review',
                    ])
                    ->default(EvidenceStrength::VerifiedDirect->value)
                    ->required(),

                TextInput::make('sources_count')
                    ->label('Independent Sources Consulted')
                    ->numeric()
                    ->default(3)
                    ->required(),

                DateTimePicker::make('reviewed_at')
                    ->label('Review Date')
                    ->default(now()),

                Textarea::make('useful_for')
                    ->label('1. Who benefits most from this product?')
                    ->rows(2)
                    ->columnSpanFull()
                    ->required(),

                Textarea::make('price_reasonableness')
                    ->label('2. Is the price justified? (Cost vs longevity benchmark)')
                    ->rows(2)
                    ->columnSpanFull()
                    ->required(),

                TagsInput::make('key_strengths')
                    ->label('3. Key Strengths & Technical Advantages')
                    ->placeholder('Add verified strength')
                    ->columnSpanFull(),

                TagsInput::make('limitations')
                    ->label('4. Hidden Flaws, Caveats & Limitations')
                    ->placeholder('Add limitation / trade-off')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('research_method')
                    ->label('Method')
                    ->badge(),

                TextColumn::make('evidence_strength')
                    ->label('Evidence')
                    ->badge(),

                TextColumn::make('sources_count')
                    ->label('Sources')
                    ->sortable(),

                TextColumn::make('reviewed_at')
                    ->label('Reviewed')
                    ->date('M d, Y')
                    ->sortable(),
            ])
            ->defaultSort('reviewed_at', 'desc')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageResearchNotes::route('/'),
        ];
    }
}
