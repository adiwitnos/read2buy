@extends('layouts.app')

@section('title', 'Read2Buy — Informed Choices for Every Purchase')
@section('meta_description', 'Read before you buy. Research-backed product curation and buying guides.')

@section('content')
@if(!empty($searchQuery))
<section class="bg-amber-50 border-b border-amber-200/80 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-[10px] uppercase font-bold tracking-widest text-amber-900 bg-amber-100 px-2 py-0.5 rounded border border-amber-300">
                Product Search
            </span>
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 mt-1">
                Showing results for: &ldquo;{{ $searchQuery }}&rdquo;
            </h2>
            <p class="text-xs text-stone-600">Found {{ $curatedProducts->count() }} curated instruments matching your query.</p>
        </div>
        <a href="{{ route('home') }}" class="text-xs uppercase font-semibold text-stone-800 hover:text-stone-950 underline shrink-0">
            &times; Clear Search
        </a>
    </div>
</section>
@endif

<!-- Hero Section: Editorial Manifesto -->
<section class="relative bg-white border-b border-stone-200/80 pt-20 pb-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-6">
            <h1 class="font-serif-editorial text-4xl sm:text-6xl font-bold tracking-tight text-stone-900 leading-[1.15]">
                {{ $siteSettings['hero_headline'] ?? 'Read before you buy.' }}
            </h1>

            <p class="text-lg sm:text-xl text-stone-600 leading-relaxed font-light max-w-2xl">
                {!! $siteSettings['hero_description'] ?? 'Not a superficial rankings board, but an <strong>independent research desk</strong>. We dissect verified strengths, hidden limitations, and real-world trade-offs (<strong>Essentials</strong>, <strong>Select</strong>, <strong>Signature</strong>) so you can make informed, confident choices.' !!}
            </p>

            <div class="pt-4 flex flex-wrap items-center gap-4">
                <a href="#komparasi-produk" class="px-6 py-3.5 bg-stone-900 text-white rounded-lg text-xs uppercase tracking-wider font-semibold hover:bg-stone-800 transition-colors shadow-sm">
                    Compare Products Side-by-Side &rarr;
                </a>
                <a href="{{ route('content.guides') }}" class="px-6 py-3.5 bg-stone-100 text-stone-800 rounded-lg text-xs uppercase tracking-wider font-semibold hover:bg-stone-200 transition-colors border border-stone-200">
                    Explore Buying Guides
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Philosophy & Three Pillars of Choice -->
<section class="py-16 bg-[#faf8f5] border-b border-stone-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-6 bg-white rounded-xl border border-stone-200/70 shadow-xs space-y-3">
                <span class="text-xs uppercase font-mono tracking-wider text-emerald-700 font-semibold">01 / Trade-Off Spectrum</span>
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900">No False "Number 1s"</h3>
                <p class="text-sm text-stone-600 leading-relaxed">
                    Every product choice entails compromises. We structure curated options into Essentials (controlled feature compromises), Select (rational daily balance), and Signature (uncompromising capability) without promoting illusory "perfect" items.
                </p>
            </div>

            <div class="p-6 bg-white rounded-xl border border-stone-200/70 shadow-xs space-y-3">
                <span class="text-xs uppercase font-mono tracking-wider text-stone-500 font-semibold">02 / Reality-Check • Unbiased Audits</span>
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900">Dissecting Strengths & Flaws</h3>
                <p class="text-sm text-stone-600 leading-relaxed">
                    Exposing what conventional marketing glosses over. We audit official manufacturer specifications, technical thresholds, and candidly highlight when you shouldn't buy.
                </p>
            </div>

            <div class="p-6 bg-white rounded-xl border border-stone-200/70 shadow-xs space-y-3">
                <span class="text-xs uppercase font-mono tracking-wider text-amber-700 font-semibold">03 / Problem-Led & Story-Led</span>
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900">Dual Decision Gateways</h3>
                <p class="text-sm text-stone-600 leading-relaxed">
                    Direct solutions for real-world dilemmas, coupled with contextual consumer stories that bring authentic clarity to every purchasing decision.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Side-by-side Product Comparison Table per Parameter -->
@if(isset($comparisonProducts) && $comparisonProducts->isNotEmpty() && empty($searchQuery))
    <x-comparison-table
        :products="$comparisonProducts"
        :active-category="$activeComparisonCategory"
        :categories="$comparisonCategories"
    />
@endif

