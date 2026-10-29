<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Product;
use App\Models\ProductBookmark;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display member dashboard for managing bookmarked affiliate products and exploring curated content.
     */
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = $request->user();

        $tab = (string) $request->query('tab', 'bookmarks');
        if ($tab === 'panduan') {
            $tab = 'guides';
        } elseif ($tab === 'cerita') {
            $tab = 'stories';
        }

        if (! in_array($tab, ['bookmarks', 'showroom', 'guides', 'stories'], true)) {
            $tab = 'bookmarks';
        }

        $bookmarks = ProductBookmark::with([
            'product.category',
            'product.primaryOffer.program',
            'product.researchNotes',
            'product.contentProducts',
        ])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $showroomProducts = null;
        $guides = null;
        $stories = null;

        if ($tab === 'showroom') {
            $showroomProducts = Product::query()
                ->published()
                ->with([
                    'category',
                    'collection',
                    'curationScore',
                    'primaryResearchNote',
                    'primaryAffiliateOffer.program',
                ])
                ->latest('published_at')
                ->paginate(12)
                ->withQueryString();
        } elseif ($tab === 'guides' || $tab === 'panduan') {
            $guides = Content::query()
                ->guides()
                ->published()
                ->with(['category'])
                ->latest('published_at')
                ->paginate(9)
                ->withQueryString();
        } elseif ($tab === 'stories' || $tab === 'cerita') {
            $stories = Content::query()
                ->stories()
                ->published()
                ->with(['category'])
                ->latest('published_at')
                ->paginate(9)
                ->withQueryString();
        }

        return view('dashboard', [
            'user' => $user,
            'isAdmin' => $user->isAdmin(),
            'activeTab' => $tab,
            'bookmarks' => $bookmarks,
            'totalBookmarks' => $bookmarks->count(),
            'showroomProducts' => $showroomProducts,
            'guides' => $guides,
            'stories' => $stories,
        ]);
    }
}
