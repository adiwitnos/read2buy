@extends('layouts.app')

@section('title', 'Read2Buy — Read Deeper. Buy Smarter.')
@section('meta_description', 'Thoughtful product stories, verified technical audits, and honest trade-offs. Read before you buy.')

@section('content')

{{-- Product Search Results Header (if search is active) --}}
@if(!empty($searchQuery))
<section class="bg-amber-50 border-b border-amber-200/80 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <span class="text-[10px] uppercase font-bold tracking-widest text-amber-900 bg-amber-100 px-2.5 py-0.5 rounded border border-amber-300">
                Product Search
            </span>
            <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 mt-1">
                Showing results for: &ldquo;{{ $searchQuery }}&rdquo;
            </h2>
            <p class="text-xs text-stone-600 mt-0.5">Found {{ $curatedProducts->count() }} curated instruments matching your query.</p>
        </div>
        <a href="{{ route('home') }}" class="text-xs uppercase font-semibold text-stone-800 hover:text-stone-950 underline shrink-0">
            &times; Clear Search
        </a>
    </div>
</section>
@endif

{{-- 1. Hero Section: Visual Reconstruction with Clean Photo Plate --}}
<section class="relative bg-[#622410] text-white overflow-hidden min-h-[500px] sm:min-h-[540px] flex items-center border-b border-amber-950/40" aria-labelledby="hero-title">
    <!-- Clean Photography Background -->
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/landing/hero-clean.webp') }}');"></div>
    <!-- Editorial Gradient Shadow Overlay for High-Contrast Text Legibility -->
    <div class="absolute inset-0 bg-gradient-to-r from-[#3b1208]/95 via-[#4a180c]/75 to-[#4a180c]/25 pointer-events-none"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 w-full z-10">
        <div class="max-w-2xl space-y-6">
            <span class="inline-block text-[11px] font-bold uppercase tracking-[0.2em] text-amber-200/90 bg-black/40 backdrop-blur-xs px-3.5 py-1 rounded-full border border-amber-400/25">
                Independent Research Desk
            </span>

            <h1 id="hero-title" class="font-serif-editorial text-5xl sm:text-6xl lg:text-7xl font-bold tracking-tight text-white leading-[1.04] drop-shadow-md">
                Read deeper.<br>Buy smarter.
            </h1>

            <p class="text-lg sm:text-2xl text-amber-100/95 font-light leading-relaxed max-w-xl drop-shadow-xs">
                Thoughtful product stories, verified technical audits, and honest trade-offs for the way you live.
            </p>

            <div class="pt-3 flex flex-wrap items-center gap-4">
                <a href="#panduan-kurasi" class="pill-button group">
                    <span>Explore the Guides</span>
                    <svg viewBox="0 0 24 24" class="group-hover:translate-x-1 transition-transform" aria-hidden="true"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
                </a>
                <a href="#komparasi-produk" class="pill-button-glass">
                    <span>Compare Products Side-by-Side &darr;</span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- 2. Editorial Introduction & Value Proposition --}}
