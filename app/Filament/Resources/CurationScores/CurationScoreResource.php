<?php

namespace App\Filament\Resources\CurationScores;

use App\Enums\EvaluationMethod;
use App\Filament\Resources\CurationScores\Pages\ManageCurationScores;
use App\Models\CurationScore;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CurationScoreResource extends Resource
{
    protected static ?string $model = CurationScore::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedScale;

    protected static ?string $navigationLabel = 'Curation Scores';

    protected static ?string $modelLabel = 'Curation Score';

    protected static ?string $pluralModelLabel = 'Curation Scores';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'editorial_verdict';

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

                Select::make('evaluation_method')
                    ->label('Evaluation Method')
                    ->options([
                        EvaluationMethod::HandsOn->value => 'Hands-on Physical Lab Test',
                        EvaluationMethod::OnlineResearch->value => 'Rigorous Online Specification Research',
                        EvaluationMethod::Hybrid->value => 'Hybrid (Physical Sample + Technical Spec Audit)',
                    ])
                    ->default(EvaluationMethod::OnlineResearch->value)
                    ->required(),

                TextInput::make('overall_score')
                    ->label('Overall Curation Score (0.0 – 10.0)')
                    ->numeric()
                    ->minValue(0.0)
                    ->maxValue(10.0)
                    ->step(0.1)
                    ->required(),

                TextInput::make('utility_score')
                    ->label('Utility / Functional Core (0.0 – 10.0)')
                    ->numeric()
                    ->minValue(0.0)
                    ->maxValue(10.0)
                    ->step(0.1)
                    ->required(),

                TextInput::make('durability_score')
                    ->label('Durability & Engineering (0.0 – 10.0)')
                    ->numeric()
                    ->minValue(0.0)
                    ->maxValue(10.0)
                    ->step(0.1)
                    ->required(),

                TextInput::make('ergonomics_score')
                    ->label('Ergonomics & Human Factors (0.0 – 10.0)')
                    ->numeric()
                    ->minValue(0.0)
                    ->maxValue(10.0)
                    ->step(0.1)
                    ->required(),

                TextInput::make('value_score')
                    ->label('Value Proposition & Cost-per-Day (0.0 – 10.0)')
                    ->numeric()
                    ->minValue(0.0)
                    ->maxValue(10.0)
                    ->step(0.1)
                    ->required(),

                TextInput::make('repairability_score')
                    ->label('Repairability / Longevity (0.0 – 10.0)')
                    ->numeric()
                    ->minValue(0.0)
                    ->maxValue(10.0)
                    ->step(0.1),

                DatePicker::make('tested_at')
                    ->label('Test / Verification Date')
                    ->default(now()),

                Textarea::make('editorial_verdict')
                    ->label('Editorial Summary Verdict')
                    ->rows(3)
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

                TextColumn::make('overall_score')
                    ->label('Overall')
                    ->badge()
                    ->color(fn (string $state): string => match (true) {
                        (float) $state >= 9.0 => 'success',
                        (float) $state >= 8.0 => 'info',
                        default => 'warning',
                    })
                    ->sortable(),

                TextColumn::make('utility_score')
                    ->label('Utility')
                    ->sortable(),

                TextColumn::make('durability_score')
                    ->label('Durability')
                    ->sortable(),

                TextColumn::make('value_score')
                    ->label('Value')
                    ->sortable(),

                TextColumn::make('evaluation_method')
                    ->label('Method')
                    ->badge(),

                TextColumn::make('tested_at')
                    ->label('Date')
                    ->date('M Y')
                    ->sortable(),
            ])
            ->defaultSort('overall_score', 'desc')
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
            'index' => ManageCurationScores::route('/'),
        ];
    }
}
