<?php

namespace App\Filament\Resources\Products;

use App\Filament\Resources\Products\Pages\ManageProducts;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedSparkles;

    protected static ?string $navigationLabel = 'Curated Products';

    protected static ?string $modelLabel = 'Curated Product';

    protected static ?string $pluralModelLabel = 'Curated Products';

    protected static ?int $navigationSort = 0;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Product Name')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->maxLength(255),

                TextInput::make('brand')
                    ->label('Brand / Manufacturer')
                    ->maxLength(255),

                TextInput::make('tagline')
                    ->label('Curator Tagline')
                    ->maxLength(255),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('collection_id')
                    ->label('Collection (Optional)')
                    ->relationship('collection', 'name')
                    ->searchable()
                    ->preload(),

                TextInput::make('estimated_price_min')
                    ->label('Estimated Price Min ($)')
                    ->numeric(),

                TextInput::make('estimated_price_max')
                    ->label('Estimated Price Max ($)')
                    ->numeric(),

                Toggle::make('is_active')
                    ->label('Active in Public Showroom')
                    ->default(true),

                Toggle::make('is_featured')
                    ->label('Featured Highlight')
                    ->default(false),

                DateTimePicker::make('published_at')
                    ->label('Publication Date')
                    ->default(now()),

                TextInput::make('primary_image')
                    ->label('Primary Image URL / Path')
                    ->placeholder('https://images.unsplash.com/... or /images/...')
                    ->maxLength(255)
                    ->columnSpanFull(),

                TagsInput::make('gallery_images')
                    ->label('Gallery Image URLs')
                    ->placeholder('Add image URL')
                    ->columnSpanFull(),

                KeyValue::make('specifications')
                    ->label('Technical Specifications')
                    ->keyLabel('Parameter (e.g. material, weight)')
                    ->valueLabel('Value (e.g. Aluminum, 1.2kg)')
                    ->columnSpanFull(),

                Textarea::make('summary')
                    ->label('Executive Summary (The Read2Buy Perspective)')
                    ->rows(3)
                    ->columnSpanFull()
                    ->required(),

                Textarea::make('description')
                    ->label('Detailed Evaluation & Product Description')
                    ->rows(5)
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')
                    ->label('Product')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('brand')
                    ->label('Brand')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),

                TextColumn::make('collection.name')
                    ->label('Collection')
                    ->placeholder('None')
                    ->sortable(),

                TextColumn::make('estimated_price_min')
                    ->label('Price Range')
                    ->formatStateUsing(function ($state, Product $record): string {
                        $min = $record->estimated_price_min;
                        $max = $record->estimated_price_max;
                        if ($min && $max) {
                            return '$'.number_format($min, 2).' – $'.number_format($max, 2);
                        } elseif ($min) {
                            return 'From $'.number_format($min, 2);
                        }

                        return '—';
                    }),

                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),

                TextColumn::make('published_at')
                    ->label('Published')
                    ->date('M d, Y')
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
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
            'index' => ManageProducts::route('/'),
        ];
    }
}
