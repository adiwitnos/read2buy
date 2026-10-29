@extends('layouts.app')

@section('title', $guide->meta_title ?? ($guide->title . ' — Read2Buy'))
@section('meta_description', $guide->meta_description ?? ($guide->excerpt ?? 'Independent curation guide backed by The Read2Buy Standard.'))

@section('content')
<article class="bg-[#faf8f5] pb-24">
    <!-- Header Hero -->
    <header class="bg-white border-b border-stone-200/80 pt-16 pb-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div class="flex flex-wrap items-center gap-3 text-xs">
                @if($guide->category)
                    <span class="px-3 py-1 bg-stone-100 text-stone-800 rounded-full font-semibold uppercase tracking-wider text-[10px]">
                        {{ $guide->category->name }}
                    </span>
                @endif
                <span class="text-stone-400">&bull;</span>
                <span class="text-stone-500 font-mono">{{ $guide->reading_time_minutes }} min read</span>
                <span class="text-stone-400">&bull;</span>
                <span class="text-stone-500">{{ $guide->published_at ? $guide->published_at->format('M d, Y') : 'Draft' }}</span>
            </div>

            <h1 class="font-serif-editorial text-3xl sm:text-5xl font-bold tracking-tight text-stone-900 leading-[1.2]">
                {{ $guide->title }}
            </h1>

            @if($guide->headline)
                <p class="text-lg sm:text-xl text-stone-700 font-light leading-relaxed">
                    {{ $guide->headline }}
                </p>
            @endif

            @if($guide->excerpt)
                <div class="p-5 bg-stone-50 rounded-xl border-l-4 border-stone-800 text-stone-700 text-sm leading-relaxed">
                    <strong class="block text-xs uppercase tracking-wider text-stone-500 mb-1">Quick Takeaway</strong>
                    {{ $guide->excerpt }}
                </div>
            @endif

            <!-- Standard Disclosure Box -->
            <x-disclosure-box method="online_research" :hasAffiliate="true" />
        </div>
    </header>

    <!-- Main Content & Tier Showcase -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-12 space-y-16">

        <!-- Tiered Curated Choices: Essentials / Select / Signature -->
        @if($guide->products->isNotEmpty())
            <section class="space-y-6">
                <div class="border-b border-stone-200 pb-3">
                    <span class="text-xs uppercase font-bold tracking-widest text-stone-500">Curation Structure</span>
                    <h2 class="font-serif-editorial text-2xl font-bold text-stone-900">
                        Three Alternative Tiers: Matched to Utility & Budget
                    </h2>
                    <p class="text-xs text-stone-500 mt-1">
                        The choices below represent functional and rational alternatives, not customer status tiers.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach(['essentials', 'select', 'signature'] as $tierKey)
                        @php
                            $tierProducts = $tieredProducts[$tierKey] ?? collect();
                            $tierEnum = \App\Enums\ProductTier::tryFrom($tierKey);
                        @endphp
                        <div class="bg-white rounded-xl border border-stone-200/90 p-5 flex flex-col justify-between shadow-xs {{ $tierKey === 'select' ? 'ring-2 ring-stone-900/10' : '' }}">
                            <div class="space-y-3">
                                <div class="flex items-center justify-between">
                                    <x-tier-badge :tier="$tierEnum" />
                                    @if($tierKey === 'select')
                                        <span class="text-[10px] uppercase font-bold tracking-wider text-amber-700 bg-amber-50 px-2 py-0.5 rounded">Top Recommendation</span>
                                    @endif
                                </div>
                                <div class="text-[10px] font-bold tracking-wider uppercase {{ $tierKey === 'signature' ? 'text-stone-700' : ($tierKey === 'select' ? 'text-amber-800' : 'text-emerald-800') }}">
                                    {{ $tierKey === 'essentials' ? 'Feature Compromise (Budget-Conscious)' : ($tierKey === 'select' ? 'Optimal Balance (Most Rational)' : 'Cost Compromise (Specialized Capability)') }}
                                </div>
                                <p class="text-[11px] text-stone-500 leading-normal">
                                    {{ $tierEnum->definition() }}
                                </p>

                                @forelse($tierProducts as $product)
                                    <div class="pt-3 border-t border-stone-100 space-y-2">
                                        <h3 class="font-serif-editorial text-base font-bold text-stone-900 leading-snug">
                                            <a href="{{ route('showroom.product', $product->slug) }}" class="hover:text-stone-600 transition-colors">
                                                {{ $product->name }}
                                            </a>
                                        </h3>

                                        @if($product->pivot->curation_reason)
                                            <p class="text-xs text-stone-600 leading-relaxed italic bg-stone-50 p-2.5 rounded border border-stone-100">
                                                &ldquo;{{ $product->pivot->curation_reason }}&rdquo;
                                            </p>
                                        @endif

                                        <div class="text-xs font-mono font-semibold text-stone-800 pt-1">
                                            @if($product->primaryAffiliateOffer && $product->primaryAffiliateOffer->price)
                                                ${{ number_format($product->primaryAffiliateOffer->price, 2) }}
                                            @elseif($product->estimated_price_min)
                                                ${{ number_format($product->estimated_price_min, 2) }}
                                            @else
                                                Check Retailer
                                            @endif
                                        </div>

                                        @if($product->primaryAffiliateOffer)
                                            <div class="pt-2">
                                                <a href="{{ route('affiliate.out', $product->primaryAffiliateOffer->id) }}" target="_blank" rel="sponsored noopener" class="w-full inline-flex items-center justify-center gap-1.5 px-3 py-2 text-xs font-semibold uppercase tracking-wider rounded-lg {{ $tierKey === 'signature' ? 'bg-stone-900 text-white hover:bg-stone-800' : ($tierKey === 'select' ? 'bg-amber-600 text-white hover:bg-amber-700' : 'bg-emerald-700 text-white hover:bg-emerald-800') }} transition-colors">
                                                    <span>Check Verified Store</span>
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                    </svg>
                                                </a>
                                                <span class="block text-[10px] text-stone-400 text-center mt-1">
                                                    Via {{ $product->primaryAffiliateOffer->seller_name ?? 'Official Partner' }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                @empty
                                    <p class="text-xs text-stone-400 italic pt-2">No items currently in this tier.</p>
                                @endforelse
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Narrative Guide Body -->
        <section class="bg-white rounded-xl border border-stone-200/80 p-6 sm:p-10 shadow-xs prose prose-stone max-w-none text-stone-800 leading-relaxed">
            {!! nl2br(e($guide->body)) !!}
        </section>

        <!-- Detailed Audit Research Notes & 5 Questions per Product -->
        @if($guide->products->isNotEmpty())
            <section class="space-y-6">
                <div class="border-b border-stone-200 pb-3">
                    <span class="text-xs uppercase font-bold tracking-widest text-emerald-800 bg-emerald-50 px-2.5 py-1 rounded border border-emerald-200">
                        Independent Editorial Audit
                    </span>
                    <h2 class="font-serif-editorial text-2xl font-bold text-stone-900 mt-2">
                        Strengths vs Flaws & Limitations Breakdown
                    </h2>
                    <p class="text-xs text-stone-500 mt-1">
                        5-Question Research Notes: Verified facts, hidden trade-offs, and critical considerations before purchasing.
                    </p>
                </div>

                <div class="space-y-6">
                    @foreach($guide->products as $product)
                        @php $note = $product->primaryResearchNote; @endphp
                        @if($note)
                            <div class="bg-white rounded-xl border border-stone-200/90 p-6 space-y-4 shadow-xs">
                                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 border-b border-stone-100 pb-3">
                                    <div>
                                        <span class="text-xs font-semibold text-stone-400 uppercase tracking-widest">{{ $product->brand }}</span>
                                        <h3 class="font-serif-editorial text-lg font-bold text-stone-900">{{ $product->name }}</h3>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xs text-stone-500">Evidence Strength:</span>
                                        <span class="px-2 py-0.5 rounded text-xs font-semibold border {{ $note->evidence_strength->badgeClasses() }}">
                                            {{ $note->evidence_strength->label() }}
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                                    <div class="space-y-1 bg-stone-50 p-3 rounded">
                                        <strong class="text-stone-900 block font-semibold">1. Who benefits most?</strong>
                                        <p class="text-stone-600">{{ $note->useful_for ?? '-' }}</p>
                                    </div>
                                    <div class="space-y-1 bg-stone-50 p-3 rounded">
                                        <strong class="text-stone-900 block font-semibold">2. Is the price justified?</strong>
                                        <p class="text-stone-600">{{ $note->price_reasonableness ?? '-' }}</p>
                                    </div>
                                </div>

                                @if($note->key_strengths || $note->limitations)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs pt-1">
                                        @if($note->key_strengths)
                                            <div class="space-y-1">
                                                <strong class="text-emerald-800 font-semibold block">3. Key Strengths:</strong>
                                                <ul class="list-disc list-inside text-stone-600 space-y-1">
                                                    @foreach($note->key_strengths as $pro)
                                                        <li>{{ $pro }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        @if($note->limitations)
                                            <div class="space-y-1">
                                                <strong class="text-rose-800 font-semibold block">4. Flaws & Limitations:</strong>
                                                <ul class="list-disc list-inside text-stone-600 space-y-1">
                                                    @foreach($note->limitations as $con)
                                                        <li>{{ $con }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                @if($note->verdict)
                                    <div class="text-xs bg-[#faf8f5] p-3 rounded border border-stone-200/70">
                                        <strong class="text-stone-900 font-semibold block mb-0.5">5. Editorial Verdict:</strong>
                                        <p class="text-stone-700 italic">{{ $note->verdict }}</p>
                                    </div>
                                @endif

                                @if($note->sources)
                                    <div class="pt-2 text-[11px] text-stone-400 border-t border-stone-100 flex flex-wrap items-center gap-x-4 gap-y-1">
                                        <span class="font-medium text-stone-600">Research Verification Sources:</span>
                                        @foreach($note->sources as $source)
                                            <a href="{{ $source['url'] ?? '#' }}" target="_blank" rel="nofollow noopener" class="underline hover:text-stone-700">
                                                {{ $source['publisher'] ?? parse_url($source['url'] ?? '', PHP_URL_HOST) }} (inspected {{ $source['inspected_at'] ?? '2026' }})
                                            </a>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </section>
        @endif

        <!-- Related Guides -->
        @if($relatedGuides->isNotEmpty())
            <section class="border-t border-stone-200 pt-10 space-y-4">
                <h3 class="font-serif-editorial text-xl font-bold text-stone-900">Related Buying Guides</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedGuides as $item)
                        <div class="bg-white p-5 rounded-xl border border-stone-200/80 space-y-2">
                            <span class="text-[10px] uppercase font-bold text-stone-400">{{ $item->category->name ?? 'Guide' }}</span>
                            <h4 class="font-serif-editorial text-sm font-bold text-stone-900 line-clamp-2">
                                <a href="{{ route('content.guide', $item->slug) }}" class="hover:underline">
                                    {{ $item->title }}
                                </a>
                            </h4>
                            <p class="text-xs text-stone-500 line-clamp-2">{{ $item->excerpt }}</p>
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

    </div>
</article>
@endsection