<!-- Problem-Led Spotlight: Practical Buying Guides -->
@if(isset($latestGuides) && $latestGuides->isNotEmpty())
<section class="py-20 bg-white border-b border-stone-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2 max-w-2xl">
                <span class="text-xs uppercase font-bold tracking-widest text-stone-500">
                    Decision Guides
                </span>
                <h2 class="font-serif-editorial text-3xl sm:text-4xl font-bold text-stone-900">
                    Buying Guides & Comparisons
                </h2>
                <p class="text-base text-stone-600 font-light">
                    Direct answers grounded in technical audits and verified cost-of-ownership analysis.
                </p>
            </div>

            <a href="{{ route('content.guides') }}" class="inline-flex items-center gap-1.5 text-xs uppercase tracking-wider font-semibold text-stone-900 hover:text-stone-600 transition-colors">
                <span>View All Guides &rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($latestGuides as $guide)
                <article class="bg-stone-50/60 rounded-xl border border-stone-200/80 p-6 flex flex-col justify-between hover:shadow-md transition-all">
                    <div class="space-y-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-stone-500 bg-white px-2 py-0.5 rounded border border-stone-200">
                                {{ $guide->category->name ?? 'Guide' }}
                            </span>
                            <span class="text-stone-400 font-mono">{{ $guide->reading_time_minutes }} min read</span>
                        </div>

                        <h3 class="font-serif-editorial text-xl font-bold text-stone-900 hover:text-stone-700 transition-colors leading-snug">
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

                    <div class="pt-6 border-t border-stone-200/60 mt-4 flex items-center justify-between">
                        <span class="text-[11px] text-stone-400">
                            {{ $guide->published_at ? $guide->published_at->format('M d, Y') : 'Draft' }}
                        </span>
                        <a href="{{ route('content.guide', $guide->slug) }}" class="text-xs uppercase font-semibold text-stone-900 underline hover:text-stone-600">
                            Read Guide &rarr;
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Story-Led Spotlight: Consumer Stories -->
@if(isset($latestStories) && $latestStories->isNotEmpty())
<section class="py-20 bg-[#f7f5f0] border-b border-stone-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2 max-w-2xl">
                <span class="text-xs uppercase font-bold tracking-widest text-amber-800">
                    Consumer Experiences
                </span>
                <h2 class="font-serif-editorial text-3xl sm:text-4xl font-bold text-stone-900">
                    Consumer Stories & Case Studies
                </h2>
                <p class="text-base text-stone-600 font-light">
                    Real-world scenarios: setting up ergonomic workspaces, high-volume printing, and conscious lifestyle decisions.
                </p>
            </div>

            <a href="{{ route('content.stories') }}" class="inline-flex items-center gap-1.5 text-xs uppercase tracking-wider font-semibold text-stone-900 hover:text-stone-600 transition-colors">
                <span>View All Stories &rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($latestStories as $story)
                <article class="bg-white rounded-xl border border-stone-200 p-8 space-y-4 shadow-xs">
                    <span class="text-[10px] uppercase font-bold tracking-widest text-amber-800 bg-amber-50 px-2.5 py-1 rounded border border-amber-200 inline-block">
                        Narrative Series
                    </span>
                    <h3 class="font-serif-editorial text-2xl font-bold text-stone-900">
                        <a href="{{ route('content.story', $story->slug) }}" class="hover:underline">
                            {{ $story->title }}
                        </a>
                    </h3>
                    @if($story->excerpt)
                        <p class="text-sm text-stone-600 font-light leading-relaxed">
                            {{ $story->excerpt }}
                        </p>
                    @endif
                    <div class="pt-4 border-t border-stone-100 flex items-center justify-between">
                        <span class="text-xs text-stone-400 font-mono">{{ $story->reading_time_minutes }} min read</span>
                        <a href="{{ route('content.story', $story->slug) }}" class="text-xs uppercase font-semibold text-stone-900 underline">
                            Read Story &rarr;
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Curated Showroom Products Grid -->
@if(isset($curatedProducts))
<section class="py-20 bg-white border-b border-stone-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2 max-w-2xl">
                <span class="text-xs uppercase font-bold tracking-widest text-stone-500">
                    {{ !empty($searchQuery) ? 'Search Results' : 'Curated Instruments' }}
                </span>
                <h2 class="font-serif-editorial text-3xl sm:text-4xl font-bold text-stone-900">
                    {{ !empty($searchQuery) ? 'Matching Recommendations' : 'Curated Selection' }}
                </h2>
                <p class="text-base text-stone-600 font-light">
                    {{ !empty($searchQuery) ? 'Showing items relevant to "' . $searchQuery . '".' : 'Products independently audited and evaluated by the Read2Buy.com editorial desk.' }}
                </p>
            </div>

            @if(isset($featuredCollections) && $featuredCollections->isNotEmpty() && empty($searchQuery))
                <a href="{{ route('showroom.collection', $featuredCollections->first()->slug) }}" class="inline-flex items-center gap-1.5 text-xs uppercase tracking-wider font-semibold text-stone-900 hover:text-stone-600 transition-colors">
                    <span>View Collection: {{ $featuredCollections->first()->name }} &rarr;</span>
                </a>
            @endif
        </div>

        @if($curatedProducts->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($curatedProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <div class="py-16 text-center bg-stone-50 rounded-xl border border-stone-200/80 p-8 space-y-4">
                <p class="text-stone-600 text-sm">
                    No curated instruments found matching your search &ldquo;{{ $searchQuery }}&rdquo;.
                </p>
                <a href="{{ route('home') }}" class="inline-block px-5 py-2.5 bg-stone-900 text-white rounded text-xs uppercase font-semibold hover:bg-stone-800 transition-colors shadow-xs">
                    Browse All Curated Collections
                </a>
            </div>
        @endif
    </div>
</section>
@endif
@endsection
