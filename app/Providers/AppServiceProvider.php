<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::shouldBeStrict(! app()->isProduction());

        if (app()->isProduction()) {
            URL::forceScheme('https');
        }

        View::composer('*', function ($view): void {
            $settings = [
                'site_name' => SiteSetting::get('site_name', 'Read2Buy.com') ?? 'Read2Buy.com',
                'site_slogan' => SiteSetting::get('site_slogan', 'Curated Selections for Conscious Decisions') ?? 'Curated Selections for Conscious Decisions',
                'hero_headline' => SiteSetting::get('hero_headline', 'Read before you buy.') ?? 'Read before you buy.',
                'hero_description' => SiteSetting::get('hero_description', 'Not a superficial rankings board, but an independent research desk. We dissect verified strengths, hidden limitations, and real-world trade-offs (Essentials, Select, Signature) so you can make informed, confident choices.') ?? 'Not a superficial rankings board, but an independent research desk. We dissect verified strengths, hidden limitations, and real-world trade-offs (Essentials, Select, Signature) so you can make informed, confident choices.',
                'contact_email' => SiteSetting::get('contact_email', 'editorial@read2buy.com') ?? 'editorial@read2buy.com',
                'contact_whatsapp' => SiteSetting::get('contact_whatsapp', '+1-800-READ2BUY') ?? '+1-800-READ2BUY',
                'editorial_statement' => SiteSetting::get('editorial_statement', 'Independent curation based on rigorous engineering research without paid placements.') ?? 'Independent curation based on rigorous engineering research without paid placements.',
                'ga_id' => SiteSetting::get('tracking_ga_id'),
                'meta_pixel_id' => SiteSetting::get('tracking_meta_pixel_id'),
                'gtm_id' => SiteSetting::get('tracking_gtm_id'),
                'custom_head' => SiteSetting::get('tracking_custom_head'),
                'custom_body' => SiteSetting::get('tracking_custom_body'),
            ];

            $view->with('siteSettings', $settings);
        });
    }
}
