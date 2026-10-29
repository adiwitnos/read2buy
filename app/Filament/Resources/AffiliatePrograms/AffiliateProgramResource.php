<?php

namespace App\Filament\Resources\AffiliatePrograms;

use App\Enums\AffiliatePlatform;
use App\Enums\ProgramStatus;
use App\Filament\Resources\AffiliatePrograms\Pages\ManageAffiliatePrograms;
use App\Models\AffiliateProgram;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AffiliateProgramResource extends Resource
{
    protected static ?string $model = AffiliateProgram::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLink;

    protected static ?string $navigationLabel = 'Affiliate Programs';

    protected static ?string $modelLabel = 'Affiliate Program';

    protected static ?string $pluralModelLabel = 'Affiliate Programs';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Program Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->maxLength(255),

                TextInput::make('network')
                    ->label('Network / Intermediary')
                    ->placeholder('e.g. Amazon Services LLC, Impact, CJ, Direct')
                    ->maxLength(255),

                Select::make('status')
                    ->label('Compliance & Partner Status')
                    ->options([
                        ProgramStatus::Active->value => 'Active & Approved for Outbound Links',
                        ProgramStatus::Pending->value => 'Pending Merchant Application',
                        ProgramStatus::Paused->value => 'Paused / Policy Audit',
                    ])
                    ->default(ProgramStatus::Active->value)
                    ->required(),

                TextInput::make('terms_url')
                    ->label('Official Terms / Portal URL')
                    ->url()
                    ->maxLength(255),

                Textarea::make('commission_rate_notes')
                    ->label('Commission Rates & Category Details')
                    ->rows(2)
                    ->columnSpanFull(),

                Textarea::make('compliance_notes')
                    ->label('Compliance Notes & Channel Restrictions')
                    ->rows(2)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Program')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('network')
                    ->label('Network')
                    ->placeholder('Direct'),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),

                TextColumn::make('offers_count')
                    ->label('Offers')
                    ->counts('offers')
                    ->sortable(),
            ])
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
            'index' => ManageAffiliatePrograms::route('/'),
        ];
    }
}
