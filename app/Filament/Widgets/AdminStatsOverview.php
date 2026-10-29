<?php

namespace App\Filament\Widgets;

use App\Enums\ContentStatus;
use App\Enums\ContentType;
use App\Enums\ProgramStatus;
use App\Models\AffiliateProgram;
use App\Models\Content;
use App\Models\Product;
use App\Models\SiteSetting;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsOverview extends StatsOverviewWidget
{
    protected static ?bool $isLazyLoaded = false;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $publishedBlogs = Content::where('type', ContentType::Blog)->where('status', ContentStatus::Published)->count();
        $draftBlogs = Content::where('type', ContentType::Blog)->where('status', ContentStatus::Draft)->count();
        $activeProducts = Product::where('is_active', true)->count();
        $activePrograms = AffiliateProgram::where('status', ProgramStatus::Active)->count();

        $gaId = SiteSetting::get('tracking_ga_id');
        $metaPixelId = SiteSetting::get('tracking_meta_pixel_id');
        $hasTracking = ! empty($gaId) || ! empty($metaPixelId);

        $totalSitemapUrls = $activeProducts
            + Content::where('status', ContentStatus::Published)->count()
            + 13; // Static & institutional pages

        return [
            Stat::make('Research & Blog Articles', (string) $publishedBlogs)
                ->description($draftBlogs > 0 ? "{$draftBlogs} drafts saved" : 'All articles live')
                ->descriptionIcon(Heroicon::OutlinedDocumentText)
                ->color('primary')
                ->url(url('/admin/contents')),

            Stat::make('Curated Products', (string) $activeProducts)
                ->description('Active curated selections')
                ->descriptionIcon(Heroicon::OutlinedSparkles)
                ->color('success')
                ->url(url('/')),

            Stat::make('XML Sitemap', (string) $totalSitemapUrls.' URLs')
                ->description('Indexed for Google & AI search')
                ->descriptionIcon(Heroicon::OutlinedGlobeAlt)
                ->color('info')
                ->url(url('/admin/sitemap-xml-page')),

            Stat::make('Tracking & Pixels', $hasTracking ? 'Active' : 'Unconfigured')
                ->description($hasTracking ? 'GA4 & Meta Pixel active' : 'Click to configure scripts')
                ->descriptionIcon(Heroicon::OutlinedCodeBracketSquare)
                ->color($hasTracking ? 'success' : 'warning')
                ->url(url('/admin/tracking-scripts-page')),
        ];
    }
}
