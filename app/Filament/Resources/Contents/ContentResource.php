<?php

namespace App\Filament\Resources\Contents;

use App\Enums\ContentStatus;
use App\Enums\ContentType;
use App\Enums\ProductTier;
use App\Filament\Resources\Contents\Pages\ManageContents;
use App\Models\Content;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ContentResource extends Resource
{
    protected static ?string $model = Content::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedDocumentText;

    protected static ?string $navigationLabel = 'Articles & Guides';

    protected static ?string $modelLabel = 'Article & Guide';

    protected static ?string $pluralModelLabel = 'Articles & Guides';

    protected static ?int $navigationSort = 2;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Article Title')
                    ->required()
                    ->maxLength(255),

                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->maxLength(255),

                Select::make('category_id')
                    ->label('Category')
                    ->relationship('category', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),

                Select::make('type')
                    ->label('Content Type')
                    ->options([
                        ContentType::Blog->value => 'Research Article & Blog (SEO/AEO/GEO)',
                        ContentType::Guide->value => 'Practical Buying Guide',
                        ContentType::Story->value => 'Consumer Story Series',
                    ])
                    ->default(ContentType::Blog->value)
                    ->required(),

                Select::make('status')
                    ->label('Publication Status')
                    ->options([
                        ContentStatus::Draft->value => 'Draft',
                        ContentStatus::Published->value => 'Published',
                        ContentStatus::Archived->value => 'Archived',
                    ])
                    ->default(ContentStatus::Published->value)
                    ->required(),

                TextInput::make('headline')
                    ->label('Short Headline')
                    ->maxLength(255),

                TextInput::make('reading_time_minutes')
                    ->label('Estimated Reading Time (Minutes)')
                    ->numeric()
                    ->default(5),

                DateTimePicker::make('published_at')
                    ->label('Publication Date')
                    ->default(now()),

                Textarea::make('excerpt')
                    ->label('Excerpt (AEO Direct Answer)')
                    ->rows(3)
                    ->helperText('Dense 2-3 sentence direct answer to core question for Google AI & search answer engines.'),

                Textarea::make('body')
                    ->label('Article Body (Markdown / HTML)')
                    ->rows(10)
                    ->required(),

                Repeater::make('contentProducts')
                    ->label('Curated Products Featured in This Guide / Story')
                    ->relationship('contentProducts')
                    ->schema([
                        Select::make('product_id')
                            ->label('Product')
                            ->relationship('product', 'name')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Select::make('tier')
                            ->label('Curation Tier')
                            ->options([
                                ProductTier::Essentials->value => 'Essentials (Budget / Accessible)',
                                ProductTier::Select->value => 'Select (Optimal Daily Balance)',
                                ProductTier::Signature->value => 'Signature (Uncompromising Capability)',
                            ])
                            ->default(ProductTier::Select->value)
                            ->required(),

                        TextInput::make('curation_reason')
                            ->label('Why this was curated')
                            ->placeholder('e.g. Best price-to-durability ratio')
                            ->required(),

                        TextInput::make('context_headline')
                            ->label('Context Headline (Optional)')
                            ->placeholder('e.g. The Everyday Standard'),

                        TextInput::make('sort_order')
                            ->label('Sort Order')
                            ->numeric()
                            ->default(1),
                    ])
                    ->columnSpanFull()
                    ->collapsible(),

                TextInput::make('meta_title')
                    ->label('SEO Meta Title')
                    ->maxLength(255),

                Textarea::make('meta_description')
                    ->label('SEO Meta Description')
                    ->rows(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Title')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable(),

                TextColumn::make('type')
                    ->label('Type')
                    ->badge(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge(),

                TextColumn::make('published_at')
                    ->label('Published')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
            ])
            ->filters([
                //
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
            'index' => ManageContents::route('/'),
        ];
    }
}
