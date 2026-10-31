@extends('layouts.app')

@section('title', $product->name . ' — Editorial Curation | ' . ($siteSettings['site_name'] ?? 'Read2Buy.com'))
@section('meta_description', $product->summary ?? $product->tagline)

@push('meta')
    <!-- Canonical -->
    <link rel="canonical" href="{{ route('showroom.product', $product->slug) }}">

    <!-- Open Graph -->
    <meta property="og:type" content="product">
    <meta property="og:title" content="{{ $product->name }} — {{ $siteSettings['site_name'] ?? 'Read2Buy.com' }}">
    <meta property="og:description" content="{{ $product->summary ?? $product->tagline }}">
    @if($product->primary_image)
        <meta property="og:image" content="{{ $product->primary_image }}">
    @endif

    <!-- Structured Data JSON-LD (Product, Review, AggregateRating, Offers) -->
    <script type="application/ld+json">
    {!! json_encode(array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        'name' => $product->name,
        'image' => $product->primary_image ? [$product->primary_image] : [],
        'description' => $product->summary ?? $product->description,
        'brand' => [
            '@type' => 'Brand',
            'name' => $product->brand ?? 'Independent Maker',
        ],
        'category' => $product->category?->name,
        'offers' => $product->primaryAffiliateOffer ? [
            '@type' => 'Offer',
            'url' => route('affiliate.out', $product->primaryAffiliateOffer->id),
            'priceCurrency' => 'USD',
            'price' => $product->primaryAffiliateOffer->price ?? $product->estimated_price_min,
            'availability' => 'https://schema.org/InStock',
            'seller' => [
                '@type' => 'Organization',
                'name' => $product->primaryAffiliateOffer->seller_name ?? 'Authorized Retailer',
            ],
        ] : null,
        'aggregateRating' => $product->curationScore ? [
            '@type' => 'AggregateRating',
            'ratingValue' => (string) $product->curationScore->overall_score,
            'bestRating' => '10',
            'worstRating' => '1',
            'ratingCount' => 1,
            'reviewCount' => 1,
        ] : null,
        'review' => $product->curationScore ? [
            '@type' => 'Review',
            'reviewRating' => [
                '@type' => 'Rating',
                'ratingValue' => (string) $product->curationScore->overall_score,
                'bestRating' => '10',
            ],
            'author' => [
                '@type' => 'Organization',
                'name' => 'The Read2Buy Editorial Desk',
            ],
            'reviewBody' => $product->curationScore->editorial_verdict ?? $product->summary,
        ] : null,
    ]), JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>
@endpush

@section('content')
<!-- Breadcrumbs -->
<div class="bg-white border-b border-stone-200/80 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center gap-2 text-xs text-stone-500">
            <a href="{{ route('home') }}" class="hover:text-stone-900 transition-colors">Home</a>
            <span>/</span>
            @if($product->collection)
                <a href="{{ route('showroom.collection', $product->collection->slug) }}" class="hover:text-stone-900 transition-colors">
                    {{ $product->collection->name }}
                </a>
                <span>/</span>
            @endif
            <span class="text-stone-800 font-semibold truncate">{{ $product->name }}</span>
        </nav>
    </div>
</div>