<section class="py-16 sm:py-20 bg-gradient-to-b from-[#fcf3eb] to-[#fff7ef] border-b border-stone-200/80" id="tentang" aria-labelledby="intro-title">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-16 items-start">
            <div class="lg:col-span-7 space-y-3">
                <div class="with-rule text-[#e94000] text-xs font-bold uppercase tracking-[0.14em]">
                    Welcome to Read2Buy
                </div>
                <h2 id="intro-title" class="font-serif-editorial text-3xl sm:text-5xl font-bold text-stone-900 tracking-tight leading-[1.08]">
                    Good purchases begin<br class="hidden sm:inline">with a great read.
                </h2>
            </div>
            <div class="lg:col-span-5 lg:border-l lg:border-[#d0bbaa] lg:pl-10 pt-2 lg:pt-6">
                <p class="text-base sm:text-lg text-stone-600 font-light leading-relaxed">
                    Explore products, understand key specifications, and discover what truly fits your needs, lifestyle, and goals—through in-depth, easy-to-read reviews and buying guides.
                </p>
            </div>
        </div>

        <!-- Three Editorial Pillars of Choice -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-2">
            <div class="p-6 bg-white/90 backdrop-blur-xs rounded-2xl border border-stone-200/70 shadow-2xs space-y-3 hover:border-amber-300 transition-colors">
                <span class="text-xs uppercase font-mono tracking-wider text-emerald-700 font-bold block">01 / Trade-Off Spectrum</span>
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900">No False "Number 1s"</h3>
                <p class="text-xs sm:text-sm text-stone-600 leading-relaxed font-light">
                    Every product choice entails compromises. We structure curated options into Essentials, Select, and Signature without promoting illusory "flawless" items.
                </p>
            </div>

            <div class="p-6 bg-white/90 backdrop-blur-xs rounded-2xl border border-stone-200/70 shadow-2xs space-y-3 hover:border-amber-300 transition-colors">
                <span class="text-xs uppercase font-mono tracking-wider text-stone-500 font-bold block">02 / Reality-Check Audits</span>
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900">Dissecting Real Flaws</h3>
                <p class="text-xs sm:text-sm text-stone-600 leading-relaxed font-light">
                    Exposing what conventional marketing glosses over. We audit official specifications, build quality thresholds, and candidly highlight when you shouldn't buy.
                </p>
            </div>

            <div class="p-6 bg-white/90 backdrop-blur-xs rounded-2xl border border-stone-200/70 shadow-2xs space-y-3 hover:border-amber-300 transition-colors">
                <span class="text-xs uppercase font-mono tracking-wider text-[#e94000] font-bold block">03 / Dual Gateways</span>
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900">Problem &amp; Story-Led</h3>
                <p class="text-xs sm:text-sm text-stone-600 leading-relaxed font-light">
                    Direct solutions for real-world dilemmas, coupled with contextual consumer stories that bring authentic clarity to every purchasing decision.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- 3. Four Curated Category Realms (Visual Mockup Grid connected to real filters) --}}
<section class="py-14 sm:py-16 bg-[#faf8f5] border-b border-stone-200/80" id="kategori-kurasi" aria-label="Explore shopping categories">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
        <div class="flex items-center justify-between">
            <div>
                <span class="text-xs uppercase font-bold tracking-widest text-[#e94000] block">Curated Realms</span>
                <h2 class="font-serif-editorial text-2xl sm:text-3xl font-bold text-stone-900 mt-1">
                    Explore Shopping Categories
                </h2>
            </div>
            <a href="#komparasi-produk" class="text-xs uppercase tracking-wider font-semibold text-stone-600 hover:text-stone-950 transition-colors">
                Filter Comparison &darr;
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            <!-- Realm 1: Tech & Gadgets / Creator Hardware -->
            <a href="{{ route('home', ['category' => 'creator-hardware']) }}#komparasi-produk" class="category-card h-48 sm:h-56 group block shadow-xs hover:shadow-md" title="Tech & Gadgets">
                <img src="{{ asset('images/landing/category-tech.webp') }}" alt="Tech and Gadgets" loading="lazy">
                <span class="category-card-label">Tech &amp; Gadgets</span>
                <span class="circle-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
                </span>
            </a>

            <!-- Realm 2: Home & Living / Ergonomic Workspaces -->
            <a href="{{ route('home', ['category' => 'ergonomic-workspaces']) }}#komparasi-produk" class="category-card h-48 sm:h-56 group block shadow-xs hover:shadow-md" title="Home & Living">
                <img src="{{ asset('images/landing/category-home.webp') }}" alt="Home and Living" loading="lazy">
                <span class="category-card-label">Home &amp; Living</span>
                <span class="circle-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
                </span>
            </a>

            <!-- Realm 3: Style & Essentials / Focus Reading -->
            <a href="{{ route('home', ['category' => 'focus-reading-tools']) }}#komparasi-produk" class="category-card h-48 sm:h-56 group block shadow-xs hover:shadow-md" title="Style & Essentials">
                <img src="{{ asset('images/landing/category-style.webp') }}" alt="Style and Essentials" loading="lazy">
                <span class="category-card-label">Style &amp; Essentials</span>
                <span class="circle-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
                </span>
            </a>

            <!-- Realm 4: Travel & Outdoors -->
            <a href="{{ route('content.guides') }}" class="category-card h-48 sm:h-56 group block shadow-xs hover:shadow-md" title="Travel & Outdoors">
                <img src="{{ asset('images/landing/category-travel.webp') }}" alt="Travel and Outdoors" loading="lazy">
                <span class="category-card-label">Travel &amp; Outdoors</span>
                <span class="circle-arrow" aria-hidden="true">
                    <svg viewBox="0 0 24 24"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
                </span>
            </a>
        </div>
    </div>
