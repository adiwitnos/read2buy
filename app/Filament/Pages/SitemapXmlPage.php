<?php

namespace App\Filament\Pages;

use App\Enums\ContentStatus;
use App\Enums\ContentType;
use App\Models\Content;
use App\Models\Product;
use BackedEnum;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;

class SitemapXmlPage extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedGlobeAlt;

    protected static ?string $navigationLabel = 'XML Sitemap';

    protected static ?string $title = 'XML Sitemap';

    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.pages.sitemap-xml-page';

    public int $totalProducts = 0;

    public int $totalBlogs = 0;

    public int $totalGuides = 0;

    public int $totalStories = 0;

    public int $totalStaticPages = 13;

    public string $sitemapUrl = '';

    public function mount(): void
    {
        $this->sitemapUrl = url('/sitemap.xml');
        $this->totalProducts = Product::where('is_active', true)->count();
        $this->totalBlogs = Content::where('type', ContentType::Blog)->where('status', ContentStatus::Published)->count();
        $this->totalGuides = Content::where('type', ContentType::Guide)->where('status', ContentStatus::Published)->count();
        $this->totalStories = Content::where('type', ContentType::Story)->where('status', ContentStatus::Published)->count();
    }

    public function pingSearchEngines(): void
    {
        Notification::make()
            ->title('XML Sitemap Ready for Search Bot Crawling')
            ->body('Sitemap accessible at: '.$this->sitemapUrl)
            ->success()
            ->send();
    }
}