<!-- Product Showcase & Purchase Intent -->
<section class="py-12 bg-white border-b border-stone-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left: Product Image & Gallery -->
            <div class="lg:col-span-6 space-y-4">
                <div class="aspect-4/3 bg-stone-100 rounded-2xl overflow-hidden border border-stone-200/80 shadow-xs">
                    @if($product->primary_image)
                        <img src="{{ $product->primary_image }}" alt="{{ $product->name }}" class="w-full h-full object-cover object-center">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-stone-400 bg-stone-100">
                            <span class="text-xs uppercase tracking-widest font-mono">Editorial Documentation Photo</span>
                        </div>
                    @endif
                </div>

                @if($product->curationScore)
                    <div class="flex items-center justify-between p-3.5 bg-stone-50 rounded-xl border border-stone-200/70 text-xs">
                        <span class="text-stone-600">
                            Evaluation Method: <strong>{{ $product->curationScore->evaluation_method->label() }}</strong>
                        </span>
                        <span class="text-stone-400 font-mono">
                            {{ $product->curationScore->tested_at ? 'Tested: ' . $product->curationScore->tested_at->format('M Y') : 'Verified' }}
                        </span>
                    </div>
                @endif
            </div>

            <!-- Right: Identity, Editorial Hook & Verified Affiliate Offers -->
            <div class="lg:col-span-6 flex flex-col justify-between space-y-6">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        @if($product->brand)
                            <span class="text-xs uppercase tracking-[0.2em] font-semibold text-stone-400">
                                {{ $product->brand }}
                            </span>
                            <span class="text-stone-300">•</span>
                        @endif
                        <span class="text-xs text-stone-500 font-medium">
                            {{ $product->category->name }}
                        </span>
                    </div>

                    <h1 class="font-serif-editorial text-3xl sm:text-4xl font-bold text-stone-900 leading-tight">
                        {{ $product->name }}
                    </h1>

                    @if($product->tagline)
                        <p class="text-base text-stone-600 font-light italic">
                            "{{ $product->tagline }}"
                        </p>
                    @endif

                    @if($product->summary)
                        <div class="pt-2">
                            <p class="text-sm text-stone-700 leading-relaxed">
                                {{ $product->summary }}
                            </p>
                        </div>
                    @endif

                    <!-- Bookmark Button -->
                    <div class="pt-2">
                        @auth
                            <form method="POST" action="{{ route('bookmark.toggle', $product->id) }}" class="inline-block">
                                @csrf
                                @php $isBookmarked = auth()->user()->hasBookmarked($product); @endphp
                                <button type="submit" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-colors border {{ $isBookmarked ? 'bg-amber-100 text-amber-900 border-amber-300' : 'bg-white text-stone-700 border-stone-300 hover:bg-stone-50' }} cursor-pointer">
                                    <svg class="w-4 h-4 {{ $isBookmarked ? 'text-amber-700 fill-amber-700' : 'text-stone-400' }}" fill="{{ $isBookmarked ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                    </svg>
                                    <span>{{ $isBookmarked ? 'Saved to Bookmarks' : 'Save to Bookmarks' }}</span>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-3.5 py-2 rounded-lg text-xs font-semibold uppercase tracking-wider transition-colors border bg-white text-stone-600 border-stone-300 hover:bg-stone-50">
                                <svg class="w-4 h-4 text-stone-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                                <span>Sign In to Bookmark</span>
                            </a>
                        @endauth
                    </div>
                </div>

                <!-- Verified Affiliate Offer Card -->
                <div class="bg-[#faf8f5] rounded-xl border border-stone-200 p-6 space-y-4 shadow-xs">
                    <div class="flex items-center justify-between pb-3 border-b border-stone-200/70">
                        <div>
                            <span class="text-[10px] uppercase tracking-wider font-bold text-stone-500 block">
                                Verified Official Retailers
                            </span>
                            <span class="text-xs text-emerald-800 font-medium flex items-center gap-1 mt-0.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Official & Warrantied Partner
                            </span>
                        </div>
                        <a href="{{ route('legal.affiliate-disclosure') }}" class="text-[10px] text-stone-400 underline hover:text-stone-600">
                            Affiliate Disclosure
                        </a>
                    </div>

                    @if($product->affiliateOffers->isNotEmpty())
                        <div class="space-y-3">
                            @foreach($product->affiliateOffers as $offer)
                                <div class="bg-white p-4 rounded-lg border border-stone-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xs font-bold text-stone-900">{{ $offer->seller_name }}</span>
                                            @if($offer->seller_badge)
                                                <span class="text-[10px] px-2 py-0.2 rounded bg-amber-50 text-amber-900 font-semibold border border-amber-200">
                                                    {{ $offer->seller_badge }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-xs text-stone-500 mt-1">
                                            Platform: <strong>{{ $offer->platform->label() }}</strong>
                                            @if($offer->price)
                                                • <span class="font-mono font-bold text-stone-900">${{ number_format($offer->price, 2) }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <a href="{{ route('affiliate.out', $offer->id) }}" target="_blank" rel="nofollow sponsored" class="inline-flex items-center justify-center px-5 py-2.5 bg-stone-900 text-white rounded-md text-xs uppercase tracking-wider font-semibold hover:bg-stone-800 transition-colors whitespace-nowrap shadow-xs">
                                        <span>Check on {{ $offer->platform->label() }}</span>
                                        <svg class="w-3.5 h-3.5 ml-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-xs text-stone-500 italic p-3 bg-white rounded border border-stone-200 text-center">
                            Official retail links are currently being updated.
                        </div>
                    @endif

                    <div class="text-[11px] text-stone-500 pt-1 leading-normal">
                        * Read2Buy.com connects you directly to verified stores. Transactions, warranties, and shipping are fulfilled by the respective official retailer.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- The Read2Buy Standard Scorecard & Editorial Evaluation -->
<section class="py-16 bg-[#faf8f5]">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
        @php $note = $product->primaryResearchNote; @endphp
        @if($note)
            <!-- The Reality-Check Trade-Off Matrix -->
            <div class="bg-white rounded-2xl border border-stone-200/90 p-6 sm:p-10 shadow-xs space-y-8">
                <div class="border-b border-stone-100 pb-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                    <div>
                        <span class="text-xs uppercase font-bold tracking-widest text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200">
                            Specification Audit & Trade-off Matrix
                        </span>
                        <h2 class="font-serif-editorial text-2xl sm:text-3xl font-bold text-stone-900 mt-2">
                            Verified Strengths vs Real Limitations
                        </h2>
                    </div>
                    <div class="flex items-center gap-2 text-xs">
                        <span class="text-stone-500">Evidence Strength:</span>
                        <span class="px-2.5 py-0.5 rounded text-xs font-semibold border {{ $note->evidence_strength->badgeClasses() }}">
                            {{ $note->evidence_strength->label() }}
                        </span>
                    </div>
                </div>

                <!-- 2 Columns: Strengths vs Limitations -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Green Card: Key Strengths -->
                    <div class="bg-emerald-50/40 rounded-xl border border-emerald-200/80 p-6 space-y-3">
                        <div class="flex items-center gap-2 text-emerald-900 font-bold text-sm">
                            <svg class="w-5 h-5 text-emerald-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span>Key Strengths (Verified Facts)</span>
                        </div>
                        <ul class="space-y-2 text-xs text-stone-700 leading-relaxed pt-1">
                            @foreach($note->key_strengths ?? [] as $pro)
                                <li class="flex items-start gap-2">
                                    <span class="text-emerald-600 font-bold mt-0.5">•</span>
                                    <span>{{ $pro }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Red Card: Limitations & Trade-offs -->
                    <div class="bg-rose-50/40 rounded-xl border border-rose-200/80 p-6 space-y-3">
                        <div class="flex items-center gap-2 text-rose-900 font-bold text-sm">
                            <svg class="w-5 h-5 text-rose-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span>Limitations & Trade-offs (Rarely Disclosed)</span>
                        </div>
                        <ul class="space-y-2 text-xs text-stone-700 leading-relaxed pt-1">
                            @foreach($note->limitations ?? [] as $con)
                                <li class="flex items-start gap-2">
                                    <span class="text-rose-600 font-bold mt-0.5">•</span>
                                    <span>{{ $con }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- 2 Columns: Best Suited For vs When to Skip -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-xs">
                    <div class="p-5 bg-stone-50 rounded-xl border border-stone-200/70 space-y-1.5">
                        <strong class="text-stone-900 font-bold text-sm flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-blue-600"></span>
                            Best Suited For:
                        </strong>
                        <p class="text-stone-600 leading-relaxed">
                            {{ $note->useful_for ?? '-' }}
                        </p>
                    </div>

                    <div class="p-5 bg-stone-50 rounded-xl border border-stone-200/70 space-y-1.5">
                        <strong class="text-stone-900 font-bold text-sm flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-amber-600"></span>
                            When You Shouldn't Buy:
                        </strong>
                        <p class="text-stone-600 leading-relaxed">
                            {{ $note->verdict ?? 'Consider whether your existing equipment already fulfills your core needs.' }}
                        </p>
                    </div>
                </div>

                @if($note->sources)
                    <div class="pt-4 border-t border-stone-100 text-[11px] text-stone-400 flex flex-wrap items-center gap-x-4 gap-y-1">
                        <span class="font-medium text-stone-600">Specification Verification Sources:</span>
                        @foreach($note->sources as $source)
                            <a href="{{ $source['url'] ?? '#' }}" target="_blank" rel="nofollow noopener" class="underline hover:text-stone-700">
                                {{ $source['publisher'] ?? parse_url($source['url'] ?? '', PHP_URL_HOST) }} (inspected {{ $source['inspected_at'] ?? '2026' }})
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @endif

        <div>
            <div class="text-center max-w-xl mx-auto space-y-2 mb-8">
                <span class="text-xs uppercase font-bold tracking-[0.2em] text-stone-500">Comprehensive Evaluation</span>
                <h2 class="font-serif-editorial text-3xl font-bold text-stone-900">
                    The Read2Buy Standard Scorecard
                </h2>
                <p class="text-xs sm:text-sm text-stone-600">
                    Complete transparency on why this instrument was selected, technical merits, and key trade-offs.
                </p>
            </div>

            <x-scorecard :score="$product->curationScore" />
        </div>

        <!-- Specifications Table -->
        @if(!empty($product->specifications))
            <div class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8 space-y-4">
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900 pb-2 border-b border-stone-100">
                    Technical Specifications
                </h3>
                <dl class="divide-y divide-stone-100 text-sm">
                    @foreach($product->specifications as $key => $value)
                        <div class="py-3 sm:grid sm:grid-cols-3 sm:gap-4">
                            <dt class="font-medium text-stone-500 capitalize">
                                {{ str_replace('_', ' ', $key) }}
                            </dt>
                            <dd class="mt-1 sm:mt-0 sm:col-span-2 text-stone-900 font-mono text-xs sm:text-sm">
                                {{ is_array($value) ? implode(', ', $value) : $value }}
                            </dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        @endif

        <!-- Longform Review (if published) -->
        @if($product->reviews->isNotEmpty())
            @foreach($product->reviews as $review)
                <article class="bg-white rounded-xl border border-stone-200 p-6 sm:p-8 space-y-6">
                    <div class="space-y-2 pb-4 border-b border-stone-100">
                        <span class="text-[10px] uppercase font-bold tracking-wider px-2 py-0.5 rounded bg-stone-100 text-stone-700">
                            In-Depth Review
                        </span>
                        <h3 class="font-serif-editorial text-2xl font-bold text-stone-900">
                            {{ $review->title }}
                        </h3>
                        @if($review->headline)
                            <p class="text-sm text-stone-500 italic">
                                {{ $review->headline }}
                            </p>
                        @endif
                        <div class="text-xs text-stone-400 pt-1">
                            By: {{ $review->author_name }} • {{ $review->reading_time_minutes }} min read
                        </div>
                    </div>

                    <div class="prose prose-stone text-stone-800 text-sm sm:text-base leading-relaxed space-y-4 font-light">
                        <p>{{ $review->content }}</p>
                    </div>

                    @if($review->verdict_summary)
                        <div class="bg-stone-50 border-l-2 border-stone-900 p-4 rounded-r-lg mt-6 text-sm text-stone-800 font-serif-editorial italic">
                            <strong>Reviewer Verdict:</strong> "{{ $review->verdict_summary }}"
                        </div>
                    @endif
                </article>
            @endforeach
        @endif
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->isNotEmpty())
<section class="py-16 bg-white border-t border-stone-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h3 class="font-serif-editorial text-2xl font-bold text-stone-900 mb-8">
            Related Curated Products
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            @foreach($relatedProducts as $related)
                <x-product-card :product="$related" />
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