</section>

{{-- 4. Featured Story / Spotlight (Mockup Audio Plate with Dynamic Database Connection) --}}
<section class="py-16 bg-white border-b border-stone-200/80" id="cerita-unggulan">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if(isset($latestStories) && $latestStories->isNotEmpty())
            @php $featuredStory = $latestStories->first(); @endphp
            <div class="grid grid-cols-1 lg:grid-cols-12 rounded-2xl overflow-hidden border border-stone-200/80 bg-gradient-to-r from-[#fff6ed] to-[#f2e3d5] shadow-xs">
                <div class="lg:col-span-7 aspect-16/10 lg:aspect-auto h-64 sm:h-80 lg:h-auto overflow-hidden">
                    <img src="{{ asset('images/landing/feature-audio.webp') }}" alt="{{ $featuredStory->title }}" class="w-full h-full object-cover hover:scale-105 transition-transform duration-700" loading="lazy">
                </div>
                <div class="lg:col-span-5 p-8 sm:p-12 flex flex-col justify-between items-start space-y-6">
                    <div class="space-y-4">
                        <div class="mini-rule" aria-hidden="true"></div>
                        <span class="text-[10px] uppercase font-bold tracking-widest text-[#e94000] bg-orange-100/90 px-2.5 py-1 rounded border border-orange-200 inline-block">
                            Featured Consumer Story &bull; {{ $featuredStory->reading_time_minutes }} min read
                        </span>
                        <h2 class="font-serif-editorial text-2xl sm:text-4xl font-bold text-stone-900 leading-snug">
                            {{ $featuredStory->title }}
                        </h2>
                        <p class="text-sm sm:text-base text-stone-600 font-light leading-relaxed line-clamp-3">
                            {{ $featuredStory->excerpt ?? 'A closer look at real-world consumer setups, trade-offs, and experiences that bring clarity to every purchase.' }}
                        </p>
                    </div>
                    <a href="{{ route('content.story', $featuredStory->slug) }}" class="pill-button group">
                        <span>Read the story</span>
                        <svg viewBox="0 0 24 24" class="group-hover:translate-x-1 transition-transform" aria-hidden="true"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
                    </a>
                </div>
            </div>
        @else
            <!-- Editorial Showcase Fallback -->
            <div class="grid grid-cols-1 lg:grid-cols-12 rounded-2xl overflow-hidden border border-stone-200/80 bg-gradient-to-r from-[#fff6ed] to-[#f2e3d5] shadow-xs">
                <div class="lg:col-span-7 aspect-16/10 lg:aspect-auto h-64 sm:h-80 lg:h-auto overflow-hidden">
                    <img src="{{ asset('images/landing/feature-audio.webp') }}" alt="What makes great sound" class="w-full h-full object-cover" loading="lazy">
                </div>
                <div class="lg:col-span-5 p-8 sm:p-12 flex flex-col justify-between items-start space-y-6">
                    <div class="space-y-4">
                        <div class="mini-rule" aria-hidden="true"></div>
                        <h2 class="font-serif-editorial text-3xl sm:text-4xl font-bold text-stone-900 leading-tight">
                            What makes<br>great sound?
                        </h2>
                        <p class="text-sm sm:text-base text-stone-600 font-light leading-relaxed">
                            A closer look at the features, design, and real-world experience that bring audio to life.
                        </p>
                    </div>
                    <a href="{{ route('content.stories') }}" class="pill-button group">
                        <span>Read the story</span>
                        <svg viewBox="0 0 24 24" class="group-hover:translate-x-1 transition-transform" aria-hidden="true"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

