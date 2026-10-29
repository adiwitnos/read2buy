<?php

namespace App\Http\Controllers;

use App\Enums\ContentStatus;
use App\Models\Category;
use App\Models\Content;
use App\Models\Product;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * Generate standard XML sitemap for SEO, AEO, and GEO search bots.
     */
    public function index(): Response
    {
        $products = Product::where('is_active', true)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('updated_at')
            ->get(['slug', 'updated_at']);

        $contents = Content::where('status', ContentStatus::Published)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('updated_at')
            ->get(['slug', 'type', 'updated_at']);

        $categories = Category::where('is_active', true)
            ->latest('updated_at')
            ->get(['slug', 'updated_at']);

        $staticPages = [
            route('home'),
            route('content.guides'),
            route('content.stories'),
            route('blog.index'),
            route('showroom.curation-standards'),
            route('faq'),
            route('about.us'),
            route('legal.editorial-policy'),
            route('legal.affiliate-disclosure'),
            route('legal.disclaimer'),
            route('legal.privacy-policy'),
            route('legal.terms'),
            route('contact'),
        ];

        $xml = view('sitemap.index', [
            'products' => $products,
            'contents' => $contents,
            'categories' => $categories,
            'staticPages' => $staticPages,
        ])->render();

        return response($xml, 200)
            ->header('Content-Type', 'text/xml');
    }
}
