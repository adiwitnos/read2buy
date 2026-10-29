<?php

namespace App\Http\Controllers;

use App\Enums\ContentStatus;
use App\Enums\ContentType;
use App\Models\Content;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display listing of published blog and research articles.
     */
    public function index(Request $request): View
    {
        $articles = Content::with(['category', 'products.primaryOffer.program'])
            ->where('type', ContentType::Blog)
            ->where('status', ContentStatus::Published)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->paginate(12);

        return view('content.blog-index', [
            'articles' => $articles,
        ]);
    }

    /**
     * Display a single blog article optimized for SEO, AEO, and GEO.
     */
    public function show(string $slug): View
    {
        $article = Content::with([
            'category',
            'products.primaryOffer.program',
            'products.researchNotes',
            'contentProducts.product.primaryOffer.program',
        ])
            ->where('type', ContentType::Blog)
            ->where('slug', $slug)
            ->where('status', ContentStatus::Published)
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->firstOrFail();

        $relatedArticles = Content::where('type', ContentType::Blog)
            ->where('status', ContentStatus::Published)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('content.blog-show', [
            'article' => $article,
            'relatedArticles' => $relatedArticles,
        ]);
    }
}