{{-- 5. Latest Guides: Visual Card Styling + Dynamic Database Query --}}
@if(isset($latestGuides) && $latestGuides->isNotEmpty())
<section class="py-20 bg-stone-50/60 border-b border-stone-200/80" id="panduan-kurasi" aria-labelledby="guides-heading-title">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4">
            <div class="with-rule flex-1 max-w-xl">
                <h2 id="guides-heading-title" class="text-xs sm:text-sm font-bold uppercase tracking-[0.14em] text-[#e94000] whitespace-nowrap">
                    Latest Guides
                </h2>
            </div>
            <a href="{{ route('content.guides') }}" class="text-xs uppercase tracking-wider font-semibold text-stone-800 hover:text-[#e94000] transition-colors shrink-0 flex items-center gap-1.5">
                <span>View All Guides &rarr;</span>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
            @php
                $guideFallbackImages = [
                    asset('images/landing/guide-tech.webp'),
                    asset('images/landing/guide-coffee.webp'),
                    asset('images/landing/guide-travel.webp'),
                ];
            @endphp
            @foreach($latestGuides as $idx => $guide)
                @php
                    $cardCover = $guide->featured_image ?? $guideFallbackImages[$idx % count($guideFallbackImages)];
                @endphp
                <article class="bg-gradient-to-b from-[#fffaf4] to-[#fbf1e9] rounded-xl border border-[#e6d7c9] overflow-hidden shadow-xs hover:shadow-md transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="h-44 overflow-hidden relative">
                            <img src="{{ $cardCover }}" alt="{{ $guide->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" loading="lazy">
                            <span class="absolute top-3 left-3 text-[10px] uppercase font-bold tracking-wider text-stone-800 bg-white/90 backdrop-blur-xs px-2.5 py-0.5 rounded shadow-2xs">
                                {{ $guide->category->name ?? 'Buying Guide' }}
                            </span>
                        </div>
                        <div class="p-6 relative">
                            <h3 class="font-serif-editorial text-xl font-bold text-stone-900 group-hover:text-stone-700 transition-colors leading-snug line-clamp-2 pr-10">
                                <a href="{{ route('content.guide', $guide->slug) }}">
                                    {{ $guide->title }}
                                </a>
                            </h3>
                            @if($guide->excerpt)
                                <p class="text-xs sm:text-sm text-stone-600 font-light mt-2 line-clamp-2 leading-relaxed">
                                    {{ $guide->excerpt }}
                                </p>
                            @endif
                            <a href="{{ route('content.guide', $guide->slug) }}" class="guide-action" aria-label="Read {{ $guide->title }}">
                                <svg viewBox="0 0 24 24"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
                            </a>
                        </div>
                    </div>
                    <div class="px-6 pb-5 pt-3 border-t border-stone-200/50 flex items-center justify-between text-[11px] text-stone-400">
                        <span>{{ $guide->reading_time_minutes }} min read</span>
                        <span class="font-mono">{{ $guide->published_at ? $guide->published_at->format('M d, Y') : 'Published' }}</span>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- 6. Process Band: Curiosity. Clarity. Confidence. --}}
