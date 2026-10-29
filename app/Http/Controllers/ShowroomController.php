<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Collection;
use App\Models\Content;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShowroomController extends Controller
{
    /**
     * Display the curated life choices homepage (Versi 2.2).
     */
    public function index(Request $request): View
    {
        $searchQuery = trim((string) $request->input('q', ''));

        $latestGuides = Content::query()
            ->guides()
            ->published()
            ->with(['category'])
            ->latest('published_at')
            ->take(3)
            ->get();

        $latestStories = Content::query()
            ->stories()
            ->published()
            ->with(['category'])
            ->latest('published_at')
            ->take(2)
            ->get();

        $featuredCollections = Collection::query()
            ->active()
            ->featured()
            ->orderBy('sort_order')
            ->withCount(['products' => function ($query): void {
                $query->active();
            }])
            ->get();

        $curatedProductsQuery = Product::query()
            ->published()
            ->with([
                'category',
                'collection',
                'curationScore',
                'primaryResearchNote',
                'primaryAffiliateOffer',
            ]);

        if ($searchQuery !== '') {
            $curatedProductsQuery->where(function ($query) use ($searchQuery): void {
                $query->where('name', 'like', "%{$searchQuery}%")
                    ->orWhere('brand', 'like', "%{$searchQuery}%")
                    ->orWhere('tagline', 'like', "%{$searchQuery}%");
            });
            $curatedProducts = $curatedProductsQuery->latest('published_at')->get();
        } else {
            $curatedProducts = $curatedProductsQuery->latest('published_at')->take(6)->get();
        }

        $categories = Category::query()
            ->active()
            ->orderBy('sort_order')
            ->withCount(['products' => function ($query): void {
                $query->active();
            }])
            ->get();

        $selectedCategorySlug = trim((string) $request->input('category', $request->input('kategori', '')));

        $comparisonCategories = Category::query()
            ->active()
            ->whereHas('products', function ($query): void {
                $query->published();
            })
            ->withCount(['products' => function ($query): void {
                $query->published();
            }])
            ->orderBy('sort_order')
            ->get();

        $activeComparisonCategory = null;
        if ($selectedCategorySlug !== '') {
            $activeComparisonCategory = $comparisonCategories->firstWhere('slug', $selectedCategorySlug);
        }

        if (! $activeComparisonCategory && $comparisonCategories->isNotEmpty()) {
            $activeComparisonCategory = $comparisonCategories->firstWhere('products_count', '>=', 2)
                ?? $comparisonCategories->first();
        }

        $comparisonProducts = collect();
        if ($activeComparisonCategory) {
            $comparisonProducts = Product::query()
                ->where('category_id', $activeComparisonCategory->id)
                ->published()
                ->with([
                    'category',
                    'collection',
                    'curationScore',
                    'primaryResearchNote',
                    'primaryAffiliateOffer',
                ])
                ->take(4)
                ->get();
        }

        return view('showroom.index', [
            'latestGuides' => $latestGuides,
            'latestStories' => $latestStories,
            'featuredCollections' => $featuredCollections,
            'curatedProducts' => $curatedProducts,
            'categories' => $categories,
            'comparisonCategories' => $comparisonCategories,
            'activeComparisonCategory' => $activeComparisonCategory,
            'comparisonProducts' => $comparisonProducts,
            'searchQuery' => $searchQuery,
        ]);
    }

    /**
     * Display a specific curated collection showroom.
     */
    public function collection(string $slug): View
    {
        $collection = Collection::query()
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        $products = $collection->products()
            ->published()
            ->with([
                'category',
                'curationScore',
                'primaryAffiliateOffer',
            ])
            ->latest('published_at')
            ->get();

        return view('showroom.collection', [
            'collection' => $collection,
            'products' => $products,
        ]);
    }

    /**
     * Display a single curated product with The Read2Buy Standard scorecard.
     */
    public function product(string $slug): View
    {
        $product = Product::query()
            ->where('slug', $slug)
            ->published()
            ->with([
                'category',
                'collection',
                'curationScore',
                'primaryResearchNote',
                'affiliateOffers' => function ($query): void {
                    $query->active()->orderByDesc('is_primary');
                },
                'reviews' => function ($query): void {
                    $query->published();
                },
            ])
            ->firstOrFail();

        $relatedProducts = Product::query()
            ->where('id', '!=', $product->id)
            ->where(function ($query) use ($product): void {
                $query->where('category_id', $product->category_id);
                if ($product->collection_id !== null) {
                    $query->orWhere('collection_id', $product->collection_id);
                }
            })
            ->published()
            ->with(['curationScore', 'primaryAffiliateOffer'])
            ->take(3)
            ->get();

        return view('showroom.product', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }

    /**
     * Display The Read2Buy Standard methodology and philosophy.
     */
    public function philosophy(): View
    {
        return view('showroom.philosophy');
    }

    /**
     * Display editorial identity and about page (Versi 2.2).
     */
    public function about(): View
    {
        return view('showroom.about');
    }

    /**
     * Display curated buying guides list.
     */
    public function guides(): View
    {
        $featuredCollection = Collection::query()
            ->where('slug', 'the-focused-professional')
            ->first();

        return view('showroom.guides', [
            'featuredCollection' => $featuredCollection,
        ]);
    }
}
