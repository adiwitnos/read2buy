<?php

use App\Http\Controllers\AffiliateRedirectController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ShowroomController;
use App\Http\Controllers\SitemapController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Read2Buy.com Web Routes (Global Curation & Buying Guide Architecture)
|--------------------------------------------------------------------------
| Empowering Conscious Consumer Choices: Problem-led & Research-backed
*/

// Home & Curated Showroom
Route::get('/', [ShowroomController::class, 'index'])->name('home');

// Problem-Led Architecture: In-Depth Buying Guides & Comparison
Route::get('/guides', [ContentController::class, 'guides'])->name('content.guides');
Route::get('/guides/{slug}', [ContentController::class, 'guide'])->name('content.guide');

// Story-Led Architecture: Human Experience & Consumer Stories
Route::get('/stories', [ContentController::class, 'stories'])->name('content.stories');
Route::get('/stories/{slug}', [ContentController::class, 'story'])->name('content.story');

// SEO, AEO, and GEO Knowledge Engine: Blog Articles & Deep Research
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');

// Dynamic XML Sitemap for Search Bots & AI Crawlers
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap.xml');

// Curated Collections
Route::get('/collections/{slug}', [ShowroomController::class, 'collection'])->name('showroom.collection');

// Curated Products & Scorecards
Route::get('/products/{slug}', [ShowroomController::class, 'product'])->name('showroom.product');

// Editorial Philosophy & Curation Standards
Route::get('/curation-standards', [LegalController::class, 'curationStandard'])->name('showroom.curation-standards');
Route::get('/standards', [LegalController::class, 'curationStandard'])->name('showroom.standards');
Route::get('/philosophy', [ShowroomController::class, 'philosophy'])->name('showroom.philosophy');

// Identity & Contact
Route::get('/about', [ShowroomController::class, 'about'])->name('about');
Route::get('/about-us', [ShowroomController::class, 'about'])->name('about.us');
Route::get('/contact', [LegalController::class, 'contact'])->name('contact');

// Information, Policy & Legal Compliance
Route::get('/faq', [LegalController::class, 'faq'])->name('faq');
Route::get('/editorial-policy', [LegalController::class, 'editorialPolicy'])->name('legal.editorial-policy');
Route::get('/affiliate-disclosure', [LegalController::class, 'affiliateDisclosure'])->name('legal.affiliate-disclosure');
Route::get('/affiliate-transparency', [LegalController::class, 'affiliateTransparency'])->name('legal.affiliate-transparency'); // Compatibility alias
Route::get('/disclaimer', [LegalController::class, 'disclaimer'])->name('legal.disclaimer');
Route::get('/privacy-policy', [LegalController::class, 'privacyPolicy'])->name('legal.privacy-policy');
Route::get('/terms', [LegalController::class, 'termsOfService'])->name('legal.terms');

// Outbound Affiliate Routing (Safe internal click logging with rate limiting)
Route::middleware('throttle:60,1')->group(function (): void {
    Route::get('/out/{offer}', [AffiliateRedirectController::class, 'redirect'])->name('affiliate.out');
    Route::get('/affiliate-redirect/{offer}', [AffiliateRedirectController::class, 'redirect'])->name('affiliate.redirect');
});

// Member Bookmark Management
Route::middleware(['auth', 'throttle:60,1'])->group(function (): void {
    Route::post('/bookmark/{product}', [BookmarkController::class, 'toggle'])->name('bookmark.toggle');
    Route::delete('/bookmark/{bookmark}', [BookmarkController::class, 'destroy'])->name('bookmark.destroy');
});

// Member Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

// Authentication Routes
require __DIR__.'/auth.php';
