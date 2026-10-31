<?php

namespace App\Filament\Resources\AffiliateOffers;

use App\Enums\AffiliatePlatform;
use App\Filament\Resources\AffiliateOffers\Pages\ManageAffiliateOffers;
use App\Models\AffiliateOffer;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AffiliateOfferResource extends Resource
{
    protected static ?string $model = AffiliateOffer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShoppingCart;

    protected static ?string $navigationLabel = 'Affiliate Offers';

    protected static ?string $modelLabel = 'Affiliate Offer';

    protected static ?string $pluralModelLabel = 'Affiliate Offers';

    protected static ?int $navigationSort = 1;

    protected static ?string $recordTitleAttribute = 'seller_name';

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

                Select::make('affiliate_program_id')
                    ->label('Affiliate Program (Optional)')
                    ->relationship('program', 'name')
                    ->searchable()
                    ->preload(),

                Select::make('platform')
                    ->label('Platform')
                    ->options([
                        AffiliatePlatform::Amazon->value => 'Amazon Associates',
                        AffiliatePlatform::Shopee->value => 'Shopee Affiliate',
                        AffiliatePlatform::Tokopedia->value => 'Tokopedia Affiliate',
                        AffiliatePlatform::Direct->value => 'Direct Brand Store',
                        AffiliatePlatform::Custom->value => 'Other Verified Merchant',
                    ])
                    ->default(AffiliatePlatform::Amazon->value)
                    ->required(),

                TextInput::make('seller_name')
                    ->label('Seller / Store Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('seller_badge')
                    ->label('Seller Badge (e.g. Official Partner, Top Rated)')
                    ->maxLength(255),

                TextInput::make('price')
                    ->label('Price ($)')
                    ->numeric(),

                TextInput::make('original_price')
                    ->label('Original / List Price ($)')
                    ->numeric(),

                TextInput::make('affiliate_url')
                    ->label('Affiliate Destination URL')
                    ->url()
                    ->required()
                    ->columnSpanFull(),

                Toggle::make('is_primary')
                    ->label('Primary / Recommended Offer')
                    ->default(false),

                Toggle::make('is_active')
                    ->label('Active for Public Redirect')
                    ->default(true),

                DateTimePicker::make('last_checked_at')
                    ->label('Last Checked / Verified At')
                    ->default(now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('seller_name')
            ->columns([
                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('seller_name')
                    ->label('Seller / Merchant')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('platform')
                    ->label('Platform')
                    ->badge(),

                TextColumn::make('price')
                    ->label('Price ($)')
                    ->money('USD')
                    ->sortable(),

                IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean(),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Updated')
                    ->dateTime('M d, Y')
                    ->sortable(),
            ])
            ->defaultSort('updated_at', 'desc')
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
            'index' => ManageAffiliateOffers::route('/'),
        ];
    }
}
