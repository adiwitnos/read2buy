@extends('layouts.app')

@php
    $currentTab = $activeTab ?? 'bookmarks';
    $tabTitle = match($currentTab) {
        'showroom' => 'Explore Showroom',
        'guides', 'panduan' => 'Buying Guides',
        'stories', 'cerita' => 'Consumer Stories',
        default => 'Bookmarked Products',
    };
@endphp

@section('title', 'Member Dashboard — ' . $tabTitle)
@section('meta_description', 'Manage saved curated products, browse showroom collections, and explore buying guides and consumer stories on Read2Buy.')

@section('content')
<div class="bg-[#faf8f5] min-h-[calc(100vh-160px)] py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
        @if($currentTab === 'showroom')
            <!-- Tab: Explore Showroom -->
            <div class="bg-white rounded-xl border border-stone-200/80 p-6 sm:p-8 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-amber-900 bg-amber-100 px-2 py-0.5 rounded border border-amber-200 mb-2">
                        Showroom Curation
                    </span>
                    <h1 class="font-serif-editorial text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">
                        Explore Showroom
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-stone-600 max-w-xl">
                        Curated instruments audited through independent research and zero-paid review methodologies.
                    </p>
                </div>

                <a href="{{ route('home') }}" class="px-4 py-2.5 bg-stone-100 text-stone-800 rounded-lg text-xs uppercase font-semibold tracking-wider hover:bg-stone-200 transition-colors border border-stone-200 shrink-0 self-start sm:self-center">
                    Open Public Showroom &rarr;
                </a>
            </div>

            @if($showroomProducts && $showroomProducts->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    @foreach($showroomProducts as $product)
                        <x-product-card :product="$product" />
                    @endforeach
                </div>

                @if($showroomProducts->hasPages())
                    <div class="pt-4">
                        {{ $showroomProducts->links() }}
                    </div>
                @endif
            @else
                <div class="bg-white rounded-xl border border-stone-200/80 p-12 text-center shadow-xs space-y-3">
                    <p class="text-stone-500 font-light text-sm">No curated products available in this view yet.</p>
                </div>
            @endif

        @elseif($currentTab === 'guides' || $currentTab === 'panduan')
            <!-- Tab: Buying Guides -->
            <div class="bg-white rounded-xl border border-stone-200/80 p-6 sm:p-8 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-amber-900 bg-amber-100 px-2 py-0.5 rounded border border-amber-200 mb-2">
                        Problem-Led Architecture
                    </span>
                    <h1 class="font-serif-editorial text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">
                        Practical Buying Guides
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-stone-600 max-w-xl">
                        Clear, measured teardowns to inform rational purchasing across Essentials, Select, and Signature tiers.
                    </p>
                </div>

                <a href="{{ route('content.guides') }}" class="px-4 py-2.5 bg-stone-100 text-stone-800 rounded-lg text-xs uppercase font-semibold tracking-wider hover:bg-stone-200 transition-colors border border-stone-200 shrink-0 self-start sm:self-center">
                    Open Public Guides &rarr;
                </a>
            </div>

            @if($guides && $guides->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($guides as $guide)
                        <article class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-xs hover:shadow-md hover:border-stone-300 transition-all flex flex-col justify-between">
                            <div class="p-6 space-y-3">
                                <div class="flex items-center justify-between text-xs">
                                    @if($guide->category)
                                        <span class="text-[10px] uppercase tracking-wider font-semibold text-stone-500 bg-stone-100 px-2 py-0.5 rounded">
                                            {{ $guide->category->name }}
                                        </span>
                                    @endif
                                    <span class="text-stone-400 font-mono text-[11px]">{{ $guide->reading_time_minutes }} min read</span>
                                </div>

                                <h3 class="font-serif-editorial text-lg font-bold text-stone-900 hover:text-stone-700 transition-colors leading-snug">
                                    <a href="{{ route('content.guide', $guide->slug) }}">
                                        {{ $guide->title }}
                                    </a>
                                </h3>

                                @if($guide->excerpt)
                                    <p class="text-xs text-stone-600 line-clamp-3 leading-relaxed">
                                        {{ $guide->excerpt }}
                                    </p>
                                @endif
                            </div>

                            <div class="p-5 pt-0 border-t border-stone-100 mt-2 flex items-center justify-between">
                                <span class="text-[11px] text-stone-400">
                                    {{ $guide->published_at ? $guide->published_at->format('M d, Y') : 'Draft' }}
                                </span>
                                <a href="{{ route('content.guide', $guide->slug) }}" class="inline-flex items-center gap-1 text-xs uppercase font-semibold text-stone-900 hover:text-stone-600 transition-colors">
                                    <span>Read Guide</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if($guides->hasPages())
                    <div class="pt-4">
                        {{ $guides->links() }}
                    </div>
                @endif
            @else
                <div class="bg-white rounded-xl border border-stone-200/80 p-12 text-center shadow-xs space-y-3">
                    <p class="text-stone-500 font-light text-sm">No buying guides published yet.</p>
                </div>
            @endif

        @elseif($currentTab === 'stories' || $currentTab === 'cerita')
            <!-- Tab: Consumer Stories -->
            <div class="bg-white rounded-xl border border-stone-200/80 p-6 sm:p-8 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-amber-900 bg-amber-100 px-2 py-0.5 rounded border border-amber-200 mb-2">
                        Story-Led Architecture
                    </span>
                    <h1 class="font-serif-editorial text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">
                        Consumer Stories
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-stone-600 max-w-xl">
                        Human narrative case studies examining real-world workspaces, study routines, and entrepreneurial setups.
                    </p>
                </div>

                <a href="{{ route('content.stories') }}" class="px-4 py-2.5 bg-stone-100 text-stone-800 rounded-lg text-xs uppercase font-semibold tracking-wider hover:bg-stone-200 transition-colors border border-stone-200 shrink-0 self-start sm:self-center">
                    Open Public Stories &rarr;
                </a>
            </div>

            @if($stories && $stories->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($stories as $story)
                        <article class="bg-white rounded-xl border border-stone-200/80 overflow-hidden shadow-xs hover:shadow-md hover:border-stone-300 transition-all flex flex-col justify-between">
                            <div class="p-6 space-y-3">
                                <div class="flex items-center justify-between text-xs">
                                    <span class="text-[10px] uppercase font-bold tracking-widest text-amber-800 bg-amber-50 px-2 py-0.5 rounded border border-amber-200">
                                        Narrative Series
                                    </span>
                                    <span class="text-stone-400 font-mono text-[11px]">{{ $story->reading_time_minutes }} min read</span>
                                </div>

                                <h3 class="font-serif-editorial text-xl font-bold text-stone-900 hover:text-stone-700 transition-colors leading-snug">
                                    <a href="{{ route('content.story', $story->slug) }}">
                                        {{ $story->title }}
                                    </a>
                                </h3>

                                @if($story->excerpt)
                                    <p class="text-xs text-stone-600 line-clamp-3 leading-relaxed font-light">
                                        {{ $story->excerpt }}
                                    </p>
                                @endif
                            </div>

                            <div class="p-5 pt-0 border-t border-stone-100 mt-2 flex items-center justify-between">
                                <span class="text-[11px] text-stone-400">
                                    {{ $story->published_at ? $story->published_at->format('M d, Y') : 'Draft' }}
                                </span>
                                <a href="{{ route('content.story', $story->slug) }}" class="inline-flex items-center gap-1.5 text-xs uppercase font-semibold text-stone-900 hover:text-stone-600 transition-colors">
                                    <span>Read Story</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if($stories->hasPages())
                    <div class="pt-4">
                        {{ $stories->links() }}
                    </div>
                @endif
            @else
                <div class="bg-white rounded-xl border border-stone-200/80 p-12 text-center shadow-xs space-y-3">
                    <p class="text-stone-500 font-light text-sm">No consumer stories published yet.</p>
                </div>
            @endif

        @else
            <!-- Tab: Bookmarked Products -->
            <div class="bg-white rounded-xl border border-stone-200/80 p-6 sm:p-8 shadow-xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div>
                    <span class="inline-flex items-center gap-1.5 text-[10px] font-bold uppercase tracking-widest text-amber-900 bg-amber-100 px-2 py-0.5 rounded border border-amber-200 mb-2">
                        Personal Collection
                    </span>
                    <h1 class="font-serif-editorial text-2xl sm:text-3xl font-bold text-stone-900 tracking-tight">
                        Bookmarked Products
                    </h1>
                    <p class="mt-1 text-xs sm:text-sm text-stone-600 max-w-xl">
                        Your saved curated instruments for side-by-side trade-off benchmarking and direct verified store access.
                    </p>
                </div>

                <a href="{{ route('dashboard', ['tab' => 'showroom']) }}" class="px-4 py-2.5 bg-stone-900 text-white rounded-lg text-xs uppercase font-semibold tracking-wider hover:bg-stone-800 transition-colors shadow-xs shrink-0 self-start sm:self-center">
                    + Explore Products
                </a>
            </div>

            <!-- Bookmark Items List -->
            @if($bookmarks->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach($bookmarks as $bookmark)
                        @php
                            $product = $bookmark->product;
                            $primaryOffer = $product->primaryOffer;
                            $researchNote = $product->primaryResearchNote ?? $product->researchNotes->first();
                            $prosText = !empty($researchNote?->key_strengths) ? $researchNote->key_strengths[0] : null;
                            $consText = !empty($researchNote?->limitations) ? $researchNote->limitations[0] : null;
                        @endphp

                        <div class="bg-white rounded-xl border border-stone-200/80 p-5 shadow-xs flex flex-col justify-between space-y-4 hover:border-stone-300 transition-all">
                            <div class="space-y-3">
                                <div class="flex items-start justify-between gap-3">
                                    <div>
                                        <span class="text-[10px] font-mono uppercase tracking-wider text-stone-400 block">
                                            {{ $product->category?->name ?? 'Curation' }} &bull; {{ $product->brand }}
                                        </span>
                                        <h3 class="font-serif-editorial text-lg font-bold text-stone-900 mt-0.5 hover:text-amber-900 transition-colors">
                                            <a href="{{ route('showroom.product', $product->slug) }}">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                    </div>

                                    <!-- Delete Bookmark Button -->
                                    <form method="POST" action="{{ route('bookmark.destroy', $bookmark->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Remove from bookmarks" class="p-1.5 rounded-lg text-stone-400 hover:text-red-600 hover:bg-red-50 transition-colors cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>

                                @if($product->tagline)
                                    <p class="text-xs text-stone-600 leading-relaxed italic">
                                        &ldquo;{{ $product->tagline }}&rdquo;
                                    </p>
                                @endif

                                <!-- Pros & Cons Summary -->
                                @if($prosText || $consText)
                                    <div class="p-3 bg-stone-50 rounded-lg border border-stone-200/70 space-y-1.5 text-xs">
                                        @if($prosText)
                                            <div class="text-emerald-900 flex items-start gap-1.5">
                                                <span class="font-bold text-emerald-700 shrink-0">&plus;</span>
                                                <span class="line-clamp-2 leading-relaxed">{{ $prosText }}</span>
                                            </div>
                                        @endif
                                        @if($consText)
                                            <div class="text-stone-700 flex items-start gap-1.5">
                                                <span class="font-bold text-amber-700 shrink-0">&minus;</span>
                                                <span class="line-clamp-2 leading-relaxed">{{ $consText }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Action Buttons -->
                            <div class="pt-3 border-t border-stone-100 flex items-center justify-between gap-3 text-xs">
                                <a href="{{ route('showroom.product', $product->slug) }}" class="text-stone-700 font-semibold hover:text-stone-950 underline">
                                    Open Research Review
                                </a>

                                @if($primaryOffer)
                                    <a 
                                        href="{{ route('affiliate.out', $primaryOffer) }}" 
                                        target="_blank" 
                                        rel="sponsored nofollow" 
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-stone-900 hover:bg-stone-800 text-white font-medium text-[11px] uppercase tracking-wider transition-colors shadow-xs"
                                    >
                                        <span>Visit Retailer ({{ $primaryOffer->seller_name ?? $primaryOffer->program?->name ?? 'Official Store' }})</span>
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl border border-stone-200/80 p-12 text-center shadow-xs space-y-4">
                    <div class="w-14 h-14 mx-auto rounded-full bg-amber-50 text-amber-700 flex items-center justify-center">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                    </div>
                    <h2 class="font-serif-editorial text-xl font-bold text-stone-900">
                        No Saved Products Yet
                    </h2>
                    <p class="text-xs sm:text-sm text-stone-600 max-w-md mx-auto leading-relaxed">
                        Bookmark instruments from our showroom to benchmark trade-offs and specifications before finalizing a purchase.
                    </p>
                    <div class="pt-2">
                        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-stone-900 hover:bg-stone-800 text-white rounded-lg text-xs uppercase tracking-wider font-semibold transition-colors shadow-xs">
                            <span>Explore Showroom Catalog</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
@endsection
