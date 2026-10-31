<?php

namespace App\Filament\Resources\OutboundClicks;

use App\Filament\Resources\OutboundClicks\Pages\ManageOutboundClicks;
use App\Models\OutboundClick;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OutboundClickResource extends Resource
{
    protected static ?string $model = OutboundClick::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCursorArrowRays;

    protected static ?string $navigationLabel = 'Outbound Click Logs';

    protected static ?string $modelLabel = 'Outbound Click';

    protected static ?string $pluralModelLabel = 'Outbound Clicks';

    protected static ?int $navigationSort = 4;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('platform')->disabled(),
                TextInput::make('ip_address')->disabled(),
                TextInput::make('user_agent')->disabled(),
                TextInput::make('referrer')->disabled(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Timestamp')
                    ->dateTime('M d, Y H:i:s')
                    ->sortable(),

                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('offer.seller_name')
                    ->label('Target Merchant')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('platform')
                    ->label('Platform')
                    ->badge(),

                TextColumn::make('ip_address')
                    ->label('IP Address')
                    ->searchable(),

                TextColumn::make('referrer')
                    ->label('Referrer')
                    ->limit(40)
                    ->tooltip(fn ($record): ?string => $record->referrer),
            ])
            ->defaultSort('created_at', 'desc')
            ->recordActions([
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
            'index' => ManageOutboundClicks::route('/'),
        ];
    }
}