<section class="process-band py-16 sm:py-20 border-b border-stone-800" aria-labelledby="process-title">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 items-center">
            <div class="lg:col-span-4 lg:border-r lg:border-stone-400/40 lg:pr-10 space-y-4">
                <h2 id="process-title" class="font-serif-editorial text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight leading-tight">
                    Curiosity.<br>Clarity.<br>Confidence.
                </h2>
                <div class="mini-rule" aria-hidden="true"></div>
                <p class="text-xs sm:text-sm text-stone-300 font-light leading-relaxed">
                    A conscious decision framework designed to evaluate build longevity, verified strengths, and hidden compromises.
                </p>
            </div>

            <div class="lg:col-span-8">
                <ol class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                    <!-- Step 1: Discover -->
                    <li class="relative space-y-3">
                        <div class="w-10 h-10 rounded-full bg-amber-500/20 border border-amber-400/40 flex items-center justify-center text-amber-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <circle cx="11" cy="11" r="7" /><path d="m21 21-4.35-4.35" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <strong class="font-serif-editorial text-xl font-bold text-white block">1. Discover</strong>
                        <p class="text-xs sm:text-sm text-stone-300 font-light leading-relaxed">
                            Find research-backed instruments and unvarnished real-world consumer stories.
                        </p>
                    </li>

                    <!-- Step 2: Understand -->
                    <li class="relative space-y-3">
                        <div class="w-10 h-10 rounded-full bg-amber-500/20 border border-amber-400/40 flex items-center justify-center text-amber-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <strong class="font-serif-editorial text-xl font-bold text-white block">2. Understand</strong>
                        <p class="text-xs sm:text-sm text-stone-300 font-light leading-relaxed">
                            Audit verified specifications, durability limits, and what marketing glosses over.
                        </p>
                    </li>

                    <!-- Step 3: Decide -->
                    <li class="relative space-y-3">
                        <div class="w-10 h-10 rounded-full bg-amber-500/20 border border-amber-400/40 flex items-center justify-center text-amber-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <strong class="font-serif-editorial text-xl font-bold text-white block">3. Decide</strong>
                        <p class="text-xs sm:text-sm text-stone-300 font-light leading-relaxed">
                            Select the right instrument for your lifestyle with informed, rational confidence.
                        </p>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

{{-- 7. Side-by-side Product Comparison Table per Parameter (Existing Core USP) --}}
@if(isset($comparisonProducts) && $comparisonProducts->isNotEmpty() && empty($searchQuery))
    <x-comparison-table
        :products="$comparisonProducts"
        :active-category="$activeComparisonCategory"
        :categories="$comparisonCategories"
    />
@endif

{{-- 8. Curated Showroom Products Grid (Existing Core USP) --}}
@if(isset($curatedProducts))
<section class="py-20 bg-white border-b border-stone-200/80" id="produk-terkurasi">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-12">
            <div class="space-y-2 max-w-2xl">
                <span class="text-xs uppercase font-bold tracking-widest text-[#e94000]">
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
                <a href="{{ route('showroom.collection', $featuredCollections->first()->slug) }}" class="inline-flex items-center gap-1.5 text-xs uppercase tracking-wider font-semibold text-stone-900 hover:text-[#e94000] transition-colors">
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

{{-- 9. Closing CTA Banner (Visual Reconstruction) --}}
<section class="closing-cta py-14 sm:py-16 text-stone-900" aria-label="Discover Read2Buy">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-6">
        <h2 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-950">
            Know more. Choose well.
        </h2>
        <a href="#komparasi-produk" class="pill-button group">
            <span>Discover Read2Buy</span>
            <svg viewBox="0 0 24 24" class="group-hover:translate-x-1 transition-transform" aria-hidden="true"><path d="M4 12h16m-6-6 6 6-6 6" /></svg>
        </a>
    </div>
</section>

@endsection
