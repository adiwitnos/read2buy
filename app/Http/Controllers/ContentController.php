<?php

namespace App\Http\Controllers;

use App\Enums\ContentType;
use App\Enums\ProductTier;
use App\Models\Content;
use Illuminate\Contracts\View\View;

class ContentController extends Controller
{
    /**
     * Display list of practical buying and decision guides.
     */
    public function guides(): View
    {
        $guides = Content::query()
            ->guides()
            ->published()
            ->with(['category'])
            ->latest('published_at')
            ->paginate(9);

        return view('content.guides', [
            'guides' => $guides,
        ]);
    }

    /**
     * Display a specific buying guide with Essentials / Select / Signature tiers.
     */
    public function guide(string $slug): View
    {
        $guide = Content::query()
            ->where('slug', $slug)
            ->where('type', ContentType::Guide)
            ->published()
            ->with([
                'category',
                'products' => function ($query): void {
                    $query->published()
                        ->with([
                            'primaryResearchNote',
                            'primaryAffiliateOffer' => function ($offerQuery): void {
                                $offerQuery->with('program');
                            },
                        ]);
                },
            ])
            ->firstOrFail();

        // Group curated products by tier (Essentials, Select, Signature)
        $tieredProducts = [
            'essentials' => $guide->products->filter(fn ($p) => ($p->pivot->tier instanceof ProductTier ? $p->pivot->tier->value : $p->pivot->tier) === 'essentials'),
            'select' => $guide->products->filter(fn ($p) => ($p->pivot->tier instanceof ProductTier ? $p->pivot->tier->value : $p->pivot->tier) === 'select'),
            'signature' => $guide->products->filter(fn ($p) => ($p->pivot->tier instanceof ProductTier ? $p->pivot->tier->value : $p->pivot->tier) === 'signature'),
        ];

        $relatedGuides = Content::query()
            ->where('id', '!=', $guide->id)
            ->where('type', ContentType::Guide)
            ->published()
            ->take(3)
            ->get();

        return view('content.guide', [
            'guide' => $guide,
            'tieredProducts' => $tieredProducts,
            'relatedGuides' => $relatedGuides,
        ]);
    }

    /**
     * Display list of story-led editorial series.
     */
    public function stories(): View
    {
        $stories = Content::query()
            ->stories()
            ->published()
            ->with(['category'])
            ->latest('published_at')
            ->paginate(9);

        return view('content.stories', [
            'stories' => $stories,
        ]);
    }

    /**
     * Display a specific human story chapter with natural curated recommendations.
     */
    public function story(string $slug): View
    {
        $story = Content::query()
            ->where('slug', $slug)
            ->where('type', ContentType::Story)
            ->published()
            ->with([
                'category',
                'products' => function ($query): void {
                    $query->published()
                        ->with([
                            'primaryResearchNote',
                            'primaryAffiliateOffer' => function ($offerQuery): void {
                                $offerQuery->with('program');
                            },
                        ]);
                },
            ])
            ->firstOrFail();

        $relatedStories = Content::query()
            ->where('id', '!=', $story->id)
            ->where('type', ContentType::Story)
            ->published()
            ->take(3)
            ->get();

        return view('content.story', [
            'story' => $story,
            'relatedStories' => $relatedStories,
        ]);
    }
}
